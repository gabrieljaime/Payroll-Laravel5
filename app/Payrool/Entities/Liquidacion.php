<?php namespace App\Payrool\Entities;

use App\Models\Concepto;
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
    protected $dates = ['proceso_inicio','proceso_fin', 'fecha_pago'];
    public $fillable = [        "año",
        "mes",
        "fecha_pago",
        "cant_legajos",
        "total_basicos",
        "total_netos",
        "total_retenciones",
        "total_haberes",
        "total_debes",
        "total_fijos",
        "total_cargas",
        "tipo",
        "proceso_inicio","proceso_fin","proceso_usuario" ];

    public function GenerarLiquidacion($legajos , $anio,$mes, $user_id, $tipo = null )
    {
        DB::transaction(function() use ($legajos ,$mes, $anio, $user_id, $tipo)
        {

            if (!is_null($tipo))
            {Liquidacion::where('mes',$mes)->where('año',$anio)->where('tipo', $tipo)->delete();
        }
            else
            {
                Liquidacion::where('mes',$mes)->where('año',$anio)->delete();
            }

            $this->IniciarLiquidacion($mes, $anio, $user_id,$tipo);

            $empleados = Employees::DelLegajo($legajos)->get();

            if ($empleados->isEmpty())
            {
                Flash::error('employees not found');

                return redirect(route('employees.index'));
            }



            $reciboDel=Recibo::DelPeriodo($mes, $anio)->DelLegajo($legajos)->DelTipo($tipo)->get();
            if (!$reciboDel->isEmpty())
            {

                foreach ($reciboDel as $recibo)
                {

                    foreach ($recibo->conceptos as $concepto)
                    {

                        ConceptosenRecibos::find($concepto->id)->delete();
                    }

                    Recibo::find($recibo->id)->delete();
                }
            }


            foreach ($empleados as $empleado)
            {

                $this->liquidar_empleado($mes, $anio, $empleado,$tipo);
            }


            $this->CerrarLiquidacion($legajos, $mes, $anio, $empleados);
        });
    }

    public function dias ($anio, $mes)
    {
        return Carbon::createFromDate($anio,$mes,1)->daysInMonth;
    }


    public function PorSobre ($recibo, $sobre)
    {
        switch ($sobre)
        {
            case "B":
                return $recibo->total_basico;
            case "R":
                return $recibo->total_retenciones;
            case "H":
                return $recibo->total_haber;
            case "D":
                return $recibo->total_debe;
            case "F":
                return $recibo->total_fijos;
            case "S":
                return $recibo->total_cargas;
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
    public function liquidar_concepto_fijo($conceptoFijo, $empleado, $recibo, &$concepto, &$total_antiguedad, $dias)
    {

        if ($conceptoFijo->concepto->codigo==296)
        {
            /*Sac 1 de Enero a Junio*/
            $concepto->importe = $this->SueldoSac($empleado, $recibo,1,6);

        }
        elseif ($conceptoFijo->concepto->codigo==297)
        {
            /*Sac 2 de Julio a Diciembre*/
            $concepto->importe = $this->SueldoSac($empleado, $recibo,7,12);
        }
        elseif ($conceptoFijo->concepto->codigo == 20)
        {
            $concepto->importe = $empleado->basico;

        }
        else
        {

            if ($conceptoFijo->concepto->imp_por == "P")
            {

                if ($conceptoFijo->Concepto->basico == "S")
                {

                    $concepto->importe = ($conceptoFijo->cantidad * $conceptoFijo->importe) / 100;
                }
                else
                {
                    $r = $this->PorSobre($recibo, $conceptoFijo->concepto->por_sobre);

                    if ($conceptoFijo->concepto->es_formula == "S")
                    {
                        //Antiguedad

                        if ($conceptoFijo->concepto->codigo == 21 and $conceptoFijo->cantidad > 0 and $empleado->ES_JERARQUICO !=1 )
                        {
                            $concepto->importe = ($conceptoFijo->cantidad * 0.02) * $r;
                            $total_antiguedad = ($conceptoFijo->cantidad * 0.02) * $r;

                        }
                    } // HIJOS
                    elseif ($conceptoFijo->concepto->codigo == 302)
                    {

                        //if ($recibo->total_retencion < 2400)
                        //{
                        //    $concepto->importe = 135 * $conceptoFijo->cantidad;
                        //
                        //} elseif ($recibo->total_retencion < 3600)
                        //{
                        //    $concepto->importe = 101.3 * $conceptoFijo->cantidad;
                        //
                        //} elseif ($recibo->total_retencion < 4800)
                        //{
                        //    $concepto->importe = 67.5 * $conceptoFijo->cantidad;
                        //
                        //}
                        $concepto->importe =0;
                    }//HIJOS
                    // HIJOS DISC
                    elseif ($conceptoFijo->concepto->codigo == 303)
                    {
                        //if ($recibo->total_retencion < 2400)
                        //{
                        //    $concepto->importe = 540 * $conceptoFijo->cantidad;
                        //
                        //} elseif ($recibo->total_retencion < 3600)
                        //{
                        //    $concepto->importe = 405 * $conceptoFijo->cantidad;
                        //
                        //} elseif ($recibo->total_retencion < 4800)
                        //{
                        //    $concepto->importe = 270 * $conceptoFijo->cantidad;
                        //}
                        $concepto->importe =0;
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
    public function liquidar_concepto_variable($conceptoVariable,$empleado, $recibo,  &$concepto, &$total_antiguedad, &$total_no_porcenta, $dias)
    {

        if ($conceptoVariable->concepto->imp_por == "P")
        {



            $porcentaje =  $this->PorSobre($recibo, $conceptoVariable->concepto->por_sobre);


            if ($conceptoVariable->concepto->for == "S")
            {

                //EXEDENTE PAC. U.T.I.
                if ($conceptoVariable->concepto->codigo == 36)
                {
                    $concepto->importe = $conceptoVariable->cantidad * (1.25 * ($porcentaje + $total_antiguedad) / 25 / 7);
                }
                //DESC. VACACIONES
                if ($conceptoVariable->concepto->codigo == 33)
                {
                    $concepto->importe = $conceptoVariable->cantidad * ($porcentaje / $dias);
                    $total33 = $conceptoVariable->cantidad * ($porcentaje / $dias);

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

                   // $concepto->importe = ($conceptoVariable->cantidad * 8) * (($porcentaje + $total_antiguedad) / $empleado->horas);
                    $concepto->importe = ($conceptoVariable->cantidad * 8) * (($porcentaje + $total_antiguedad) / 200);

                }
                //DIAS NO TRABAJADOS
                if ($conceptoVariable->concepto->codigo == 25)
                {
                    $concepto->importe = ($porcentaje - $total_no_porcenta) - (($dias - $conceptoVariable->cantidad) * ($porcentaje - $total_no_porcenta) / $dias);

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
    public function liquidar_empleado($mes, $anio, $empleado,$tipo)
    {

        //Crea un nuevo recibo
        $recibo = new Recibo();
        //$dias = $this->dias($anio, $mes);
        $dias=30;
        $recibo->iniciarecibo($mes, $anio, $empleado, $tipo, $this);

        $orden = 0;
        $conceptosenrecibos = collect([]);
        $total_no_porcenta = 0;
        $total_antiguedad=0;


        if ((is_null($tipo))or ($tipo=="Normal"))
        {
        $this->actualizar_Antiguedad($mes, $anio, $empleado);
        }

        if (($mes ==13) or ($mes ==14))
        {


            $conceptogeneral = new ConceptoFijo();
            if ($mes ==13)
            {
                $conceptoSac= Concepto::where('codigo','296')->first();
            }
            else
            {
                $conceptoSac= Concepto::where('codigo','297')->first();
            }

            $conceptogeneral->concepto_id=$conceptoSac->codigo;

            $conceptogeneral->cantidad=1;
            $conceptogeneral->concepto->$conceptoSac;


            $concepto = new ConceptosenRecibos();
            $concepto->inicializa_concepto( $recibo->id, $conceptogeneral, $orden);

            $this->liquidar_concepto_fijo($conceptogeneral, $empleado,  $recibo, $concepto, $total_antiguedad, $dias);

            $recibo->totales_recibo($concepto);

            $this->agrega_concepto($conceptosenrecibos, $concepto);



            $conceptosFijos = ConceptoFijo::with('Concepto')->DelLegajo($empleado->id)->get();
            $conceptosFijos=$conceptosFijos->filter(function ($item) {
                return $item->Concepto->haberdebe =='D';
            });

            foreach ($conceptosFijos as $conceptogeneral)
            {

                $concepto = new ConceptosenRecibos();

                $concepto->inicializa_concepto( $recibo->id, $conceptogeneral, $orden);

                $this->liquidar_concepto_fijo($conceptogeneral, $empleado,  $recibo, $concepto, $total_antiguedad, $dias);

                $recibo->totales_recibo($concepto);
                $this->agrega_concepto($conceptosenrecibos, $concepto);

            }

        }
        else
        {


            $conceptosFijos = ConceptoFijo::with('Concepto')->DelLegajo($empleado->id)->get();
            $conceptosVariables = ConceptoVariable::with('Concepto')->DelPeriodo($mes, $anio)->DelLegajo($empleado->id)->get(array('id', 'concepto_id', 'employees_id', 'importe', 'cantidad'));

            if ($tipo=="antexp")
            {

                $conceptosFijos = $conceptosFijos->where('Concepto.quefor', 'E');
                $conceptosVariables = $conceptosVariables->where('Concepto.quefor', 'E');
            }
            if ((is_null($tipo))or ($tipo=="Normal"))
            {
                $conceptosFijos = $conceptosFijos->where('Concepto.quefor','<>', 'E');
                $conceptosVariables = $conceptosVariables->where('Concepto.quefor','<>', 'E');
            }



            $conceptoBasicos=$conceptosFijos->where('Concepto.basico', 'S');
            if (!$conceptoBasicos->isEmpty())
            {
                $this->liquidar_conceptos($empleado, $conceptoBasicos, $recibo, $dias, $conceptosenrecibos, $orden, $total_antiguedad, $dias);
            }
            $concepto250=$conceptosVariables->where('Concepto.haberdebe', 'H')->where('Concepto.codigo', 250);

            if (!$concepto250->isEmpty())
            {
                $this->liquidar_conceptos($empleado, $concepto250, $recibo, $dias,$conceptosenrecibos, $orden,$total_antiguedad,$dias);

            }

            $conceptoFijosComunes=$conceptosFijos->where('Concepto.basico', 'N')->where('Concepto.haberdebe', 'H')->sortBy('Concepto.codigo');

            if (!$conceptoFijosComunes->isEmpty())
            {
                $this->liquidar_conceptos($empleado, $conceptoFijosComunes, $recibo, $dias,$conceptosenrecibos, $orden,$total_antiguedad,$dias);

            }


            $conceptoVariablesC=$conceptosVariables->where('Concepto.haberdebe', 'H')->filter(function ($item) {
                return $item->concepto->codigo != 250 ;
            })->sortBy('Concepto.codigo');

            if (!$conceptoVariablesC->isEmpty())
            {
                $this->liquidar_conceptos($empleado, $conceptoVariablesC, $recibo, $dias,$conceptosenrecibos, $orden,$total_antiguedad,$dias);

            }
            $conceptoDescuentosFijosComunes=$conceptosFijos->where('Concepto.basico', 'N')->where('Concepto.haberdebe', 'D')->sortBy('Concepto.codigo');

            if (!$conceptoDescuentosFijosComunes->isEmpty())
            {
                $this->liquidar_conceptos($empleado, $conceptoDescuentosFijosComunes, $recibo, $dias,$conceptosenrecibos, $orden,$total_antiguedad,$dias);

            }
            $conceptoDescuentosVariables=$conceptosVariables->where('Concepto.haberdebe', 'D')->sortBy('Concepto.codigo');
            if (!$conceptoDescuentosVariables->isEmpty())
            {
                $this->liquidar_conceptos($empleado, $conceptoDescuentosVariables, $recibo, $dias,$conceptosenrecibos, $orden,$total_antiguedad,$dias);

            }


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
                if ($conceptoenrecibo->importe!=0)
                {
                    $conceptoenrecibo->save();
                }
            }
       } );
    }


    public function IniciarLiquidacion($mes, $anio, $user_id, $tipo)
    {
        $this->año = $anio;
        $this->mes = $mes;
        $this->proceso_usuario = $user_id;
        if ( is_null($tipo))
        {
            $this->tipo ='Normal';
            }
        else
        {
            $this->tipo =$tipo;
        }
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
        $recibos = Recibo::DelPeriodo($mes, $anio)->get();
        $this->cant_legajos = count($recibos);
        $this->total_basicos = $recibos->sum('total_basico');
        $this->total_netos = $recibos->sum('total_neto');
        $this->total_retenciones = $recibos->sum('total_retenciones');
        $this->total_haberes = $recibos->sum('total_haber');
        $this->total_debes = $recibos->sum('total_debe');
        $this->total_cargas = $recibos->sum('total_cargas');
        $this->total_fijos = $recibos->sum('total_fijos');
        $this->proceso_fin = Carbon::now();
        $this->update();
    }


    public function SueldoSac($empleado, $recibo, $mesini,$mesfin)
    {

        $sueldomaximo = Recibo::where('employees_id', $empleado->id)->where('año', $recibo->año)->whereBetween('mes', [$mesini, $mesfin])->max('total_retenciones');
        $sueldosac = $sueldomaximo / 2;

        $inisac = Carbon::createFromDate($recibo->año, $mesini, 1);

        $finsac =  Carbon::createFromDate($recibo->año, $mesfin, 1)->lastOfMonth();

        if ($empleado->fecha_ingreso > $inisac)
        {
            $dias_periodo = $inisac->diffInDays($finsac);
            $dias_trabajados = $inisac->diffInDays($empleado->fecha_ingreso);
            $sueldosac = ($sueldosac / $dias_periodo) * $dias_trabajados;

        }

        return  $sueldosac;
    }


    public function liquidar_conceptos($empleado, $conceptos, $recibo, $dias, &$conceptosenrecibos, &$orden,&$total_antiguedad,$dias)
    {
        foreach ($conceptos as $conceptogeneral)
        {

            $concepto = new ConceptosenRecibos();

            $concepto->inicializa_concepto($recibo->id, $conceptogeneral, $orden);

            if ($conceptogeneral->Concepto->esfijo == 'S')
            {
                $this->liquidar_concepto_fijo($conceptogeneral, $empleado, $recibo, $concepto, $total_antiguedad, $dias);
            } else
            {

                $this->liquidar_concepto_variable($conceptogeneral, $empleado, $recibo, $concepto, $total_antiguedad, $total_no_porcenta, $dias);
            }

            $recibo->totales_recibo($concepto);
            $this->agrega_concepto($conceptosenrecibos, $concepto);
        }

        return $conceptosenrecibos;
    }

    /**
     * @param $mes
     * @param $anio
     * @param $empleado
     */
    public function actualizar_Antiguedad($mes, $anio, $empleado)
    {
        $conceptosAntiguedad = ConceptoFijo::with('Concepto')->DelLegajo($empleado->id)->where('concepto_id', '2')->first();
        if (!empty($conceptosAntiguedad))
        {
            $ultimodia = Carbon::createFromDate($anio, $mes, 1)->lastOfMonth();
            $Antiguedad = $ultimodia->diffInYears($empleado->fecha_ingreso);
            $conceptosAntiguedad->cantidad = $Antiguedad;
            $conceptosAntiguedad->save();
        }
    }
}