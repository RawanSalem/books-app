<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomFormRequest;

class UpdateBookRequest extends CustomFormRequest
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
            'name'         => 'string|max:60',
            'author_id'    => 'exists:authors,id',
            'ISBN'         => 'digits:10|unique:books',
            'publish_date' => 'date',
            'pages'        => 'integer',
        ];
    }
}
