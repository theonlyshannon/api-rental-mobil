<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $env = config('app.env');

        if ($env === 'local') {
            $this->call([
                UserSeeder::class,
                CarSeeder::class,
                ReservationSeeder::class,
            ]);
        }
    }
}
