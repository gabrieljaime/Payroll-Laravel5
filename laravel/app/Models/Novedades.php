<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Novedades extends Model
{
    use SoftDeletes;

	public $table = "novedades";
    
	protected $dates = ['deleted_at'];


	public $fillable = [
	    "id",
		"legajo",
		"año",
		"mes",
		"tipo_novedad",
		"cantidad",
		"concepto_id",
		"codigo",
		"estado"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
		"legajo" => "integer",
		"año" => "integer",
		"mes" => "integer",
		"tipo_novedad" => "integer",
		"cantidad" => "integer",
		"concepto_id" => "integer",
		"codigo" => "integer",
		"estado" => "integer"
    ];


	public function TipoNovedad()
	{

		return $this->belongsTo('App\Models\TiposNovedades', 'tipo_novedad');
	}
	public function Empleado()
	{

		return $this->belongsTo('App\Models\Employees', 'legajo');
	}
	public function Estados()
	{

		return $this->belongsTo('App\Models\ComboOption','estado');
	}




	public static $rules = [
		"legajo" => "required",
		 "año" => "required",
		"mes" => "required",
		"tipo_novedad" => "required",
		"cantidad" => "required",
		"estado" => "required"
	];

	public function scopeDelPeriodo($query,$año, $mes)
	{

		return $query->where('mes', $mes)->where('año',$año);
	}

}
