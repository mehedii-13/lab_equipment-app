<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'superadmin2@example.com'],
            [
                'name' => 'Super Admin 2',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
            ]
        );
    }
}
