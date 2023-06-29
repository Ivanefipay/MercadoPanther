<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

	public function rules(): array
    {
        return [
            'name' => ['required','string'],
            'last_name' => ['required','string'],
			'number_id' => ['required', 'numeric', "unique:users,number_id,{$this->user->id}"],
			'email' => ['required','email','unique:users,email'],
			'password' => ['nullable','string','min:8','confirmed'],
        ];
    }

	public function messages()
	{
		return[
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre no es valido',

			'last_name.required' => 'El apellido es requerido',
			'last_name.string' => 'El apellido no es valido',

			'number_id.required' => 'El documento es requerido',
			'number_id.string' => 'El documento no es un numero',
			'number_id.unique' => 'El documento ya existe',

			'email.required' => 'El correo es requerido',
			'email.email' => 'El correo no es valido',
			'email.unique' => 'El correo ya existe',

			'password.string' => 'la contraseña no es valida',
			'password.min' => 'la contraseña debe tener minimo 8 caracteres',
			'password.confirmed' => 'la contraseña no coincide',

		];
	}
}
