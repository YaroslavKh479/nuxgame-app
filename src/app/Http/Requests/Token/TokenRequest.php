<?php

namespace App\Http\Requests\Token;

use Illuminate\Foundation\Http\FormRequest;

class TokenRequest extends FormRequest
{

    public function prepareForValidation(): void
    {
        $this->merge([
            'token' => $this->route('token'),
        ]);
    }


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
