<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class employees extends Model {

    public static $rules = [
        /**
         * "nombre" => "required",
         * "cuil" => "required",
         * "categoria" => "required",
         * "subcategoria" => "required",
         * "sexo" => "required",
         * "tipo_documento" => "required",
         * "numero_documento" => "required",
         * "fecha_nacimiento" => "required|date",
         * "direccion" => "required",
         * "localidad" => "required",
         * "telefono" => "required",
         * "email" => "required|email",
         * "estado_civil" => "required",
         * "cant_hijos" => "required",
         * "sindicato" => "required",
         *
         * "conyugue" => "required",
         * "tiene_a_cargo" => "required",
         * "cant_a_cargo" => "required_if:tiene_a_cargo,S",
         * "tipo_contrato" => "required",
         * "turno" => "required",
         * "es_jerarquico"=> "required",
         * "jubilacion" => "required",
         * "ubicacion" => "required",
         * "obra_social" => "required",
         * "horas" => "required",
         * "activo" => "required|boolean"
         **/
    ];
    public $table = "employees";
    public $fillable = [
        "nombre",
        "photo",
        "cuil",
        "fecha_ingreso",
        "categoria",
        "subcategoria",
        "sexo",
        "tipo_documento",
        "numero_documento",
        "fecha_nacimiento",
        "matricula",
        "direccion",
        "localidad",
        "telefono",
        "celular",
        "email",
        "estado_civil",
        "cant_hijos",
        "cant_hijos_disc",
        "hijos_escpres",
        "hijos_escprim",
        "hijos_escsec",
        "hijos_univer",
        "sindicato",
        "nro_cuenta",
        "fatsa",
        "nro_afiliado",
        "conyugue",
        "tiene_a_cargo",
        "cant_a_cargo",
        "tipo_contrato",
        "turno",
        "es_jerarquico",
        "jubilacion",
        "afjp",
        "basico",
        "ubicacion",
        "obra_social",
        "horas",
        "caja_cirujia",
        "caja_partos",
        "activo",
        "estado"
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id"               => "integer",
        "nombre"           => "string",
        "photo"            => "string",
        "cuil"             => "string",
        "categoria"        => "integer",
        "subcategoria"     => "integer",
        "sexo"             => "string",
        "tipo_documento"   => "string",
        "numero_documento" => "string",
        "fecha_nacimiento" => "string",
        "matricula"        => "string",
        "direccion"        => "string",
        "localidad"        => "string",
        "telefono"         => "string",
        "celular"          => "string",
        "email"            => "string",
        "estado_civil"     => "string",
        "cant_hijos"       => "integer",
        "cant_hijos_disc"  => "integer",
        "hijos_escpres"    => "integer",
        "hijos_escprim"    => "integer",
        "hijos_escsec"     => "integer",
        "hijos_univer"     => "integer",
        "sindicato"        => "string",
        "nro_cuenta"       => "string",
        "fatsa"            => "string",
        "nro_afiliado"     => "integer",
        "conyugue"         => "string",
        "tiene_a_cargo"    => "string",
        "cant_a_cargo"     => "integer",
        "tipo_contrato"    => "string",
        "turno"            => "string",
        "es_jerarquico"    => "string",
        "jubilacion"       => "string",
        "afjp"             => "string",
        "ubicacion"        => "string",
        "obra_social"      => "string",
        "horas"            => "integer",
        "caja_cirujia"     => "string",
        "caja_partos"      => "string",
        "activo"           => "boolean",
        "estado"           => "string"
    ];

    public function ConceptosFijos()
    {
        return $this->belongsToMany('App\Models\Concepto', 'conceptofijo')->withPivot('importe', 'cantidad')->withTimestamps();
    }

    public function ConceptosVariables()
    {
        return $this->belongsToMany('App\Models\Concepto', 'conceptovariable')->withPivot('anio', 'mes', 'importe', 'cantidad')->withTimestamps();
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', 1);
    }
    public function scopeDelLegajo($query, $legajos)
    {
        $legajos= explode(',', $legajos);
        return $query->whereIn('id', $legajos);
    }

    public function setfecha_nacimientoAtribute($date)
    {

        $this->attributes['fecha_nacimiento'] = Carbon::parse($date);
    }

    public function setfecha_ingresoAtribute($date)
    {

        $this->attributes['fecha_ingreso'] = Carbon::parse($date);
    }


}
