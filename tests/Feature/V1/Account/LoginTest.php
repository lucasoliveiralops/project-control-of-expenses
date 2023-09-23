<?php

namespace Tests\Feature\V1\Account;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_can_generate_valid_token_when_user_valid(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/v1/login', [
            "userMail" => $user->email,
            "password" => 'password'
        ]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        'accessToken',
                        'tokenType'
                    ]
                ]
            );
        $hasToken = count($user->tokens) > 0;
        $this->assertTrue($hasToken);
    }

    public function test_return_unauthorized_when_invalid_user(): void
    {
        $response = $this->post('/v1/login', [
            "userMail" => fake()->unique()->safeEmail(),
            "password" =>  fake()->name()
        ]);
        $response
            ->assertStatus(401);
    }
}
