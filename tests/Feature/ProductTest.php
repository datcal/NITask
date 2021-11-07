<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProductTest extends TestCase
{
    use RefreshDatabase;
    protected $token;
    public function setUp(): void
    {
        parent::setUp();
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

        $this->token = $response->getData()->token;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_all_products()
    {

        $response = $this->withHeaders([
            'Authorization' => 'Bearer $this->token',
        ])->get('/api/products');

        $response->assertStatus(200);
    }
}
