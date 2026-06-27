<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_creates_a_user_in_the_database(): void
    {
        $response = $this->post('/register', [
            'name' => 'Alex Johnson',
            'email' => 'alex@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'student',
        ]);

        $response->assertRedirect('/student/dashboard');

        $this->assertDatabaseHas('users', [
            'name' => 'Alex Johnson',
            'email' => 'alex@example.com',
            'role' => 'student',
        ]);

        $user = User::where('email', 'alex@example.com')->firstOrFail();
        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertAuthenticatedAs($user);
    }
}
