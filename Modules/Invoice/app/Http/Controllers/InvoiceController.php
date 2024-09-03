<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use Illuminate\Support\Facades\Log;
use Modules\Invoice\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Invoice\Emails\InvoiceMail;





class InvoiceController extends Controller
{
    public function index()
{
    $invoices = Invoice::all(); // Fetch all invoices
    return view('invoice::index', compact('invoices')); // Return the view with the list of invoices
}

  

    /**
     * Show the form for creating a new resource.
     */
    public function create($client_id)
    {
        Log::info("Client ID received: " . $client_id); // Log client_id
        $client = Client::findOrFail($client_id); // Fetch the specific client
        return view('invoice::create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $client_id)
{
    $request->validate([
        'due_date' => 'required|date',
    ]);

    Log::info("Storing invoice for client ID: " . $client_id);

    $client = Client::findOrFail($client_id);
    Log::info("Client data: " . json_encode($client));

    // Create a new invoice
    $invoice = Invoice::create([
        'client_id' => $client->id,
        'client_name' => $client->client_name,
        'client_email' => $client->client_email,
        'location' => $client->location,
        'billing_cycle' => $client->billing_cycle,
        'amount' => $client->amount,
        'due_date' => $request->input('due_date'),
    ]);

    Log::info("Invoice created with ID: " . $invoice->id);

    // Prepare email data
    $mailData = [
        'invoice_id' => $invoice->id,
        'client_name' => $invoice->client_name,
        'client_email' => $invoice->client_email,
        'due_date' => $invoice->due_date,
        'amount' => $invoice->amount,
    ];

    // Send an email to the client about the new invoice

    //Log::info("Client email for ID $client_id: '" . $invoice->client_email . "'");
    Log::info("Invoice object: " . json_encode($invoice));
    if (!empty($invoice->client_email)) {
        // Send the email since the client_email is not empty
        Mail::to($invoice->client_email)->send(new InvoiceMail($mailData, $invoice));
        Log::info("Email sent to: " . $invoice->client_email);
    } else {
        // Log a warning if the client_email is empty
        Log::warning("Client with ID $client_id does not have an email address.");
    }

    // Redirect with success message and pass the invoice ID
    return redirect()->route('invoices.index', ['invoice' => $invoice->id])
        ->with('success', 'Invoice created and email sent successfully!');
}

    
    


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('invoice::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('invoice::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }


    
}
