<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_registration_requires_the_kuet_domain(): void
    {
        $response = $this->post('/register', [
            'name' => 'Ali Rahman',
            'email' => 'ali@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertDatabaseMissing('users', [
            'email' => 'ali@gmail.com',
        ]);
    }

    public function test_super_admin_can_create_privileged_users(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'password',
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($superAdmin)->post('/super-admin/users', [
            'name' => 'Lab Manager',
            'email' => 'manager@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'lab_admin',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'Lab Manager',
            'email' => 'manager@example.com',
            'role' => 'lab_admin',
        ]);
    }
}
