<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'Car 1',
                'image' => 'car1.jpg',
                'brand_name' => 'Brand 1',
                'price_per_day' => 100.00,
                'stock' => 10
            ],
            [
                'name' => 'Car 2',
                'image' => 'car2.jpg',
                'brand_name' => 'Brand 2',
                'price_per_day' => 200.00,
                'stock' => 20
            ],
            [
                'name' => 'Car 3',
                'image' => 'car3.jpg',
                'brand_name' => 'Brand 3',
                'price_per_day' => 300.00,
                'stock' => 30
            ],
            [
                'name' => 'Car 4',
                'image' => 'car4.jpg',
                'brand_name' => 'Brand 4',
                'price_per_day' => 400.00,
                'stock' => 40
            ],
            [
                'name' => 'Car 5',
                'image' => 'car5.jpg',
                'brand_name' => 'Brand 5',
                'price_per_day' => 500.00,
                'stock' => 50
            ]
        ];

        foreach ($cars as $car) {
            \App\Models\Car::create($car);
        }
    }
}
