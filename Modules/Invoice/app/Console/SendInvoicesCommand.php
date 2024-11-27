<?php

namespace Modules\Invoice\Console;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Modules\Invoice\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use Modules\Client\Models\Subscription;
use Modules\Invoice\Emails\InvoiceMail;
use Modules\Invoice\Http\Controllers\InvoiceController;

class SendInvoicesCommand extends Command
{
    // The name and signature of the console command.
    protected $signature = 'email:send-unpaid-invoices';
    protected $description = 'Send emails with invoice attachments for unpaid clients every 10 minutes';

    public function __construct()
    {
        parent::__construct();
    }


    // Execute the console command.
    public function handle()
    {
        // Find unpaid subscriptions
        $unpaidSubscriptions = Subscription::where('payment_status', 0) // 0 means unpaid
            ->where('created_at', '<=', Carbon::now()) // To limit emails to existing unpaid subscriptions
            ->get();

        // Loop through each unpaid subscription
        foreach ($unpaidSubscriptions as $subscription) {
            $client = $subscription->client;
            // Find the corresponding invoice
            $invoice = Invoice::where('client_id', $subscription->client_id)->first();
        
            if ($invoice) {
                // Prepare mail data
                $mailData = [
                    'invoice_id' => $invoice->id,
                    'client_name' => $subscription->client->client_name,
                    'client_email' => $subscription->client->client_email,
                    'due_date' => $invoice->due_date,
                    'amount' => $invoice->amount,
                ];
        
                // Send the email
                Mail::to($subscription->client->client_email)->send(new InvoiceMail($mailData, $invoice));
        
                // Log the sending
                $this->info('Invoice email sent to: ' . $subscription->client->client_email);
            } 
            else {
                $this->warn('No invoice found for client ID: ' . $subscription->client_id);
            }
        }
    }
}

