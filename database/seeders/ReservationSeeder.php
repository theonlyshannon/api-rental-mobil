<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $cars = Car::all();

        if ($users->isEmpty() || $cars->isEmpty()) {
            $this->command->info('Tabel users atau cars kosong. Harap tambahkan data terlebih dahulu.');
            return;
        }

        foreach ($users as $user) {
            Reservation::create([
                'user_id' => $user->id,
                'car_id' => $cars->random()->id,
                'start_date' => now()->addDays(rand(1, 7)),
                'end_date' => now()->addDays(rand(8, 14)),
                'proof_of_payment' => 'dummy_proof_' . $user->id . '.jpg',
                'payment_status' => collect(['pending', 'waiting', 'success'])->random(),
                'status' => collect(['pending', 'on_the_road', 'completed'])->random(),
            ]);
        }

        $this->command->info('Data reservasi berhasil ditambahkan.');
    }
}
