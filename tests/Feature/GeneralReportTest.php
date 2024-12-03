<?php

use Carbon\Carbon;
use Modules\Client\Models\Client;
use Modules\Client\Models\Subscription;

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// beforeEach(function () {
//     Carbon::setTestNow('2024-12-01'); // Fix the current time for all tests
// });




//function for seeding clients with their subscriptions.
function seedClientsWithSubscriptions($endDate, $paymentStatus)
{
    $client = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $client->id,
        'end_date' => $endDate,
        'payment_status' => $paymentStatus,
    ]);
}



//Test for clients whose subscription ends in one week.
it('returns clients whose subscription ends in one-week ', function () {
    // Seed data within one week range
    seedClientsWithSubscriptions(Carbon::now()->addDays(3), 1);

    $response = $this->get('/reports?filter=one_week');

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) {
            return $paidClients->count() === 1; // One client in the range
        })
        ->assertViewHas('unpaidClients', function ($unpaidClients) {
            return $unpaidClients->isEmpty(); // No unpaid clients here
        });
});


//Test for clients whose subscription ends in two weeks
it('returns clients whose subscription ends in two-weeks', function () {
    // Seed data within two weeks range
    seedClientsWithSubscriptions(Carbon::now()->addDays(10), 1);

    $response = $this->get('/reports?filter=two_weeks');

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) {
            return $paidClients->count() === 1; // One client in the range
        });
});

//Test for clients whose subscription ends in a month.
it('returns clients whose subscription ends in a month ', function () {
    // Seed data within one month range
    seedClientsWithSubscriptions(Carbon::now()->addDays(20), 1);

    $response = $this->get('/reports?filter=one_month');

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) {
            return $paidClients->count() === 1; // One client in the range
        });
});

//Test for clients whose subscription ends in a specified date range
it('returns clients whose subscription ends in a specified date range', function () {
    // Seed data within the custom date range
    seedClientsWithSubscriptions(Carbon::now()->addDays(7), 1);

    $response = $this->get('/reports?filter=date_range&from_date=2024-12-01&to_date=2024-12-10');

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) {
            return $paidClients->count() === 1; // One client in the range
        });
});




