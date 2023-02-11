<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo no es válido',
            'email.exists' => 'Esa cuenta no existe',
            'password.required' => 'La contraseña es requerida'
        ];
    }

}
