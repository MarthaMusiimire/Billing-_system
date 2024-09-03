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

// Route::get('/test-email', function () {
//     Mail::raw('This is a test email', function ($message) {
//         $message->to('musiimiremartha@gmail.com')
//                 ->subject('Test Email');
//     });
// });





// Route to display the form to create a new invoice for a specific client
// In routes/web.php
Route::get('/invoices/create/{client_id}', [InvoiceController::class, 'create'])->name('invoices.create');


// Route to handle the form submission and store the invoice
Route::post('/invoices/store/{client_id}', [InvoiceController::class, 'store'])->name('invoices.store');

// Route for listing all invoices
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');





