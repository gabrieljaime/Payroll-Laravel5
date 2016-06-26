<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadosRevista extends Model
{
    use SoftDeletes;

    public static $rules = [
        "legajo" => "required",
        "situacion"=> "required",
        "motivo"=> "required",
        "fecha_inicio"=> "required"
    ];

    protected $dates = ['fecha_inicio', 'fecha_fin', 'deleted_at'];

    public $table = "estado_revista";

    public $fillable = ["legajo", "situacion","motivo","fecha_inicio","fecha_fin","estado", "usuario_cambio"];

    public function scopeDelLegajo($query, $legajos)
    {
        $legajos= explode(',', $legajos);
        return $query->whereIn('employees_id', $legajos);
    }
    public function scopeBajasDelMes($query,$año, $mes )
    {
        $primerdia= Carbon::createFromDate($año, $mes, 1);
        $ultimodia=$primerdia->lastOfMonth();
        return $query->whereBetween('fecha_inicio', [$primerdia, $ultimodia])->where('situacion','99');
    }

    public function scopeDelLegajoVigente($query, $legajos)
    {
        $legajos= explode(',', $legajos);
        return $query->whereIn('legajo', $legajos)->where('estado','V');
    }
    public function scopeDelaSituacion($query, $situacion)
    {
        $situacion= explode(',', $situacion);
        return $query->whereIn('situacion', $situacion);
    }

    public function Empleado()
    {
        return $this->belongsTo('App\Models\Employees', 'legajo');
    }
    public function Situacion()
    {
        return $this->belongsTo('App\Models\concepto_revista', 'situacion');
    }

    public function setfecha_inicioAtribute($date)
    {

        $this->attributes['fecha_inicio'] = Carbon::parse($date);
    }

    public function setfecha_finAtribute($date)
    {

        $this->attributes['fecha_fin'] = Carbon::parse($date);
    }

}
