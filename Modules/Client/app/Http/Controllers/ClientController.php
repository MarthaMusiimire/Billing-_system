<?php

namespace Modules\Client\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Notification;
use Modules\Client\Http\Requests\StoreClientRequest;
use Modules\Client\Http\Requests\UpdateClientRequest;
use Modules\Client\Notifications\ClientEmailVerificationNotification;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::paginate(6);

        //serch by facility name on the index page
        $query = Client::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('client_name', 'LIKE', "%{$search}%");
        }
    
        $clients = $query->get();
    
        return view('client::index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        $client = Client::create([
            'client_name' => $request->client_name,
            'facility_level' => $request->facility_level,
            'location' => $request->location,
            'client_email' => $request->client_email,
            'billing_cycle' => $request->billing_cycle,
            'amount' => $request->amount,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'support_engineer_name' => $request->support_engineer_name,
            'support_engineer_phone' => $request->support_engineer_phone,
            'support_engineer_email' => $request->support_engineer_email,
          
        ]);

        $mailData = [
            'client_name' => $client->client_name,
            'client_email' => $client->client_email,
            'title' => 'Verification from Matela',
            'body' => 'Thank you for signing up with Matela. Please verify your email address by clicking the link below.',
            // 'link' => route('clients.verify', ['token' => $client->verification_token]),

        ];

        // $client->notify(new ClientEmailVerificationNotification($client));
        Mail::to($mailData['client_email'])->send(new DemoMail($mailData, $client));
        dd('email_sent');

        // event(new Registered($user));


        // Redirect to the index route with a success message
        return redirect()->route('clients.index')
                         ->with('status', 'Client created and email sent successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('client::show', compact('client', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       
        $client =Client::findOrFail($id);
        return view('client::edit', compact('client'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $client = Client::validated();

        $client->update();

        // Redirect to the index route with a success message
        return redirect()->route('clients.index')
                         ->with('status', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')
                         ->with('status', 'Client deleted successfully.');
    }


    public function inactive(Request $request)
    {

        //First query for only the trashed clients
        $query = Client::onlyTrashed();

        //Then Check if the search input is filled
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('client_name', 'LIKE', "%{$search}%");
        }

        // Execute the query and get the results
        $clients = $query->get();

        // Return the view with the clients data
        return view('client::inactive', compact('clients'));

    

    }

    public function restore($id)
    {
        $client = Client::withTrashed()->findOrFail($id);;
        $client->restore();

        return redirect()->route('clients.inactive')
                         ->with('status', 'Client activated successfully.');
    }




    public function verifyEmail($id, $hash)
    {
        $client = Client::findOrFail($id);

        if (sha1($client->client_email) === $hash) {
            // Mark email as verified
            $client->email_verified = true;
            $client->email_verified_at = now();
            $client->save();

            // Redirect to the verification success page
            return view('client::emails.Verification-success', compact('client'));

        }

        // Redirect to the verification failure page
        return view('client::emails.Verification-failure', [
            'client' => $client,
        ]);
    }




}
