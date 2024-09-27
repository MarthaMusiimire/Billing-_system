<?php

namespace Modules\Invoice\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Invoice\Models\Invoice;
//use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Mail\Mailables\Attachment;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;

    public $invoice;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @param Invoice $invoice
     */
    public function __construct(array $mailData, Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->mailData = $mailData;
     
    
        // Generate the PDF from a view
        $this->pdf = Pdf::loadView('invoice::emails.invoice', ['invoice' => $this->invoice])->output();
    
        Log::info(get_class($this->invoice)); // Should log 'Modules\Invoice\Models\Invoice'
    }
    


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Invoice is Ready')
                    ->view('invoice::emails.invoice')
                ->with([
                        'invoice_id' => $this->mailData['invoice_id'],
                        'amount' => $this->mailData['amount'],
                        'dueDate' => $this->mailData['due_date'],
                    ])

                    ->attachData($this->pdf, 'invoice_' . $this->invoice->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [
    //         Attachment::fromData(fn () => $this->pdf, 'invoice_' . $this->invoice->id . '.pdf')
    //             ->withMime('application/pdf'),
    //     ];
    // }
}