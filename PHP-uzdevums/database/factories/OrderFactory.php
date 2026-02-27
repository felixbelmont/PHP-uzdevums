<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

class OrderFactory extends Factory
{
    protected $model = \App\Models\Order::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'status' => $this->faker->randomElement(['pending','processing','done','canceled']),
            'total' => $this->faker->randomFloat(2, 10, 500),
            'notes' => $this->faker->sentence(),
            'user_id' => 1,
        ];
    }
}