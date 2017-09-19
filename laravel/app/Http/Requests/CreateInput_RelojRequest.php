<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Input_Reloj;

class CreateInput_RelojRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return Input_Reloj::$rules;
	}

}
