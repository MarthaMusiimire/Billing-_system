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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->enum('facility_level', ['1','2','3','4','5','6','7'])->comment('1 is HC-I, 2 is HC-II,3 is HC-III,4 is HC-IV,5 is Clinic, 6 is Hospital,7 is Referral Hospital');
            $table->string('location');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('support_engineer_name');
            $table->string('support_engineer_phone');
            $table->string('support_engineer_email');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
