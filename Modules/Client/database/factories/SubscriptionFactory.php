<?php

namespace Modules\Client\Database\Factories;

use Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Client\Models\Subscription::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [

            'client_id' => Client::factory(), 
            'amount' => $this->faker->randomFloat(2, 50), 
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'), 
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'), // Random date in the next month
            'payment_status' => $this->faker->randomElement([0, 1]), // Random status
        ];
    }
}

