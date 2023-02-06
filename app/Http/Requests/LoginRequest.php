<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;

class LoginRequest extends Request
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules['password'] = ['required'];
		$rules['email'] = ['required'];

		return $rules;
	}
}
