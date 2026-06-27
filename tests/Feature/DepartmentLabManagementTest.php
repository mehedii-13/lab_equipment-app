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

    public function test_super_admin_can_update_department_name(): void
    {
        $department = Department::create(['name' => 'cse']);

        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'password',
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($superAdmin)->patch("/super-admin/departments/{$department->id}", [
            'name' => 'computer science',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => 'computer science',
        ]);
    }

    public function test_super_admin_can_update_lab_name_and_sync_users(): void
    {
        $department = Department::create(['name' => 'eee']);
        $lab = Lab::create([
            'department_id' => $department->id,
            'name' => 'Power Systems Lab',
        ]);

        $labAdmin = User::factory()->create([
            'name' => 'Lab Admin',
            'email' => 'labadmin@example.com',
            'password' => 'password',
            'role' => 'lab_admin',
            'department_id' => $department->id,
            'lab_id' => $lab->id,
            'lab_name' => 'Power Systems Lab',
        ]);

        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'password',
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($superAdmin)->patch("/super-admin/labs/{$lab->id}", [
            'department_id' => $department->id,
            'name' => 'Electrical Machines Lab',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('labs', [
            'id' => $lab->id,
            'department_id' => $department->id,
            'name' => 'Electrical Machines Lab',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $labAdmin->id,
            'department_id' => $department->id,
            'lab_id' => $lab->id,
            'lab_name' => 'Electrical Machines Lab',
        ]);
    }
}
