<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class SignupRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required', 
                'string', 
                'min:6',                 
                Rules\Password::min(6)
                    ->letters()
                    ->symbols()
                    ->numbers(),
                'confirmed'
            ],
        ];
    }

    public function messages()
    {
        return [
            'name' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El usuario ya está registrado',
            'password' => 'La contraseña debe tener al menos 6 caracteres, una letra, un número y un símbolo',
        ];
    }

}
