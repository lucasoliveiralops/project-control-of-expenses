<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Expenses;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expenses>
 */
class ExpensesFactory extends Factory
{

    protected $model = Expenses::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description_expense' =>  fake()->sentence(rand(1, 15)),
            'user_id' =>  User::factory(),
            'value_expense' => fake()->randomFloat(2,2),
            'date_expense' => date('Y-m-d'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
