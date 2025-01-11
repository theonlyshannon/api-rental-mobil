<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi',
            'string' => ':attribute harus berupa string',
            'max' => ':attribute maksimal :max karakter',
            'email' => ':attribute harus berupa alamat email yang valid',
            'unique' => ':attribute sudah terdaftar',
            'min' => ':attribute minimal :min karakter'
        ];
    }
}
