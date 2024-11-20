<?php

namespace Modules\Invoice\Tests\Feature;

use App\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create an invoice', function () {
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get(route('clients.create'))->assertStatus(200);
    
    $client = Client::factory()->create();
    
    $invoiceData = [
        'client_id' => $client->id,
        'client_name' => $client->name,
        'client_email' => $client->email,
        'location' => $client->location,
        'billing_cycle' => $client->billing_cycle,
        'amount' => $client->amount,
        'due_date' => now(),
    ];

    // Create the invoice
    $response = $this->post(route('invoices.store'), $invoiceData);

    // Assert that the invoice is saved in the database
    $this->assertDatabaseHas('invoices', [
        'client_id' => $client->id,
        'client_name' => $client->name,
        'amount' => $client->amount,
    ]);

    $response->assertRedirect(route('invoices.index'));
});
