<?php

namespace Modules\Invoice\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoicesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testInvoiceCreation(): void
    {
        $user = User::factory()->admin()->create();
        $client = Client::factory()->create();
        $this->actingAs($user)->get(route('clients.create'))->assertStatus(200);
        
      

        // Step 3: Define the invoice data
        $invoiceData = [
            'client_id' => $client->id,
            'client_name' => $client->client_name,
            'client_email' => $client->email,
            'location' => $client->location,
            'billing_cycle' => $client->billing_cycle,
            'amount' => $client->amount,
            'due_date' => now()->addDays(7),
        ];

        $this->get(route('invoices.create', ['client_id' => $client->id]))
        ->assertStatus(200);
        $response = $this->post(route('invoices.store', ['client_id' => $client->id]), $invoiceData);

       
        $this->assertDatabaseHas('invoices', [
            'client_id' => $client->id,
            'client_name' => $client->client_name,
            'amount' => $client->amount,
        ]);

        // Step 6: Assert the user is redirected to the invoices index page
        $response->assertRedirect(route('invoices.index'));
    }
    }

