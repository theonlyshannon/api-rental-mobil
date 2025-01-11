<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, softDeletes;

    protected $fillable =
    [
        'name',
        'image',
        'brand_name',
        'price_per_day',
        'stock'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
