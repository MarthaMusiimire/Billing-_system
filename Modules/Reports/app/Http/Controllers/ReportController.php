<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
   

    public function clientReport(Request $request)
    
        {
            $filter = $request->input('filter', 'one_week'); // Default to 'one_week'
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $today = now();

          
            switch ($filter) {
                case 'one_week':
                    $startDate = $today;
                    $endDate = $today->clone()->addWeek();  // Add 1 week
                    break;

                case 'two_weeks':
                    $startDate = $today;
                    $endDate = $today->clone()->addWeeks(2);  // Add 2 weeks
                    break;

                case 'one_month':
                    $startDate = $today;
                    $endDate = $today->clone()->addMonth();  // Add 1 month
                    break;

                case 'date_range':
                    if ($fromDate && $toDate) {
                        $startDate = \Carbon\Carbon::parse($fromDate);
                        $endDate = \Carbon\Carbon::parse($toDate);
                    } else {
                        // If custom date range not provided, default to current week
                        $startDate = $today;
                        $endDate = $today->clone()->addWeek();
                    }
                    break;

                default:
                    $startDate = $today;
                    $endDate = $today->clone()->addWeek();
                    break;
            }

            // Fetch Paid Clients with next invoice date in the specified range
            $paidClients = Client::join('subscriptions', 'clients.id', '=', 'subscriptions.client_id')
                ->where('subscriptions.payment_status', 1)
                ->whereBetween('subscriptions.end_date', [$startDate, $endDate])
                ->select('clients.*', 'subscriptions.*')
                ->get();

            // Fetch Unpaid Clients with next invoice date in the specified range
            $unpaidClients = Client::join('subscriptions', 'clients.id', '=', 'subscriptions.client_id')
                ->where('subscriptions.payment_status', 0)
                ->whereBetween('subscriptions.end_date', [$startDate, $endDate])
                ->select('clients.*', 'subscriptions.*')
                ->get();

            return view('reports::General-report', compact('paidClients', 'unpaidClients', 'filter', 'fromDate', 'toDate'));
        }

}
