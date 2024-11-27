<?php

use App\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


//test for viewing the index pages for clients.
it('can render index page for clients', function(){
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/clients')->assertStatus(200);

});


//test for viewing the create page for cients
it('can render the create page for clients', function(){
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/clients/create')->assertStatus(200);
});


//test for creating a new client.
it('creates a new client', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/clients/create')->assertStatus(200);


    $clientData = Client::factory()->make([
        'client_email' => 'valid.email@gmail.com', // Override with a valid email
        'support_engineer_email' => 'engineer.email@gmail.com',
    ])->toArray(); // Generate fake data

    $response = $this->post(route('clients.store'), $clientData); 

    $response->assertRedirect(route('clients.index')); // Redirect to index page
    $this->assertDatabaseHas('clients', [
        'client_name' => $clientData['client_name'],
    ]); // Verify data exists in database
});


//test to show details of a client.
it('can show details of a client', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user);

    $client = Client::factory()->create(); // Create a client

    $response = $this->get(route('clients.show', $client->id)); 

    $response->assertStatus(200);
    $response->assertViewIs('client::show'); // Ensure the view name matches
    $response->assertSeeText($client->client_name); // Verify client name is displayed
});



//test to do soft delete for a client.
it('can soft delete a client', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user);
    $client = Client::factory()->create(); // Create a client

    $response = $this->delete(route('clients.destroy', $client->id)); 

    $response->assertRedirect(route('clients.index')); // Redirect to index page
    $this->assertSoftDeleted('clients', ['id' => $client->id]); // Verify soft delete
});




//test to restore soft deleted client.

it('can restore a soft-deleted client', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user);

    // Create a client and soft delete it
    $client = Client::factory()->create();
    $client->delete(); // Soft delete the client

    // Ensure the client is soft-deleted
    $this->assertNotNull($client->deleted_at);

    // Perform a PUT request to restore the client
    $response = $this->put(route('clients.restore', $client->id));

    // Ensure the client is restored
    $client->refresh(); // Refresh the model to get the updated state

    // Assert that 'deleted_at' is null (client is restored)
    $this->assertNull($client->deleted_at);

 
});


