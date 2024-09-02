<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoice\Http\Controllers\InvoiceController;

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
    Route::resource('invoices', InvoiceController::class);
});

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('laurielae26@gmail.com')
                ->subject('Test Email');
    });
});





// Route to display the create invoice form
Route::get('/invoices/create/{client_id}', [InvoiceController::class, 'create'])->name('invoices.create');

// Route to handle the form submission and store the invoice
Route::post('/invoices/store/{client_id}', [InvoiceController::class, 'store'])->name('invoices.store');







