<?php namespace App\Payrool\Entities;

use App\Models\Employees;
use App\Models\ConceptoFijo;
use App\Payrool\Entities\Recibo;
use App\Payrool\Entities\ConceptosenRecibos;
use App\Models\ConceptoVariable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flash;
use Illuminate\Support\Collection;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sueldo
 *
 * @package \\${NAMESPACE}
 */
class Liquidacion  extends Model  {

    public $table = "liquidacion";
    protected $dates = ['proceso_inicio','proceso_fin'];
    public $fillable = [        "año",
        "mes",
        "cant_legajos",
        "total_basicos",
        "total_netos",
        "total_retenciones",
        "total_haberes",
        "total_debes",
        "total_cargas",
        "proceso_inicio","proceso_fin","proceso_usuario" ];

    public function GenerarLiquidacion($legajos ,$mes, $anio, $user_id)
    {


        $this->IniciarLiquidacion($mes, $anio,$user_id);

        $empleados= Employees::Activos()->DelLegajo($legajos)->get();
        if ($empleados->isEmpty())
        {
            Flash::error('employees not found');

            return redirect(route('employees.index'));
        }

        Recibo::DelPeriodo($mes, $anio)->DelLegajo($legajos)->delete();

        foreach ($empleados as $empleado)
        {

            $this->liquidar_empleado($mes, $anio, $empleado);
        }


        $this->CerrarLiquidacion($legajos, $mes, $anio, $empleados);
    }




    public function PorSobre ($recibo, $sobre)
    {

        switch ($sobre)
        {
            case "B":
                return $recibo->total_basico;
            case "R":
                return $recibo->total_retencion;
            case "H":
                return $recibo->total_haber;
            case "D":
                return $recibo->total_debe;
            case "F":
                return $recibo->total_familia;
        }

    }


    public function agrega_concepto(&$conceptosenrecibos, $concepto)
    {
        $conceptosenrecibos->push($concepto);
    }



    /**
     * @param $conceptoFijo
     * @param $empleado
     * @param $recibo
     * @param $concepto
     * @param $total_antiguedad
     */
    public function liquidar_concepto_fijo($conceptoFijo, $empleado, $recibo, &$concepto, &$total_antiguedad)
    {
        if ($conceptoFijo->concepto->codigo == 20)
        {
            $concepto->importe = $empleado->basico;

        } else
        {

            if ($conceptoFijo->concepto->imp_por == "%")
            {
                if ($conceptoFijo->Concepto->basico == "S")
                {
                    $concepto->importe = ($conceptoFijo->cantidad * $conceptoFijo->importe) / 100;
                } else
                {
                    $r = $this->PorSobre($recibo, $conceptoFijo->concepto->por_sobre);
                    if ($conceptoFijo->concepto->formula == "S")
                    {
                        //Antiguedad
                        if ($conceptoFijo->concepto->codigo == 21 and $conceptoFijo->cantidad > 0)
                        {
                            $concepto->importe = ($conceptoFijo->cantidad * 0.02) * $r;
                            $total_antiguedad = ($conceptoFijo->cantidad * 0.02) * $r;
                        }
                    } // HIJOS
                    elseif ($conceptoFijo->concepto->codigo == 302)
                    {
                        if ($recibo->total_retencion < 2400)
                        {
                            $concepto->importe = 135 * $conceptoFijo->cantidad;

                        } elseif ($recibo->total_retencion < 3600)
                        {
                            $concepto->importe = 101.3 * $conceptoFijo->cantidad;

                        } elseif ($recibo->total_retencion < 4800)
                        {
                            $concepto->importe = 67.5 * $conceptoFijo->cantidad;

                        }
                    }//HIJOS
                    // HIJOS DISC
                    elseif ($conceptoFijo->concepto->codigo == 303)
                    {
                        if ($recibo->total_retencion < 2400)
                        {
                            $concepto->importe = 540 * $conceptoFijo->cantidad;

                        } elseif ($recibo->total_retencion < 3600)
                        {
                            $concepto->importe = 405 * $conceptoFijo->cantidad;

                        } elseif ($recibo->total_retencion < 4800)
                        {
                            $concepto->importe = 270 * $conceptoFijo->cantidad;
                        }
                    }//HIJOS DISC
                    //
                    elseif ($conceptoFijo->concepto->codigo == 501)
                    {
                        $concepto->importe = ($conceptoFijo->cantidad * $recibo->total_neto) / 100;
                    } else
                    {

                        $concepto->importe = ($conceptoFijo->cantidad * $r) / 100;
                    }
                }

            } else
            {
                if ($conceptoFijo->concepto->codigo == 56)
                {
                    $totalSala = $conceptoFijo->importe;
                }
                $concepto->importe = $conceptoFijo->importe;
            }
        }
    }

