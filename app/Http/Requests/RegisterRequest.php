<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomFormRequest;

class RegisterRequest extends CustomFormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        return [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'username' => 'required|string|between:6,100|unique:users,username|alpha_dash'
        ];
    }

}
