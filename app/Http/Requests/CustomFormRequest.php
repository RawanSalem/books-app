<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomFormRequest extends FormRequest
{
    /**
     * Validation Failed.
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) : void
    {
        throw new HttpResponseException(
            response()
                ->json(['status' => 422,'error' => $validator->errors()], 422)
        );
    }
}
