<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
}
