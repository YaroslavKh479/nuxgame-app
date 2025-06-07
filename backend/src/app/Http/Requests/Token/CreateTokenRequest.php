<?php

namespace App\Http\Requests\Token;

use Illuminate\Foundation\Http\FormRequest;

class CreateTokenRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            'token'          => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [];
    }

}
