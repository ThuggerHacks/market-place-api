<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageValidator extends FormRequest
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
            "receiver_id" => "required",
            "sender_id" => "required",
            "message" => "required|min:1",
            "chat_id" => "required"
        ];
    }

    public function messages(){
        return [
            "receiver_id.required" => "Por favor insira o receptor",
            "sender_id.required" => "Por favor insira o emissor",
            "message.required" => "Por favor escreva a mensagem",
            "message.min" => "A mensagem deve ter pelomenis :min caracteres",
            "chat_id.required" => "Por favor indique a conversa na qual a mensagem pertence"    
        ];
    }
}