    /**
     * @param $conceptoVariable
     * @param $recibo
     * @param $total_antiguedad
     * @param $concepto
     * @param $empleado
     * @param $total_no_porcenta
     */
    public function liquidar_concepto_variable($conceptoVariable,$empleado, $recibo,  &$concepto, &$total_antiguedad, &$total_no_porcenta)
    {
        if ($conceptoVariable->concepto->imp_por == "%")
        {
            $porcentaje =  $this->PorSobre($recibo, $conceptoVariable->concepto->por_sobre);
            if ($conceptoVariable->concepto->formula == "S")
            {
                //EXEDENTE PAC. U.T.I.
                if ($conceptoVariable->concepto->codigo == 36)
                {
                    $concepto->importe = $conceptoVariable->cantidad * (1.25 * ($porcentaje + $total_antiguedad) / 25 / 7);
                }
                //DESC. VACACIONES
                if ($conceptoVariable->concepto->codigo == 36)
                {
                    $concepto->importe = $conceptoVariable->cantidad * ($porcentaje / 30);
                    $total33 = $conceptoVariable->cantidad * ($porcentaje / 30);

                }
                //VACACIONES o VACACIONES NO GOZADAS
                if ($conceptoVariable->concepto->codigo == 232 or $conceptoVariable->concepto->codigo == 90)
                {
                    $concepto->importe = $conceptoVariable->cantidad * ($porcentaje / 25);

                }

                //  EXEDENTE PAC. PISO
                if ($conceptoVariable->concepto->codigo == 37)
                {
                    $concepto->importe = $conceptoVariable->cantidad * (1.1 * ($porcentaje + $total_antiguedad) / 25 / 7);

                }
                //  C.C.P.G.Cirugia
                if ($conceptoVariable->concepto->codigo == 78)
                {
                    if ($empleado->caja_cirujia == "Mucamas")
                    {
                        $concepto->importe = (($conceptoVariable->cantidad * 0.01) * ($porcentaje * 0.02)); // * algo mas     Data9.Recordset.Fields("tot_cajMC") ;
                    } elseif ($empleado->caja_cirujia == "Profesional")
                    {
                        $concepto->importe = (($conceptoVariable->cantidad * 0.01) * ($porcentaje * 0.08)); // * algo mas     Data9.Recordset.Fields("tot_cajPC") ;
                    }


                }
                //  C.C.P.G.Partos
                if ($conceptoVariable->concepto->codigo == 79)
                {
                    if ($empleado->caja_cirujia == "Mucamas")
                    {
                        $concepto->importe = (($conceptoVariable->cantidad * 0.01) * ($porcentaje * 0.02)); // * algo mas     Data9.Recordset.Fields("tot_cajMC") ;
                    } elseif ($empleado->caja_cirujia == "Profesional")
                    {
                        $concepto->importe = (($conceptoVariable->cantidad * 0.01) * ($porcentaje * 0.08)); // * algo mas     Data9.Recordset.Fields("tot_cajPC") ;
                    }


                }
                //  LICENCIA POR MATERNIDAD
                if ($conceptoVariable->concepto->codigo == 360 and $conceptoVariable->cantidad > 29)
                {
                    //Final para todos!!! Exit
                    $especifico = 1;
                }
                //  LICENCIA POR MATERNIDAD
                if ($conceptoVariable->concepto->codigo == 360 and $conceptoVariable->cantidad <= 29)
                {
                    //otra huevada
                    $especifico = 1;
                }
                //FERIADOS TRABAJADOS
                if ($conceptoVariable->concepto->codigo == 22)
                {
                    $concepto->importe = ($conceptoVariable->cantidad * 8) * (($porcentaje + $total_antiguedad) / 200);

                }
                //DIAS NO TRABAJADOS
                if ($conceptoVariable->concepto->codigo == 25)
                {
                    $concepto->importe = ($porcentaje - $total_no_porcenta) - ((30 - $conceptoVariable->cantidad) * ($porcentaje - $total_no_porcenta) / 30);

                }
                //HORAS NO TRABAJADAS
                if ($conceptoVariable->concepto->codigo == 26)
                {
                    $concepto->importe = $conceptoVariable->cantidad * ($porcentaje / $empleado->horas);
                }

            } else
            {
                $concepto->importe = ($conceptoVariable->cantidad * $porcentaje) / 100;
            }
        } else
        {

            $concepto->importe = $conceptoVariable->importe;
            if ($conceptoVariable->concepto->codigo == 296 or $conceptoVariable->concepto->codigo == 40)
            {
                $total_no_porcenta = $total_no_porcenta + $concepto->importe;
            }
        }
    }

