
<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Modules\Invoice\Console\SendInvoicesCommand;
use Illuminate\Support\Facades\Schedule;

// Registering the SendInvoicesCommand directly
Artisan::command('email:send-unpaid-invoices', function () {
    $this->call(SendInvoicesCommand::class);
})->purpose('Send emails with invoice attachments for unpaid clients every 10 minutes');


Schedule::command(SendInvoicesCommand::class)->everyMinute();

