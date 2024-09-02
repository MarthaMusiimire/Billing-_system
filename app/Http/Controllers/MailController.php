<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use Modules\Client\Models\Client; 

class MailController extends Controller
{
    // public function index($id)
    // {
    //     // Fetch the client by ID
    //     $client = Client::findOrFail(26);
    //     // $client_name = $client->client_name;

    //     // Prepare the email data
    //     $mailData = [
    //         'title' => 'Mail from Stre@mline Health',
    //         'body' => 'This is for verifying your email.'
    //     ];

    //     // Send the email to the client's email address
    //     Mail::to($client->client_email)->send(new DemoMail($mailData, $client));
        
    //     return "Email is sent successfully to " . $client->client_email;
        
    // }
}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Mail;
// use App\Mail\DemoMail;
// use Modules\Client\Http\Controllers\ClientController;

// class MailController extends Controller
// {
//     public function index()
//     {
//         $mailData = [
//             'title' => 'Mail from Stre@mline Health',
//             'body' => 'This is for verifying your email.'
//         ];
         
//         Mail::to('your_email@gmail.com')->send(new DemoMail($mailData));
           
//         dd("Email is sent successfully.");
// }
// }