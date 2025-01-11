<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'car' => [
                'id' => $this->car->id,
                'name' => $this->car->name,
                'brand_name' => $this->car->brand_name,
            ],
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'proof_of_payment' => $this->proof_of_payment,
            'payment_status' => $this->payment_status,
            'status' => $this->status,
        ];
    }
}
