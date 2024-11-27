<?php

use Illuminate\Support\Carbon;
use Modules\Client\Models\Client;
use Modules\Invoice\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Modules\Client\Models\Subscription;
use Modules\Invoice\Emails\InvoiceMail;
use Illuminate\Foundation\Testing\RefreshDatabase;



uses(RefreshDatabase::class);

it('sends invoice email for unpaid subscriptions', function () {
    Mail::fake();


    // Define the client data array
    $clientData = [
        'client_name' => 'Lowe Ltd',
        'facility_level' => 1,
        'location' => '8987 Odell Garden, Ritchiechester, WY 48583',
        'client_email' => 'liliana.turner@example.com',
        'billing_cycle' => 8,
        'amount' => 62080.50,
        'contact_name' => 'Dr. Erika Kreiger Jr.',
        'contact_phone' => '3350173952',
        'support_engineer_name' => 'Angelica McGlynn',
        'support_engineer_phone' => '2401632883',
        'support_engineer_email' => 'otilia.mills@luettgen.com',
        'payment_status' => 0, // Unpaid subscription
    ];

    // Create a client using the client data array
    $client = Client::create($clientData);

    // Create an unpaid subscription for this client
    $subscription = Subscription::factory()->create([
        'client_id' => $client->id,
        'payment_status' => 0,  // Unpaid subscription
    ]);

    // Create the invoice for the subscription
    $invoice = Invoice::factory()->create([
        'client_id' => $client->id,
        'amount' => 100.00, // Example amount
        'due_date' => Carbon::now()->addDays(7),
    ]);

    // Run the command
    $this->artisan('email:send-unpaid-invoices');

    // Assert that the email was sent
    Mail::assertSent(InvoiceMail::class, function ($mail) use ($client) {
        return $mail->hasTo($client->client_email);
    });
});


//test to check if it passes when there are no unpaid subscriptions.
it('does not fail when there are no unpaid subscriptions', function () {
    // Run the command without any unpaid subscriptions
    $result = Artisan::call('email:send-unpaid-invoices');

    // Assert the command runs successfully (exit code 0)
    expect($result)->toBe(0);
});




it('logs warnings if no invoice is found for a client', function () {
    // Create a client without any associated invoices
    $client = Client::factory()->create();

    // Create a subscription for the client
    Subscription::factory()->create([
        'client_id' => $client->id,
        'payment_status' => 0, // Unpaid subscription
    ]);

    // Run the artisan command and capture output
    $this->artisan('email:send-unpaid-invoices')
    ->expectsOutput('No invoice found for client ID: ' . $client->id);
});

