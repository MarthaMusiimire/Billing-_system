<?php

use Modules\Client\Models\Client;
use Modules\Client\Models\Subscription;



//test for the one week filter 
it('fetches clients with subscriptions ending within one week', function () {
    $today = now();

    // Create clients with subscriptions ending within one week
    $paidClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $paidClient->id,
        'end_date' => $today->clone()->addDays(5),
        'payment_status' => 1,
    ]);

    $unpaidClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $unpaidClient->id,
        'end_date' => $today->clone()->addDays(6),
        'payment_status' => 0,
    ]);

    // Create clients with subscriptions outside one week
    Client::factory()->has(Subscription::factory()->state([
        'end_date' => $today->clone()->addDays(10),
        'payment_status' => 1,
    ]))->create();

    // Call the route
    $response = $this->get(route('reports.client', ['filter' => 'one_week']));

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) use ($paidClient) {
            return $paidClients->contains($paidClient);
        })
        ->assertViewHas('unpaidClients', function ($unpaidClients) use ($unpaidClient) {
            return $unpaidClients->contains($unpaidClient);
        });
});




//test for two weeks filter
it('fetches clients with subscriptions ending within two weeks', function () {
    $today = now();

    $paidClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $paidClient->id,
        'end_date' => $today->clone()->addDays(10),
        'payment_status' => 1,
    ]);

    $unpaidClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $unpaidClient->id,
        'end_date' => $today->clone()->addDays(12),
        'payment_status' => 0,
    ]);

    $response = $this->get(route('reports.client', ['filter' => 'two_weeks']));

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) use ($paidClient) {
            return $paidClients->contains($paidClient);
        })
        ->assertViewHas('unpaidClients', function ($unpaidClients) use ($unpaidClient) {
            return $unpaidClients->contains($unpaidClient);
        });
});




it('fetches clients with subscriptions ending within one month', function () {
    $today = now();

    $paidClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $paidClient->id,
        'end_date' => $today->clone()->addDays(20),
        'payment_status' => 1,
    ]);

    $unpaidClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $unpaidClient->id,
        'end_date' => $today->clone()->addDays(25),
        'payment_status' => 0,
    ]);

    $response = $this->get(route('reports.client', ['filter' => 'one_month']));

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) use ($paidClient) {
            return $paidClients->contains($paidClient);
        })
        ->assertViewHas('unpaidClients', function ($unpaidClients) use ($unpaidClient) {
            return $unpaidClients->contains($unpaidClient);
        });
});



it('fetches clients within a custom date range', function () {
    $startDate = now()->clone()->subDays(2);
    $endDate = now()->clone()->addDays(7);

    $paidClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $paidClient->id,
        'end_date' => now()->clone()->addDays(4),
        'payment_status' => 1,
    ]);

    $unpaidClient = Client::factory()->create();
    Subscription::factory()->create([
        'client_id' => $unpaidClient->id,
        'end_date' => now()->clone()->addDays(5),
        'payment_status' => 0,
    ]);

    $response = $this->get(route('reports.client', [
        'filter' => 'date_range',
        'from_date' => $startDate->format('Y-m-d'),
        'to_date' => $endDate->format('Y-m-d'),
    ]));

    $response->assertStatus(200)
        ->assertViewHas('paidClients', function ($paidClients) use ($paidClient) {
            return $paidClients->contains($paidClient);
        })
        ->assertViewHas('unpaidClients', function ($unpaidClients) use ($unpaidClient) {
            return $unpaidClients->contains($unpaidClient);
        });
});



// it('returns empty results when no clients match the criteria', function () {
//     $response = $this->get(route('reports.client', ['filter' => 'one_week']));

//     $response->assertStatus(200)
//         ->assertViewHas('paidClients', function ($paidClients) {
//             return $paidClients->isEmpty();
//         })
//         ->assertViewHas('unpaidClients', function ($unpaidClients) {
//             return $unpaidClients->isEmpty();
//         });
// });


