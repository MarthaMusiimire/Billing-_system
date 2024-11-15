<?php

namespace Modules\Client\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Client\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientData = [
            'client_name' => 'Jane Health Solutions',
            'facility_level' => '3',
            'location' => '123 Main St, Kyanja, Kampala',
            'client_email' => 'musiimiremartha@gmail.com',
            'billing_cycle' => 2,
            'amount' => 50000.00,
            'contact_name' => 'Jane',
            'contact_phone' => '0701123456',
            'support_engineer_name' => 'John Smith',
            'support_engineer_phone' => '0772987654',
            'support_engineer_email' => 'johnsmith@gmail.com',
    
        ];

        //inserting client data into the database.
        Client::create($clientData);
    }

}
