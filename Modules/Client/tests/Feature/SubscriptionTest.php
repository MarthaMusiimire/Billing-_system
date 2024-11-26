<?php


use Modules\Client\Models\Subscription;
use Modules\Invoice\Emails\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Modules\Client\Models\Client;

beforeEach(function () {
    Mail::fake(); // Fake mail sending to test without sending real emails
});

it('sends invoices for unpaid subscriptions when schedule:run is executed', function () {
   
    $client = Client::factory()->create(); 
    $subscription = Subscription::create([
        'client_id' => $client->id,
        'amount' => 500,
        'start_date' => now(),
        'end_date' => now()->addYear(),
        'payment_status' => 0, // Unpaid status
    ]);

    // Step 2: Run the scheduled task (this would normally be done by Laravel's scheduler)
    Artisan::call('schedule:run'); // This triggers your scheduled tasks

    // Step 3: Assert that an invoice email was sent to the client
    Mail::assertSent(InvoiceMail::class, function ($mail) use ($client) {
        return $mail->hasTo($client->client_email) && $mail->subject === "Invoice for Subscription";
    });

    // Step 4: Ensure the invoice exists in the database with expected details
    $this->assertDatabaseHas('invoices', [
        'client_id' => $client->id,
        'amount' => 500,
        'payment_status' => 0, // Assuming you update this status after sending the email
    ]);
});
