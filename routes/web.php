<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use Modules\Client\Http\Controllers\ClientController;




   

Route::middleware('auth')->group(function () {
    Route::resource('clients', ClientController::class);
    //routes for profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //routes for permissions
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'roles.destroy']);

    //routes for roles
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy'])->name('permissions.destroy');
    Route::get('roles/{roleId}/give_permissions', [App\Http\Controllers\RoleController::class, 'showPermissionToRole'])->name('showPermissionToRole');
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole'])->name('givePermissionToRole');

    //routes for users
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    
    //route for clients
    Route::group([], function () {
        Route::resource('clients', ClientController::class)->names('clients');
    });

    

 
    
});



    



Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('send-mail/{id}', [MailController::class, 'index']);

// Route::get('send-mail', function(){
//     \Mail::to('lemi.manoah@gmail.com')->send(new \App\Mail\DemoMail($mailData));
//     return "Email sent successfully";
// });


















