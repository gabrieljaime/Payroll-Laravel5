<?php

namespace App\Models;

use Gabo\TableHistoryLog\HistoryLog;
use Illuminate\Database\Eloquent\Model;

class ConceptoVariable extends Model
{

    // use HistoryLog;
    public static $rules = [
        "importe" => "required|numeric",
        "concepto_id"=> "required",
        "employees_id"=> "required",
        "anio"=> "required",
        "mes"=> "required"
    ];

    public $table = "conceptovariable";


    public $fillable = ["concepto_id", "employees_id","anio","mes","importe","cantidad"];
    protected $casts = [
        "concepto_id"  => "integer",
        "employees_id" => "integer",
        "anio"         => "integer",
        "mes"          => "integer",
        "importe"      => "float",
        "cantidad"     => "integer"];

    public function scopeDelPeriodo($query, $mes, $anio)
    {

        return $query->where('mes', $mes)->where('anio', $anio)->orderBy('concepto_id');
    }
    public function scopeDelLegajo($query, $legajos)
    {
        $legajos= explode(',', $legajos);
        return $query->whereIn('employees_id', $legajos)->orderBy('concepto_id');
    }
    public function scopeDelConcepto($query, $conceptos)
    {

        $conceptos= explode(',', $conceptos);
        return $query->whereIn('concepto_id', $conceptos)->orderBy('concepto_id');
    }
    public function Concepto()
    {
        return $this->belongsTo('App\Models\Concepto', 'concepto_id');
    }
    public function Empleado()
    {
        return $this->belongsTo('App\Models\Employees', 'employees_id');
    }

    public function ActualizarImportes($id)
    {

        $conceptoActualizado = Concepto::find($id);

        $conceptosvariables = ConceptoVariable::where('concepto_id',$id)->get();


        if (!$conceptosvariables->isEmpty()) {
            foreach ($conceptosvariables as $concepto) {

                $concepto->importe = $conceptoActualizado->importe;
                $concepto->save();

            }
        }


    }

    public function CargaNovedades($año, $mes)
    {

        $novedades = Novedades::DelPeriodo($año, $mes)->get();

        foreach ($novedades as $novedad) {

            $concepto = new ConceptoVariable();
            $concepto->concepto_id = $novedad->concepto_id;
            $concepto->employees_id = $novedad->legajo;
            $concepto->anio = $año;
            $concepto->mes = $mes;
            $concepto->importe = 0;
            $concepto->cantidad = $novedad->cantidad;


        }
    }

}
