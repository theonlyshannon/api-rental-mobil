<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'proof_of_payment' => 'required|image',
            'payment_status' => 'required|in:pending,waiting,success',
            'status' => 'required|in:pending,on_the_road,completed',
        ];
    }

    public function attributes()
    {
        return [
            'car_id' => 'Mobil',
            'user_id' => 'Pengguna',
            'start_date' => 'Tanggal Mulai',
            'end_date' => 'Tanggal Selesai',
            'proof_of_payment' => 'Bukti Pembayaran',
            'payment_status' => 'Status Pembayaran',
            'status' => 'Status',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi',
            'exists' => ':attribute tidak ditemukan',
            'date' => ':attribute harus berupa tanggal',
            'after' => ':attribute harus setelah :date',
            'image' => ':attribute harus berupa gambar',
            'in' => ':attribute harus salah satu dari: :values',
        ];
    }
}
