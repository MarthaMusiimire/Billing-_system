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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('client_email')->after('location');
            $table->timestamp('email_verified_at')->nullable()->after('client_email');
            $table->boolean('email_verified')->default(false)->after('email_verified_at');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('client_email');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('email_verified');
            
        });
    }
};
