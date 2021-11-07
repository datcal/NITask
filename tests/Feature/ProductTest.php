<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProductTest extends TestCase
{
   // use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_all_products()
    {

        //$this->seed();

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

        $token = $response->getData()->token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer $token',
        ])->get('/api/products');

        $response->assertStatus(200);
    }
}
