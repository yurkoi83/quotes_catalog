<?php

namespace App\Http\Requests;

use App\Rules\EmailRule;

class QuoteRequest extends Request
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $input = $this->all();
        if ($this->has('messenger')) {
            if ($this->filled('messenger') && $this->get('messenger') == 'viber') {
                $input['to'] = phoneFormatInt($this->input('to'));
            }
        }

        request()->merge($input);
        $this->merge($input);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        if ($this->filled('to')) {
            $rules['to'][] = ['required', 'string'];
            $rules['messenger'][] = ['required', 'string'];
            $rules['type'][] = ['required', 'string'];
            // email
            if ($this->get('messenger') == 'email') {
                $rules['to'][] = 'email';
                $rules['to'][] = new EmailRule();
            }
        }

        if ($this->filled('text')) {
            $rules['text'][] = ['required', 'string', 'unique:quotes,text'];
        }

        return $rules;
    }
}
