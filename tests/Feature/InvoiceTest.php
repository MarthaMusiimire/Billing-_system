<?php

use App\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Support\Facades\Mail;
use Modules\Invoice\Emails\InvoiceMail;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);



//test for viewing the create page for invoices
it('can render the create invoice page', function () {
    // Create a client
    $client = Client::factory()->create();

    // Do a GET request to the invoice create page
    $response = $this->get(route('invoices.create', $client->id)); // Assuming the route passes the client id

    // Assert that the response status is OK (200)
    $response->assertStatus(200);

    // Assert that the create invoice page contains the client information
    $response->assertSee($client->client_name); 
    $response->assertSee($client->amount); 
});



//test for sending email upon invoice creation.
it('sends an invoice email when an invoice is created', function () {
    Mail::fake();

    // Create a Faker instance
    $faker = Faker::create();

    // Create a client
    $client = Client::factory()->create();

    // Prepare invoice data
    $invoiceData = [
        'client_id' => $client->id,
        'client_name' => $client->client_name,
        'client_email' => $client->client_email,
        'location' => $faker->address,
        'billing_cycle' => $faker->randomNumber(),
        'amount' => $faker->randomFloat(2, 50), // Random float with 2 decimals
        'due_date' => now(),
    ];

    // Perform the POST request
    $response = $this->post(route('invoices.store', ['client_id' => $client->id]), $invoiceData);

    // Assert that the response redirects to the invoices index page
    $response->assertRedirect(route('invoices.index'));

    // Assert that an email was sent to the client's email address
    Mail::assertSent(InvoiceMail::class, function ($mail) use ($client) {
        return $mail->hasTo($client->client_email);
    });
});