<?php

use Modules\Client\Models\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;




uses(RefreshDatabase::class);


//test for viewing the create page for subscriptions
it('can render the subscription create page for a specific client', function () {
    // Create a client
    $client = Client::factory()->create();

    // Access the create page route
    $response = $this->get(route('subscriptions.create', ['clientId' => $client->id]));

    // Assert that the response is a successful render of the page
    $response->assertStatus(200);

    // Assert that the view contains specific data, like the client's name
    $response->assertSee($client->name);
});







//test to create a subscription for a client.
it('creates a subscription for a specific client', function () {
    // Create a fake client
    $client = Client::factory()->create(['amount' => 5000.00]);

    // Define the subscription data
    $subscriptionData = [
        'amount' => $client->amount, // Amount is auto-filled from the client
        'start_date' => now()->format('Y-m-d'),
        'end_date' => now()->addYear()->format('Y-m-d'),
        'payment_status' => 1, 
    ];

    // Send a POST request to create the subscription
    $response = $this->post(route('subscriptions.store', ['clientId' => $client->id]), $subscriptionData);

    // Assert the subscription was stored in the database
    $this->assertDatabaseHas('subscriptions', [
        'client_id' => $client->id,
        'amount' => $client->amount,
        'start_date' => $subscriptionData['start_date'],
        'end_date' => $subscriptionData['end_date'],
        'payment_status' => $subscriptionData['payment_status'],
    ]);

    // Assert redirection after successful creation
    $response->assertRedirect(route('clients.index'));
});
