<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConceptoCategory extends Model
{

    public static $rules = [
        "importe" => "required"
    ];
    public $table = "concepto_categoria";

    public $fillable = ["concepto_id", "categoria_id","cantidad","importe"];

    public function scopeDelaCategoria($query, $categorias)
    {
        $categorias= explode(',', $categorias);
        return $query->whereIn('categoria_id', $categorias);
    }
    public function Concepto()
    {
        return $this->belongsTo('App\Models\Concepto', 'concepto_id');
    }
    public function Categoria()
    {
        return $this->belongsTo('App\Models\Category', 'categoria_id');
    }
}
