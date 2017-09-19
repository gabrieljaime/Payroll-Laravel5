<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\concepto_revista;

class Createconcepto_revistaRequest extends Request {

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
		return concepto_revista::$rules;
	}

}
