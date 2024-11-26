<?php

namespace Modules\Invoice\Database\Factories;

use Modules\Client\Models\Client;
use Modules\Invoice\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), // Creates a related client
            'client_name' => $this->faker->name,
            'client_email' => $this->faker->safeEmail,
            'location' => $this->faker->address,
            'billing_cycle' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomFloat(1, 50), 
            'due_date' => now(), 
        ];
    }
}

