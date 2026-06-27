<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // Seed Lab Admin
        User::create([
            'name' => 'Dr. Jane Smith (Lab Admin)',
            'email' => 'labadmin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'lab_admin',
        ]);

        // Seed Student
        User::create([
            'name' => 'John Doe (Student)',
            'email' => 'student@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'student',
        ]);
    }
}
