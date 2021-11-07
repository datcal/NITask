<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserTest extends TestCase
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
     * get user data.
     *
     * @return void
     */
    public function test_get_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer $this->token',
        ])->get('/api/user');

        $response->assertStatus(200);
    }

    /**
     * get user's orders.
     *
     * @return void
     */
    public function test_get_users_orders()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer $this->token',
        ])->get('/api/products');

        $response->assertStatus(200);
    }

    /**
     * add new order to user.
     *
     * @return void
     */
    public function test_add_new_order_to_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer $this->token',
        ])->post('/api/user/products',[
            'sku' => 'massive'
        ]);

        $response->assertStatus(201);
    }

    /**
     * delete order from user.
     *
     * @return void
     */
    public function test_delete_order_from_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer $this->token',
        ])->delete('/api/user/products/massive');

        $response->assertStatus(204);
    }
}
