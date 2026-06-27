<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Lab;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabAdminCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_create_lab_admin_with_lab_name(): void
    {
        $department = Department::create(['name' => 'cse']);
        $lab = Lab::create([
            'department_id' => $department->id,
            'name' => 'Programming Lab',
        ]);

        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'password',
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($superAdmin)->post('/super-admin/users', [
            'name' => 'Lab Manager',
            'email' => 'manager@example.com',
            'department_id' => $department->id,
            'lab_id' => $lab->id,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'lab_admin',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'Lab Manager',
            'email' => 'manager@example.com',
            'role' => 'lab_admin',
            'department_id' => $department->id,
            'lab_id' => $lab->id,
        ]);
    }
}
