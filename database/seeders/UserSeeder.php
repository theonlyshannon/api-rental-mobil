<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User-1',
                'email' => 'user1@gmail.com',
                'password' => 'password'
            ],
            [
                'name' => 'User-2',
                'email' => 'user2@gmail.com',
                'password' => 'password'
            ],
            [
                'name' => 'User-3',
                'email' => 'user3@gmail.com',
                'password' => 'password'
            ],
            [
                'name' => 'User-4',
                'email' => 'user4@gmail.com',
                'password' => 'password'
            ],
            [
                'name' => 'User-5',
                'email' => 'user5@gmail.com',
                'password' => 'password'
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
