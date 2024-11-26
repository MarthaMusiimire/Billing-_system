<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Client\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client::subscriptions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($clientId)
    {
        $client = Client::findOrFail($clientId);
        return view('client::subscriptions.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Log the request data to ensure that form submission is working correctly.
        Log::info('Subscription Store Method Called', $request->all());


        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = \Carbon\Carbon::parse($request->input('start_date'));
                    $endDate = \Carbon\Carbon::parse($value);

                    // Log the dates for debugging
                    Log::info('Start Date:', ['start_date' => $startDate->format('Y-m-d')]);
                    Log::info('End Date:', ['end_date' => $endDate->format('Y-m-d')]);

                    // Check if the end date is at least one year after the start date
                    if ($endDate->lt($startDate->copy()->addYear())) { // less than one year
                        $fail('The end date must be at least one year after the start date.');
                    }
                },
            ],
                        'payment_status' => 'required|boolean',
        ]);
    
        Subscription::create([
            'client_id' => $request->input('client_id'),
            'amount' => $request->input('amount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'payment_status' => $request->input('payment_status'),
        ]);
    
        return redirect()->route('clients.index')->with('success', 'Subscription created successfully.');
    

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('client::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('client::edit');
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
