<?php

namespace Modules\Invoice\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Modules\Client\Models\Client;
use Modules\Invoice\Models\Invoice;

use Illuminate\Support\Facades\Mail;
use Modules\Invoice\Emails\InvoiceMail;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class)->in(__DIR__);




//tests fo creating an invoice
    it('can create an invoice for a client', function () {
        $user = User::factory()->admin()->create();
        $this->actingAs($user)->get(route('clients.create'))->assertStatus(200);
        
      

        // Step 3: Define the invoice data
        $client = Client::factory()->create();
        $invoiceData = Invoice::factory()->create(['client_id' => $client->id]);
        $this->assertDatabaseHas('invoices', [
            'client_id' => $client->id,
            'client_name' => $invoiceData['client_name'],
            'client_email' => $invoiceData['client_email'],
            'amount' => $invoiceData['amount'],
        ]);
    });





    //tests for sending email
    it('can send an invoice as email to the client', function () {
            Mail::fake();
        
            $user = User::factory()->admin()->create();
            $client = Client::factory()->create();
            $this->actingAs($user)->get(route('clients.create'))->assertStatus(200);
            
          
    
            // Step 3: Define the invoice data
            $client = Client::factory()->create();
            $invoiceData = Invoice::factory()->create(['client_id' => $client->id]);
            $this->assertDatabaseHas('invoices', [
                'client_id' => $client->id,
                'client_name' => $invoiceData['client_name'],
                'client_email' => $invoiceData['client_email'],
                'amount' => $invoiceData['amount'],
            ]);

            
            
            // Assert the email was sent
            Mail::assertSent(InvoiceMail::class, function ($mail) use ($client) {
                return $mail->hasTo($client->client_email);
            });
        }

    );
    



