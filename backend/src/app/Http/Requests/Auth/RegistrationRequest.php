<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'min:2', 'max:50'],
            'phone'    => ['required', 'string', 'min:1','max:50'],
        ];
    }

    public function messages(): array
    {
        return [];
    }

}