    /**
     * @param $mes
     * @param $anio
     * @param $empleado
 */
    public function liquidar_empleado($mes, $anio, $empleado)
    {

        //Crea un nuevo recibo
        $recibo = new Recibo();

        $recibo->iniciarecibo($mes, $anio, $empleado);

        $orden = 0;
        $conceptosenrecibos = collect([]);
        $total_no_porcenta = 0;
        $total_antiguedad=0;


        $conceptosFijos = ConceptoFijo::with('Concepto')->DelLegajo($empleado->id)->get();

        $conceptosVariables = ConceptoVariable::with('Concepto')->DelPeriodo($mes, $anio)->DelLegajo($empleado->id)->get();
         //Liquida conceptos Fijos
        foreach ($conceptosFijos as $conceptoFijo)
        {

            $concepto = new ConceptosenRecibos();

            $concepto->inicializa_concepto( $recibo->id, $conceptoFijo, $orden);

            $this->liquidar_concepto_fijo($conceptoFijo, $empleado,  $recibo, $concepto, $total_antiguedad);

            $recibo->totales_recibo($concepto);

            $this->agrega_concepto($conceptosenrecibos, $concepto);
        }
        //Liquida conceptos Variables
        foreach ($conceptosVariables as $conceptoVariable)
        {

            $concepto = new ConceptosenRecibos();
            $concepto->inicializa_concepto( $recibo->id, $conceptoVariable, $orden);


            $this->liquidar_concepto_variable($conceptoVariable,$empleado, $recibo,  $concepto, $total_antiguedad,  $total_no_porcenta);


            $recibo->totales_recibo( $concepto);

            $this->agrega_concepto($conceptosenrecibos, $concepto);
        }
        $this->guardar_liquidacion($recibo, $conceptosenrecibos);
    }

    /**
     * @param $recibo
     * @param $conceptosenrecibos
     */
    public function guardar_liquidacion($recibo, $conceptosenrecibos)
    {
        DB::transaction(function ()use ($recibo, $conceptosenrecibos)
        {
            $recibo->save();

            foreach ($conceptosenrecibos as $conceptoenrecibo)
            {
                $conceptoenrecibo->save();
            }
       } );
    }


    public function IniciarLiquidacion($mes, $anio, $user_id)
    {
        $this->año = $anio;
        $this->mes = $mes;
        $this->proceso_usuario = $user_id;
        $this->proceso_inicio = Carbon::now();
        $this->save();
    }

    /**
     * @param $legajos
     * @param $mes
     * @param $anio
     * @param $empleados
     */
    public function CerrarLiquidacion($legajos, $mes, $anio, $empleados)
    {
        $recibos = Recibo::DelPeriodo($mes, $anio)->DelLegajo($legajos);

        $this->cant_legajos = count($empleados);
        $this->total_basicos = $recibos->sum('total_basico');
        $this->total_netos = $recibos->sum('total_neto');
        $this->total_retenciones = $recibos->sum('total_retenciones');
        $this->total_haberes = $recibos->sum('total_haber');
        $this->total_debes = $recibos->sum('total_debe');
        $this->total_cargas = $recibos->sum('total_cargas');
        $this->proceso_fin = Carbon::now();
        $this->update();
    }
}