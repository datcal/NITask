<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Login with username and password.
     *
     * @return void
     */
    public function test_login_with_username_and_password()
    {
        $this->seed();

        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson(
            '/api/auth',
            [
                'email' => $user->email,
                'password' => 'password'
            ]
        );

        $response->assertStatus(200);
    }
}
