<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Lab;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentLabManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_create_department(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'password',
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($superAdmin)->post('/super-admin/departments', [
            'name' => 'cse',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('departments', [
            'name' => 'cse',
        ]);
    }

    public function test_super_admin_can_create_lab_under_a_department(): void
    {
        $department = Department::create(['name' => 'eee']);

        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'password',
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($superAdmin)->post('/super-admin/labs', [
            'department_id' => $department->id,
            'name' => 'Power Systems Lab',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('labs', [
            'department_id' => $department->id,
            'name' => 'Power Systems Lab',
        ]);
    }
}
