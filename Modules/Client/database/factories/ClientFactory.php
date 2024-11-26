<?php


namespace Modules\Client\Database\Factories;


use Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
            

            return [
                'client_name' => $this->faker->company,
                'facility_level' => $this->faker->randomElement(['1', '2', '3','4','5','6','7',]),
                'location' => $this->faker->address,
                'client_email' => $this->faker->safeEmail,
                'billing_cycle' => $this->faker->randomDigit(),
                'amount' => $this->faker->randomFloat(2, 1000, 100000), // Random amount between 1000 and 100000
                'contact_name' => $this->faker->name,
                'contact_phone' => $this->faker->numerify('##########'),
                'support_engineer_name' => $this->faker->name,
                'support_engineer_phone' => $this->faker->numerify('##########'),
                'support_engineer_email' => $this->faker->unique()->email,
            ];
            
    
    }
   
}
