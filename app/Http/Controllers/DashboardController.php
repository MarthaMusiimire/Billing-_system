<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use Modules\Invoice\Models\Invoice;
use Modules\Client\Models\Subscription;


class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $pendingInvoices = Subscription::where('payment_status', 'unpaid')->count();
        $revenueThisMonth = Subscription::where('payment_status', 'paid')
                                    ->whereMonth('created_at', now()->month)
                                    ->sum('amount');
        $newClientsThisMonth = Client::whereMonth('created_at', now()->month)->count();

        return view('dashboard', compact(
            'totalClients', 'pendingInvoices', 'revenueThisMonth', 'newClientsThisMonth'
        ));
    }
}