<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
   

    public function clientReport(Request $request)
{
    // Fetching the date filter from the request, default to today
    $selectedDate = $request->input('date', now()->toDateString());

    // Query for paid clients
    $paidClients = Client::join('subscriptions', 'clients.id', '=', 'subscriptions.client_id')
        ->where('subscriptions.payment_status', 1) // Assuming 1 means 'Paid'
        ->whereDate('subscriptions.start_date', '<=', $selectedDate)
        ->whereDate('subscriptions.end_date', '>=', $selectedDate)
        ->select('clients.*', 'subscriptions.*')
        ->get();

    // Query for unpaid clients
    $unpaidClients = Client::join('subscriptions', 'clients.id', '=', 'subscriptions.client_id')
        ->where('subscriptions.payment_status', 0) // Assuming 0 means 'Unpaid'
        ->whereDate('subscriptions.start_date', '<=', $selectedDate)
        ->whereDate('subscriptions.end_date', '>=', $selectedDate)
        ->select('clients.*', 'subscriptions.*')
        ->get();

    return view('reports::General-report', compact('paidClients', 'unpaidClients', 'selectedDate'));
}
}
