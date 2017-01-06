<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Support\Facades\DB;


class ResumenReloj extends Model
{

    public $table = "resumen_reloj";


    public $fillable = [
        "legajo",
        "dias_trabajados",
        "dias_descuentos",
        "horas_descuentos",
        "horas_extras",
        "feriados_trabajados",
        "año",
        "mes"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "legajo" => "integer",
        "dias_trabajados"  => "integer",
        "dias_descuentos"  => "integer",
        "horas_descuentos" => "integer",
        "horas_extras"  => "integer",
        "feriados_trabajados"=> "integer",
        "año"  => "integer",
        "mes" => "integer"


    ];

    public function scopeDelPeriodo($query, $mes, $anio)
    {

        return $query->where('mes', $mes)->where('año', $anio);
    }
    public function scopeConHoras($query)
    {

        return $query->where('dias_descuentos','>', 0)->orWhere('horas_descuentos','>', 0)->orWhere('horas_extras','>', 0)->orWhere('feriados_trabajados','>', 0);
    }
    public function scopeDelLegajo($query, $legajo)
    {

        return $query->where('legajo', $legajo);
    }
    public static $rules = [

    ];
        public function ResumirRelojDe($año, $mes, $legajo)
        {

            $resumen=ResumenReloj::DelPeriodo($mes, $año)->DelLegajo($legajo)->first();




            $primero_mes=Carbon::create($año,$mes, '01');
            $ultimo_mes=$primero_mes->lastOfMonth();



            $inputs = DB::table('input_reloj')
                ->whereBetween('fechadate', [Carbon::create($año,$mes, '01',00,00,00), $ultimo_mes])
                ->where('legajo',$legajo)
                ->select(DB::raw(' legajo, SUM(dTrabajados) as dias_trabajados,SUM(	vAusente) as dias_descuentos ,SUM(hTarde/60 ) as horas_descuentos,SUM(hExtras3+hExtras4+hExtras5) as horas_extras '))
                ->groupBy('legajo')
                ->orderBy('legajo')
                ->get();




            $feriados = DB::table('input_reloj')
                ->join('feriados_argentina', 'input_reloj.fechadate', '=', 'feriados_argentina.fecha')
                ->whereBetween('fechadate', [Carbon::create($año,$mes, '01',00,00,00), $ultimo_mes])
                ->where('input_reloj.legajo',$legajo)
                ->select(DB::raw(' legajo, SUM(dTrabajados) as dias_feriado'))
                ->groupBy('legajo')
                ->having('dias_feriado', '>', 0)
                ->lists('dias_feriado','legajo');



            if (!empty($resumen))
            {

                foreach ($inputs as $input)
                {



                    $resumen->dias_trabajados= $input->dias_trabajados;
                    $resumen->dias_descuentos=$input->dias_descuentos;
                    $resumen->horas_descuentos=$input->horas_descuentos;
                    $resumen->horas_extras=$input->horas_extras;
                    $resumen->feriados_trabajados=array_pull($feriados,$input->legajo,0);



                    $resumen->save();




                }


            }
            else
            {
                foreach ($inputs as $input)
                {


                    $registro = ResumenReloj::create([
                        'legajo'=>$input->legajo,
                        'dias_trabajados'=>$input->dias_trabajados,
                        'dias_descuentos'=>$input->dias_descuentos,
                        'horas_descuentos'=>$input->horas_descuentos,
                        'horas_extras'=>$input->horas_extras,
                        'feriados_trabajados'=>array_pull($feriados,$input->legajo,0),
                        'año'=>$año,
                        'mes'=>$mes
                    ]);

                }
            }



            return;


        }
    public function ResumirReloj($año, $mes)
    {

        $resumen=ResumenReloj::DelPeriodo($mes, $año)->get();
        if (!$resumen->isEmpty())
        {
            foreach ($resumen as $legajo) {
                $legajo->delete();
            }


        }



        $primero_mes=Carbon::create($año,$mes, '01',00,00,00);
        $ultimo_mes=$primero_mes->lastOfMonth();


        $inputs = DB::table('input_reloj')
            ->join('employees','input_reloj.legajo','employees.id' )
            ->whereBetween('fechadate', [Carbon::create($año,$mes, '01',00,00,00), $ultimo_mes])
            ->select(DB::raw(' legajo, SUM(dTrabajados) as dias_trabajados,SUM(	vAusente) as dias_descuentos,SUM(hTarde/60 ) as horas_descuentos,SUM(hExtras3+hExtras4+hExtras5) as horas_extras '))
            ->groupBy('legajo')
            ->orderBy('legajo')
            ->get();


        $feriados = DB::table('input_reloj')
            ->join('feriados_argentina', 'input_reloj.fechadate', '=', 'feriados_argentina.fecha')
            ->whereBetween('fechadate', [Carbon::create($año,$mes, '01',00,00,00), $ultimo_mes])
            ->select(DB::raw(' legajo, SUM(dTrabajados) as dias_feriado'))
            ->groupBy('legajo')
            ->having('dias_feriado', '>', 0)
            ->lists('dias_feriado','legajo');

        foreach ($inputs as $input)
        {


            $registro = ResumenReloj::create([
                'legajo'=>$input->legajo,
                'dias_trabajados'=>$input->dias_trabajados,
                'dias_descuentos'=>$input->dias_descuentos,
                'horas_descuentos'=>$input->horas_descuentos,
                'horas_extras'=>$input->horas_extras,
                'feriados_trabajados'=>array_pull($feriados,$input->legajo,0),
                'año'=>$año,
                'mes'=>$mes
            ]);

        }




return;



    }

}
