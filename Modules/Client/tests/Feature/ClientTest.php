<?php

use Tests\TestCase;
use App\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Ensure tests use Laravel's TestCase with database refresh.
uses(TestCase::class, RefreshDatabase::class)->in(__DIR__);

// Test if the Clients index page can be rendered.
it('can render the clients index page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('clients.index'));
    $response->assertStatus(200);
    $response->assertSee('Clients');
});

// Test creating a new client.
it('can create a new client', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get(route('clients.create'))->assertStatus(200);

    $clientData = Client::factory()->make();
    $response = $this->post(route('clients.store'), $clientData->toArray());
  

    $response->assertStatus(302);
    $response->assertRedirect(route('clients.index'));

    $this->assertDatabaseHas('clients', [
        'client_name' => $clientData['client_name'],
        'client_email' => $clientData['client_email'],
    ]);
});

// Test viewing a client.
it('can show details of a client', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get(route('clients.create'))->assertStatus(200);
    

    $clientData = Modules\Client\Models\Client::factory()->create();

    $response = $this->get(route('clients.show', $clientData->id));
    $response->assertStatus(200);
    $response->assertSee($clientData->client_name);
});

// Test updating a client.
it('can update a client', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $client = Modules\Client\Models\Client::factory()->create();
    $this->assertDatabaseHas('clients', [
        'client_name' => $client['client_name'],
        'client_email' => $client['client_email'],
    ]);

    $updatedData = [
        'client_name' => 'Updated Client Name',
        'location' => 'Updated Location',

    ];

    $response = $this->put(route('clients.update', $client->id), $updatedData);
    $response->dumpSession();//to check for any validation errors
    $response->assertStatus(302);
    $response->assertRedirect(route('clients.index'));

    $this->assertDatabaseHas('clients', [
        'id' => $client->id,
        'client_name' => 'Updated Client Name',
        'location' => 'Updated Location',
    ]);
});

// Test deleting a client.
it('can delete a client', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $client = Modules\Client\Models\Client::factory()->create();

    $response = $this->delete(route('clients.destroy', $client->id));
    $response->assertStatus(302);

    $this->assertSoftDeleted('clients', ['id' => $client->id]);
});
