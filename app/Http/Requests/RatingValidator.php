<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingValidator extends FormRequest
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
            "user_id" => "required",
            "rating_comments" => "required",
            "rating_number" => "required"
        ];
    }

    public function messages(){
        return [
            "user_id.required" => "Utilizador nao eh valido",
            "rating_comments.required" => "Por favor insira um comentario",
            "rating_number.required" => "Por favor selecione a sua avaliacao"
        ];
    }
}
