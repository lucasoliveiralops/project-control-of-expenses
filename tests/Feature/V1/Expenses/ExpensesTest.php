<?php

namespace Tests\Feature\V1\Expenses;

use App\Models\Expenses;
use App\Models\User;
use Database\Factories\ExpensesFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpensesTest extends TestCase
{

    use RefreshDatabase;

    public function test_create_expenses_when_correct_data(): void
    {
        $berearToken = $this->generateBarearToken();
        $response = $this->withToken($berearToken)
            ->json(
                'POST',
                '/v1/expenses',
                [
                    'description' => fake()->sentence(15),
                    'date' => date('Y-m-d'),
                    'value' => fake()->randomFloat(2, 2)
                ],
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(201);
    }

    public function test_create_expenses_when_invalid_data_future_date(): void
    {
        $berearToken = $this->generateBarearToken();
        $response = $this->withToken($berearToken)
            ->json(
                'POST',
                '/v1/expenses',
                [
                    'description' => fake()->sentence(15),
                    'date' =>  date('Y-m-d', strtotime('+1 days')),
                    'value' => fake()->randomFloat(2, 2)
                ],
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(422);
    }

    public function test_create_expenses_when_multiple_invalid_data(): void
    {
        $berearToken = $this->generateBarearToken();
        $response = $this->withToken($berearToken)
            ->json(
                'POST',
                '/v1/expenses',
                [
                    'description' => fake()->sentence(145),
                    'date' =>  date('Y-m-d', strtotime('+51 days')),
                    'value' => fake()->randomFloat(5)
                ],
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(422);
    }

    public function test_update_expenses_when_correct_data(): void
    {
        $berearToken = $this->generateBarearToken();
        $expense = Expenses::factory()
            ->for($this->userToken)
            ->create();
        $response = $this->withToken($berearToken)
            ->json(
                'PUT',
                "/v1/expenses/{$expense->id}",
                [
                    'description' => fake()->sentence(rand(1, 15)),
                    'date' => date('Y-m-d'),
                    'value' => fake()->randomFloat(2, 2)
                ],
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(200);
    }

    public function test_update_expenses_when_data_is_another_user(): void
    {
        $berearToken = $this->generateBarearToken();
        $expense = Expenses::factory()
            ->for(User::factory()->create())
            ->create();
        $response = $this->withToken($berearToken)
            ->json(
                'PUT',
                "/v1/expenses/{$expense->id}",
                [
                    'description' => fake()->sentence(rand(1, 15)),
                    'date' => date('Y-m-d'),
                    'value' => fake()->randomFloat(2, 2)
                ],
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(403);
    }

    public function test_update_expenses_when_invalid_data(): void
    {
        $berearToken = $this->generateBarearToken();
        $expense = Expenses::factory()
            ->for($this->userToken)
            ->create();
        $response = $this->withToken($berearToken)
            ->json(
                'PUT',
                "/v1/expenses/{$expense->id}",
                [
                    'description' => fake()->sentence(rand(40, 55)),
                    'date' => date('Y-m-d'),
                    'value' => fake()->randomFloat(50, 30)
                ],
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(422);
    }

    public function test_listing_return_not_content_when_user_empty(): void
    {
        $berearToken = $this->generateBarearToken();
        $response = $this->withToken($berearToken)
            ->json(
                'GET',
                "/v1/expenses",
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(204);
    }

    public function test_listing_expenses_when_user_has_expenses(): void
    {
        $berearToken = $this->generateBarearToken();
        $randNumber = rand(5, 35);
        Expenses::factory($randNumber)
            ->for($this->userToken)
            ->create();
        Expenses::factory($randNumber)
            ->for(User::factory()->create())
            ->create();
        $response = $this->withToken($berearToken)
            ->json(
                'GET',
                "/v1/expenses",
                self::DEFAULT_HEADERS
            );
        $items = json_decode($response->getContent());
        $response->assertStatus(200);
        $this->assertTrue(count($items->data) == $randNumber);
    }


    public function test_show_expenses_when_invalid_code(): void
    {
        $berearToken = $this->generateBarearToken();
        $randNumber = rand(25, 500);
        $response = $this->withToken($berearToken)
            ->json(
                'GET',
                "/v1/expenses/{$randNumber}",
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(404);
    }

    public function test_show_expenses_when_valid_user(): void
    {
        $berearToken = $this->generateBarearToken();
        $expense = Expenses::factory()
        ->for($this->userToken)
        ->create();
        $response = $this->withToken($berearToken)
            ->json(
                'GET',
                "/v1/expenses/{$expense->id}",
                self::DEFAULT_HEADERS
            );
        $response->assertStatus(200);
    }

}
