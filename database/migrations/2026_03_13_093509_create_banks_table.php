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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            // Personal Bank Details
            $table->string('bank_code')->unique();
            $table->string('bank_name');
            $table->string('branch')->nullable();
            $table->string('ifsc_code');
            $table->string('micr_code')->nullable();
            $table->string('bank_type')->default('Salary'); // e.g., Salary, Savings, Current
            
            // Company Bank Details
            $table->string('company_ifsc_code')->nullable();
            $table->string('company_micr_code')->nullable();
            $table->string('company_account_number')->nullable();
            
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
