<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

abstract class Request extends FormRequest
{
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
	 * Handle a failed validation attempt.
	 *
	 * @param Validator $validator
	 * @throws ValidationException
	 */
	protected function failedValidation(Validator $validator)
	{
		if ($this->ajax() || $this->wantsJson() || in_array($this->segment(1), ['send', 'api']) ) {
			// Get Errors
			$errors = (new ValidationException($validator))->errors();

			$message = 'An error occurred while validating the data ' . $this->get('messenger');

            $data = [
                'success' => false,
                'message' => $message,
                'errors'  => $errors,
            ];

			throw new HttpResponseException(response()->json($data, Response::HTTP_UNPROCESSABLE_ENTITY));
		}

		parent::failedValidation($validator);
	}
}
