<?php namespace App\Models;

use App\Payrool\Entities\Liquidacion;
use Carbon\Carbon;
use Gabo\TableHistoryLog\HistoryLog;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Mail\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;


class RecibosImpresion extends Model
{

    use HistoryLog;

    public $table = "recibos_impresion";


    public $fillable = [
        "id_liquidacion",
        "ruta",
        "archivo",
        "parte",
        "total",
        "mes",
        "año",
        "tipo",
        "descargado",
        "fecha_descarga",
        "updated_at",
        "created_at"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id_liquidacion"=> "integer",
        "ruta"=> "string",
        "archivo"=> "string",
        "parte"=> "integer",
        "total"=> "integer",
        "mes"=> "integer",
        "año"=> "integer",
        "tipo"=> "string",
        "descargado"=> "string",
        "fecha_descarga"=> "date"

    ];

    public function scopeDelPeriodo($query, $mes, $anio)
{

    return $query->where('mes', $mes)->where('año', $anio);
}
    public static $rules = [

    ];



    public function RegistrarArchivo($año, $mes,$ruta,$archivo,$liquidacion,$parte,$total,$tipo)
    {

        $registro=RecibosImpresion::DelPeriodo($mes,$año)->where('parte',$parte)->where('tipo',$tipo)->first();




        if (!empty($registro))
        {

            \Illuminate\Support\Facades\File::delete( $registro->ruta.$registro->archivo);
            $registro->delete();

        }


            $registro = RecibosImpresion::create([
                "id_liquidacion"=> $liquidacion,
                "ruta"=> $ruta,
                "archivo"=> $archivo,
                "parte"=> $parte,
                "total"=> $total,
                "tipo"=>$tipo,
                "mes"=> $mes,
                "año"=> $año,
                "descargado"=> "N",
                "fecha_descarga"=> null
            ]);


        $partes=RecibosImpresion::DelPeriodo($mes,$año)->where('tipo',$tipo)->count();

        if ($partes==$total)
        {
            $this->EnviarMailNotficacion($liquidacion);

        }

    }


    public function EnviarMailNotficacion($id)
    {

        $user = User::findOrFail(Liquidacion::find($id)->proceso_usuario);



        Mail::send('emails.reciboslistos', ['user' => $user], function ($m) use ($user) {
             $m->to($user->email, $user->name)->subject('Nuevos Recibos Disponibles!');
        });
    }




    public function BajarArhivo($año, $mes,$parte,$tipo)
    {

       $registro=RecibosImpresion::DelPeriodo($mes,$año)->where('parte',$parte)->where('tipo',$tipo)->first();

        $registro->descargado="S";
        $registro->fecha_descarga=Carbon::now();
        $registro->save();



    }

}
