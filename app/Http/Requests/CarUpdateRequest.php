<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255' . $this->route('cars'),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand_name' => 'nullable|string|max:255',
            'price_per_day' => 'nullable|numeric',
            'stock' => 'nullable|integer'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'image' => 'Gambar',
            'brand_name' => 'Merek',
            'price_per_day' => 'Harga per Hari',
            'stock' => 'Stok'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi',
            'string' => ':attribute harus berupa string',
            'max' => ':attribute maksimal :max karakter',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar dengan format: :values',
            'max_size' => ':attribute maksimal :max KB',
            'numeric' => ':attribute harus berupa angka',
            'integer' => ':attribute harus berupa angka bulat'
        ];
    }
}
