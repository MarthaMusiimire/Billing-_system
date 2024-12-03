
<?php

use App\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a new client successfully using the factory', function () {
    // Create an admin user and authenticate them
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/clients')->assertStatus(200);

    // Generate client data using the factory
    $data = Client::factory()->make([
        'client_name' => 'Agape',
        'facility_level' => '1',
        'location' => 'Kampala',
        'client_email' => 'musiimiremartha@gmail.com',
        'billing_cycle' => 2,
        'amount' => 5000, // A valid numeric value
        'contact_name' => 'Marie',
        'contact_phone' => '0774355670',
        'support_engineer_name' => 'Marie',
        'support_engineer_phone' => '0774355670',
        'support_engineer_email' => 'martha@gmail.com',
    ])->toArray(); // Convert to an array for the JSON request

    // Send a POST request to the endpoint with the generated data
    $response = $this->postJson('/clients', $data);

    // Assert that the response has a 201 status code
    $response->assertStatus(302);
    $response->assertRedirect('/clients');

    // Assert that the client exists in the database
    $this->assertDatabaseHas('clients', [
        'client_email' => $data['client_email'], // Check against a unique field
        'client_name' => $data['client_name'],
    ]);
});

