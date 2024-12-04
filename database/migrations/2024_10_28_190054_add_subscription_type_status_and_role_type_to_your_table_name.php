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
        Schema::table('users', function (Blueprint $table) {
            $table->string('subscription_type')->default('standard'); // Adjust default as needed
            $table->enum('status', ['active', 'inactive'])->default('active'); // Adjust status options as needed
            $table->string('role_type')->default('customer'); // Adjust default role type as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('your_table_name', function (Blueprint $table) {
            //
        });
    }
};
