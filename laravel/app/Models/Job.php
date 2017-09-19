<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Job extends Model
{
    
	public $table = "jobs";
    

	public $fillable = [
	    "queue",
		"payload",
		"attempts",
		"reserved",
		"reserved_at",
		"available_at",
		"created_at"
	];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "queue" => "string",
		"attempts" => "integer",
		"reserved" => "integer",
		"available_at" => "integer",
		"created_at" => "integer"
    ];

	public static $rules = [
	    "queue" => "required",
		"payload" => "attempts:integer",
		"attempts" => "required",
		"reserved" => "required",
		"reserved_at" => "required",
		"available_at" => "required",
		"created_at" => "required"
	];

}
