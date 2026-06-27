<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Lab;
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
        $departments = [
            'cse',
            'eee',
            'ece',
            'mse',
            'bme',
            'me',
            'mte',
            'ese',
            'le',
            'te',
            'ce',
            'becm',
            'upr',
            'architecture',
        ];

        foreach ($departments as $departmentName) {
            $department = Department::updateOrCreate([
                'name' => $departmentName,
            ]);

            $starterLabs = [
                'cse' => ['Programming Lab'],
                'eee' => ['Power Systems Lab'],
                'ece' => ['Electronics Lab'],
                'mse' => ['Materials Lab'],
                'bme' => ['Biomedical Lab'],
                'me' => ['Mechanics Lab'],
                'mte' => ['Manufacturing Lab'],
                'ese' => ['Energy Systems Lab'],
                'le' => ['Language Lab'],
                'te' => ['Textile Lab'],
                'ce' => ['Civil Lab'],
                'becm' => ['Construction Management Lab'],
                'upr' => ['Planning Lab'],
                'architecture' => ['Design Studio'],
            ];

            foreach ($starterLabs[$departmentName] ?? [] as $labName) {
                Lab::updateOrCreate(
                    [
                        'department_id' => $department->id,
                        'name' => $labName,
                    ],
                    []
                );
            }
        }

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
