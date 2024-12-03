<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Http\Controllers\ClientController;
use Modules\Client\Http\Controllers\SubscriptionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('client', ClientController::class)->names('client');
});




Route::resource('clients', ClientController::class);


Route::get('/clients/inactive', [ClientController::class, 'inactive'])->name('clients.inactive');
Route::put('client/{id}/restore', [ClientController::class, 'restore'])->name('clients.restore');

Route::get('/client/verify/{id}/{hash}', [ClientController::class, 'verifyEmail'])->name('client.verify');


//routes for subscriptions
Route::get('/clients/{clientId}/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
Route::post('/clients/{clientId}/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');

