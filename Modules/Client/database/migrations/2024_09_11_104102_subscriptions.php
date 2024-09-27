<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('client_id');
            $table->decimal('amount', 8, 2); // Amount field, 8 digits with 2 decimals
            $table->date('start_date'); // Start date of the subscription
            $table->date('end_date'); // End date of the subscription
            $table->boolean('payment_status')->default(false); // Payment status, default is unpaid (false)
            $table->timestamps(); // Created_at and updated_at fields
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
