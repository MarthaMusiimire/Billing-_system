<?php

use Carbon\Carbon;
use Modules\Client\Models\Client;
use Modules\Client\Models\Subscription;


beforeEach(function () {
    // Freeze time to November 27, 2024.
    Carbon::setTestNow(Carbon::create(2024, 11, 27, 0, 0, 0));

    // Paid client with subscription ending within one week.
    $this->oneWeekClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $this->oneWeekClient->id,
        'payment_status' => 1,
        'end_date' => Carbon::now()->addDays(5),
    ]);

    // Paid client with subscription ending within two weeks.
    $this->twoWeeksClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $this->twoWeeksClient->id,
        'payment_status' => 1,
        'end_date' => Carbon::now()->addDays(12),
    ]);

    // Paid client with subscription ending within one month.
    $this->oneMonthClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $this->oneMonthClient->id,
        'payment_status' => 1,
        'end_date' => Carbon::now()->addDays(25),
    ]);

    // Paid client with subscription ending within a specific range (December 1 - December 15).
    $this->dateRangeClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $this->dateRangeClient->id,
        'payment_status' => 1,
        'end_date' => Carbon::create(2024, 12, 10),
    ]);
});




//test for clients whose subscriptions ends in  a week
it('can fetch clients with subscriptions ending within one week', function () {
    $response = $this->get(route('reports.client', ['filter' => 'one_week']));
    $response->assertStatus(200)
    ->assertViewHas('paidClients', function ($paidClients) {
        return $paidClients->contains(function ($client) {
            return $client->subscriptions->contains(function ($subscription) {

                // Checking if the end_date is a string and convert it to Carbon 
                $endDate = (is_string($subscription->end_date)) 
                    ? Carbon::parse($subscription->end_date) //for casting this to a carbon instance before calling the difInDays() function.
                    : $subscription->end_date;

                return $endDate->diffInDays(Carbon::now()) <= 7;
            });
        });
    });
});




//test for clients whose subscriptions ends in two week
it('can fetch clients with subscriptions ending within two weeks', function () {
    $response = $this->get(route('reports.client', ['filter' => 'two_weeks']));

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) {
            return $paidClients->contains(function ($client) {
                return $client->subscriptions->contains(function ($subscription) {
                    $endDate = is_string($subscription->end_date)
                        ? Carbon::parse($subscription->end_date)
                        : $subscription->end_date;

                    return $endDate->diffInDays(Carbon::now()) <= 14;
                });
            });
        });
});




//test for clients whose subscriptions ends in a month.
it('can fetch clients with subscriptions ending within one month', function () {
    $response = $this->get(route('reports.client', ['filter' => 'one_month']));

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) {
            return $paidClients->contains(function ($client) {
                return $client->subscriptions->contains(function ($subscription) {
                    $endDate = is_string($subscription->end_date)
                        ? Carbon::parse($subscription->end_date)
                        : $subscription->end_date;

                    return $endDate->diffInDays(Carbon::now()) <= 30;
                });
            });
        });
});







//test for clients who subscription ends with in a date range.
it('can fetch clients with subscriptions ending within a specific date range', function () {
    $startDate = Carbon::create(2024, 12, 1);
    $endDate = Carbon::create(2024, 12, 15);

    $response = $this->get(route('reports.client', [
        'filter' => 'date_range',
        'start_date' => $startDate->toDateString(),
        'end_date' => $endDate->toDateString(),
    ]));

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) use ($startDate, $endDate) {
            return $paidClients->contains(function ($client) use ($startDate, $endDate) {
                return $client->subscriptions->contains(function ($subscription) use ($startDate, $endDate) {
                    $endDateValue = is_string($subscription->end_date)
                        ? Carbon::parse($subscription->end_date)
                        : $subscription->end_date;

                    return $endDateValue->between($startDate, $endDate);
                });
            });
        });
});