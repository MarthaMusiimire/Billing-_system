<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use Illuminate\Support\Facades\Log;
use Modules\Invoice\Models\Invoice;
use App\Http\Controllers\Controller;
use Modules\Invoice\Notifications\InvoiceNotification;




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

        $client = Client::findOrFail($client_id);
        

        // Create a new invoice
        $invoice=Invoice::create([
            'client_id' => $client->id,
            'client_name' => $client->client_name,
            'location' => $client->location,
            'billing_cycle' => $client->billing_cycle,
            'amount' => $client->amount,
            'due_date' => $request->input('due_date'),
        ]);

        $invoice->save();

        // Notify the client about the new invoice
        $client->notify(new InvoiceNotification($invoice));

        Log::info('Notification sent for invoice ID: ' . $invoice->id);

        // Redirect with success message
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
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
