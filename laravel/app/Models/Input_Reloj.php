<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Model;


class Input_Reloj extends Model
{

	public $table = "input_reloj";


	public $fillable = [
		"idPersona",
		"Apynom",
		"Agrupacion1",
		"Agrupacion2",
		"Agrupacion3",
		"Categoria",
		"Fecha",
		"Fichadas",
		"FechaDate",
		"hPausa",
		"hPausaExceso",
		"vPausaExceso",
		"vPausaFueraHora",
		"hNormales",
		"hTarde",
		"vTarde",
		"hAnticipado",
		"vAnticipado",
		"hAusente",
		"vAusente",
		"dTrabajados",
		"hExtras3",
		"hExtras4",
		"hExtras5",
		"hFeriado",
		"hNocturnas",
		"hNocNormales",
		"hNocExtras3",
		"hNocExtras4",
		"hNocExtras5",
		"hNocFeriado",
		"Observaciones",
		"cPremio",
		"Legajo",
		"hDescuento",
		"hReales"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
		"idPersona" => "integer",
		"Apynom" => "string",
		"Agrupacion1" => "string",
		"Agrupacion2" => "string",
		"Agrupacion3" => "string",
		"Categoria" => "string",
		"Fecha" => "string",
		"Fichadas" => "integer",
		"hPausa" => "integer",
		"hPausaExceso" => "integer",
		"vPausaExceso" => "integer",
		"vPausaFueraHora" => "integer",
		"hNormales" => "integer",
		"hTarde" => "integer",
		"vTarde" => "integer",
		"hAnticipado" => "integer",
		"vAnticipado" => "integer",
		"hAusente" => "integer",
		"vAusente" => "integer",
		"dTrabajados" => "integer",
		"hExtras3" => "integer",
		"hExtras4" => "integer",
		"hExtras5" => "integer",
		"hFeriado" => "integer",
		"hNocturnas" => "integer",
		"hNocNormales" => "integer",
		"hNocExtras3" => "integer",
		"hNocExtras4" => "integer",
		"hNocExtras5" => "integer",
		"hNocFeriado" => "integer",
		"Observaciones" => "string",
		"cPremio" => "integer",
		"Legajo" => "integer",
		"hDescuento" => "integer",
		"hReales" => "integer"
    ];

	public static $rules = [

	];

	public function scopeDelPeriodo($query, $mes, $anio)
	{



		$primero_mes=Carbon::create($anio,$mes, '01',00,00,00);
		$ultimo_mes=Carbon::create($anio,$mes, '01',00,00,00)->lastOfMonth();


		return $query->whereBetween('fechadate', [$primero_mes, $ultimo_mes]);

	}
	public function scopeDelLegajo($query, $legajo)
	{



		return $query->where('legajo', $legajo);

	}

}
