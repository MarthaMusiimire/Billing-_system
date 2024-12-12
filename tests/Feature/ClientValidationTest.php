<?php


use App\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function() {
    // Create an admin user and authenticate them
    $user = User::factory()->admin()->create();
    $this->actingAs($user)->get('/clients')->assertStatus(200);
});



//testing for an empty client_name
it('fails when client_name is null', function () {

    $clientData = Client::factory()->make()->toArray();
    unset($clientData['client_name']); // Remove the client_name to simulate a missing field

    // Send a POST request to store the client
    $response = $this->postJson(route('clients.store'), $clientData);

    // Assert that the response status is 422 
    $response->assertStatus(422);

    // Assert the specific error message for the missing client_name
    $response->assertJsonValidationErrors('client_name');
    $response->assertJson([
        'errors' => [
            'client_name' => ['This field is required.']
        ]
    ]);
});

it('fails when the client name is not a string', function(){

    $clientData = Client::factory()->make(['client_name' => 123])->toArray();

    // Send a POST request to store the client
    $response = $this->postJson(route('clients.store'), $clientData);
    $response->assertStatus(422);

    $response->assertJsonValidationErrors('client_name');
    $response->assertJson([
        'errors' => [
            'client_name' => ['The name must be a string.']
        ]
    ]);
});

it('fails when location exceeds maximum length', function () {
    $clientData = Client::factory()->make(['location' => str_repeat('a', 256)])->toArray();

    $response = $this->postJson(route('clients.store'), $clientData);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('location');
    
});


it('fails when client email is not provided', function () {
    $clientData = Client::factory()->make(['client_email' => null])->toArray();

    $response = $this->postJson(route('clients.store'), $clientData);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('client_email');
    $response->assertJson([
        'errors' => [
            'client_email' => ['The email field is required.']
        ]
        ]); 
});



it('fails when client email is invalid', function () {
    $clientData = Client::factory()->make(['client_email' => 'invalid-email'])->toArray();

    $response = $this->postJson(route('clients.store'), $clientData);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('client_email');
    $response->assertJson([
        'errors' => [
            'client_email' => ['The email must be a valid email address.']
        ]
    ]);
});


it('fails when contact phone is not provided', function () {
    $clientData = Client::factory()->make(['contact_phone' => null])->toArray();

    $response = $this->postJson(route('clients.store'), $clientData);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('contact_phone');
});



it('fails when support engineer email is invalid', function () {
    $clientData = Client::factory()->make(['support_engineer_email' => 'invalid_email'])->toArray();

    $response = $this->postJson(route('clients.store'), $clientData);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('support_engineer_email');
});


it('fails when support engineer email exceeds the maximum length', function () {
  
    $longEmail =   $longEmail = str_repeat('a', 41) . '@gmail.com';  // 51 characters before '@example.com'
    $clientData = Client::factory()->make(['support_engineer_email' => $longEmail])->toArray();

  
    $response = $this->postJson(route('clients.store'), $clientData);
    // Assert the response status is 422 (validation failed)
    $response->assertStatus(422);

    // Assert that the validation error exists for support_engineer_email
    $response->assertJsonValidationErrors('support_engineer_email');

    // Assert the validation error message
    $response->assertJsonFragment([
        'support_engineer_email' => ['The email should not be greater than 50 characters.']
    ]);
});