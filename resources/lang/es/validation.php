<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "El :attribute debe ser aceptado.",
	"active_url"           => "El :attribute no es una URL válida.",
	"after"                => "El :attribute debe ser una fecha después :date.",
	"alpha"                => "El :attribute sólo puede contener letras.",
	"alpha_dash"           => "El :attribute sólo puede contener letras , números y guiones.",
	"alpha_num"            => "El :attribute sólo puede contener letras y números.",
	"array"                => "El :attribute debe ser una coleccion.",
	"before"               => "El :attribute debe ser una fecha antes :date.",
	"between"              => [
		"numeric" => "El :attribute debe estar entre :min y :max.",
		"file"    => "El :attribute debe estar entre :min y :max kilobytes.",
		"string"  => "El :attribute debe estar entre :min y :max caracteres.",
		"array"   => "El :attribute debe estar entre :min y :max items.",
	],
	"boolean"              => "El :attribute campo debe ser verdadero o falso .",
	"confirmed"            => "El :attribute confirmación no coincide.",
	"date"                 => "El :attribute no es una fecha válida.",
	"date_format"          => "El :attribute no coincide con el formato :format.",
	"different"            => "El :attribute y :other debe ser diferente.",
	"digits"               => "El :attribute debe ser :digits digitos.",
	"digits_between"       => "El :attribute debe ser entre :min y :max digitos.",
	"email"                => "El :attribute debe ser una dirección de correo electrónico válida.",
	"filled"               => "El :attribute se requiere campo.",
	"exists"               => "El :attribute seleccionado es invalido.",
	"image"                => "El :attribute debe ser una imagen.",
	"in"                   => "El :attribute seleccionado es invalido.",
	"integer"              => "El :attribute debe ser un entero.",
	"ip"                   => "El :attribute debe ser una dirección IP válida.",
	"max"                  => [
		"numeric" => "El :attribute no puede ser mayor que :max.",
		"file"    => "El :attribute no puede ser mayor que :max kilobytes.",
		"string"  => "El :attribute no puede ser mayor que :max caracteres.",
		"array"   => "El :attribute no puede tener más de :max items.",
	],
	"mimes"                => "El :attribute debe ser un archivo de tipo: :values.",
	"min"                  => [
		"numeric" => "El :attribute al menos debe ser :min.",
		"file"    => "El :attribute al menos debe ser :min kilobytes.",
		"string"  => "El :attribute al menos debe ser :min characters.",
		"array"   => "El :attribute debe tener al menos :min items.",
	],
	"not_in"               => "El :attribute seleccionado es invalido.",
	"numeric"              => "El :attribute debe ser un numero.",
	"regex"                => "El :attribute formato es invalido.",
	"required"             => "El campo :attribute es requerido.",
	"required_if"          => "El campo :attribute es requerido cuando :other es :value.",
	"required_with"        => "El campo :attribute es requerido cuando :values esta presente.",
	"required_with_all"    => "El campo :attribute es requerido cuando :values esta presente.",
	"required_without"     => "El campo :attribute es requerido cuando :values no esta presente.",
	"required_without_all" => "El campo :attribute es requerido cuando ningun :values are present.",
	"same"                 => "El :attribute y :other deben coincidir.",
	"size"                 => [
		"numeric" => "El :attribute debe ser :size.",
		"file"    => "El :attribute debe ser :size kilobytes.",
		"string"  => "El :attribute debe ser :size caracteres.",
		"array"   => "El :attribute debe contener :size items.",
	],
	"unique"               => "El :attribute ya se ha tomado.",
	"url"                  => "El :attribute formato no es válido.",
	"timezone"             => "El :attribute debe ser una zona válida.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
