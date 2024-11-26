<?php
use Modules\Client\Models\Client;
use Modules\Invoice\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Modules\Client\Models\Subscription;
use Modules\Invoice\Emails\InvoiceMail;

it('sends invoices to unpaid subscriptions', function () {
  
    Mail::fake();

    // Create a client
    $client = Client::factory()->create();

    // Create a subscription with unpaid status
    $subscription = [
        'client_id' => $client->id,
        'amount' => 10000,
        'start_date' => now(),
        'end_date' => now()->addDays(365),
        'payment_status' => 0, // Unpaid
    ];

    // Create a corresponding invoice
    $invoice = [
        'client_id' => $subscription['client_id'],
        'client_name' => $client->client_name,
        'client_email' => $client->email,
        'location' => $client->location,
        'billing_cycle' => $client->billing_cycle,
        'amount' => 10000,
        'due_date' => now()->addDays(7),
    ];

    // Create the subscription and invoice
    $this->post('/subscription', $subscription);
    $this->post('/invoice', $invoice);

    // Run the command
    Artisan::call('email:send-unpaid-invoices');

    // Assert that the email was sent
    Mail::assertSent(InvoiceMail::class, function ($mail) use ($client) {
        return $mail->hasTo($client->client_email);
    });

    // Assert that the invoice exists in the database
    $this->assertDatabaseHas('invoices', [
        'client_id' => $subscription['client_id'],
        'amount' => 10000,
    ]);
});
