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
        Schema::create('employee_bank_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name_as_per_bank')->nullable();
            
            // Salary Bank Details
            $table->foreignId('salary_bank_id')->nullable()->constrained('banks');
            $table->string('salary_bank_ifsc')->nullable();
            $table->string('salary_account_number')->nullable();
            
            // Reimbursement Bank Details
            $table->foreignId('reimbursement_bank_id')->nullable()->constrained('banks');
            $table->string('reimbursement_bank_ifsc')->nullable();
            $table->string('reimbursement_account_number')->nullable();
            
            $table->string('payment_mode')->nullable(); // e.g., Bank Transfer, Cheque, Cash
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_bank_details');
    }
};
