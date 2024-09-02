<?php

namespace Modules\Invoice\Notifications;

use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Modules\Invoice\Models\Invoice;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invoice;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        Log::info('InvoiceNotification created for invoice ID: ' . $invoice->id);
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        Log::info('Via method called for invoice ID: ' . $this->invoice->id);
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        Log::info('toMail method called for invoice ID: ' . $this->invoice->id);

        try {
            // Generate PDF
            $pdf = Pdf::loadView('invoice::pdf', ['invoice' => $this->invoice]);

            Log::info('PDF generated for invoice ID: ' . $this->invoice->id);

            // // Access the client's name and email
            // $clientName = $this->invoice->client->client_name;
            // Log::info('Client name: ' . $clientName);
            

            // // Access the client's email
            // $recipientEmail = $this->invoice->client->client_email;

            // Log::info('Sending email to: ' . $recipientEmail);

            // Ensure recipient email is valid
            // if (empty($recipientEmail)) {
            //     Log::error('Recipient email is empty for invoice ID: ' . $this->invoice->id);
            //     return ;
            // }

            // Send the email with the PDF attachment
            return (new MailMessage)
                ->subject('Your Invoice is Ready')
                // ->greeting('Hello ' . $clientName . ',')
                ->line('Your invoice is attached to this email.')
                ->line('Invoice ID: ' . $this->invoice->id)
                ->line('Amount: $' . number_format($this->invoice->amount, 2))
                ->line('Due Date: ' . $this->invoice->due_date)
                ->attachData($pdf->output(), 'invoice_' . $this->invoice->id . '.pdf', [
                    'mime' => 'application/pdf',
                ])
                ->cc('laurynkantono@gmail.com')
                ->cc('ormservices100@example.com');
        } catch (\Exception $e) {
            Log::error('Error in toMail method for invoice ID: ' . $this->invoice->id . ' - ' . $e->getMessage());
            throw $e; // Re-throw the exception to ensure it's not silently swallowed
        }
    }



    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [];
    }
}
