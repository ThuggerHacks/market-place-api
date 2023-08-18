<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "description" => ["required","min:10","max:5000"],
            "title" => ["required","min:2","max:160"],
            "price" => ["required"],
            "category_id" => "required",
            "user_id" => "required"
        ];
    }

    public function messages(){
        return [
            "description.min" => "A descricao deve ter pelomenos :min caracteres",
            "description.max" => "A descricao deve ter ate :max caracteres",
            "title.min" => "O titulo deve ter pelomenos :min  caracteres",
            "title.max" => "O titulo deve ter ate  :max caracteres",
            "title.required" => "O titulo deve ser preenchido",
            "price.required" => "Por favor insira o preco",
            "category_id.required" => "Por favor insira a categoria",
            "user_id.required" => "Por favor insira id do utilizador"
        ];
    }
}
