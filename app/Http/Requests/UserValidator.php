<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "min:3", "max:160"],
            "email" => ["required", "min:6", "max:170", "email"],
            "phone" => ["regex:/^(\\+?(258)?8(2|3|4|5|6|7)[0-9]{7})?$/"],
            "password" => ["required", "min:6", "max:16"]
        ];

    }

    public function messages()
    {
        return [
            "name.required" => "Por favor insira o seu nome",
            "name.min" => "O nome deve ter no minimo :min caracteres",
            "name.max" => "O nome deve ter no maximo :max caracteres",
            "email.email" => "O email deve ser valido",
            "email.min" => "O email deve ter no minimo :min caracteres",
            "email.max" => "O email deve ter no maximo :max caracteres",
            "email.required" => "O email deve ser preenchido",
            "password.required" => "A senha deve ser preenchida",
            "password.min" => "A senha deve ter no minimo :min caracteres",
            "password.max" => "A senha deve ter no maximo :max caracteres"
        ];
    }
}