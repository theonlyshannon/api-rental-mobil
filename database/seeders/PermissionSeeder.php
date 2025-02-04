<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'dashboard'],

            ['name' => 'user-management'],

            ['name' => 'permission-list'],

            ['name' => 'user-list'],
            ['name' => 'user-create'],
            ['name' => 'user-edit'],
            ['name' => 'user-delete'],

            ['name' => 'car-management'],

            ['name' => 'car-list'],
            ['name' => 'car-create'],
            ['name' => 'car-edit'],
            ['name' => 'car-delete'],

            ['name' => 'reservation-management'],

            ['name' => 'reservation-list'],
            ['name' => 'reservation-create'],
            ['name' => 'reservation-edit'],
            ['name' => 'reservation-delete'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $admin->givePermissionTo(Permission::all());

        $user->givePermissionTo([
            'dashboard',
            'user-list',
            'car-list',
            'reservation-list',
        ]);
    }
}
