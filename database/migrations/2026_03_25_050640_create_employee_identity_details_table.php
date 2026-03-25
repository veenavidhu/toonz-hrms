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
        Schema::create('employee_identity_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Passport Details
            $table->string('passport_no')->nullable();
            $table->string('passport_place_of_issue')->nullable();
            $table->date('passport_date_of_issue')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->text('passport_address')->nullable();
            $table->string('passport_attachment')->nullable();
            
            // Visa & Work Permit
            $table->string('visa_no')->nullable();
            $table->date('visa_expiry')->nullable();
            $table->string('visa_attachment')->nullable();
            $table->string('work_permit_no')->nullable();
            $table->date('work_permit_expiry')->nullable();
            $table->string('work_permit_attachment')->nullable();
            
            // Driving Details
            $table->string('driving_licence_no')->nullable();
            $table->string('driving_licence_place_of_issue')->nullable();
            $table->date('driving_licence_date_of_issue')->nullable();
            $table->date('driving_licence_validity')->nullable();
            $table->text('driving_licence_address')->nullable();
            $table->string('driving_licence_attachment')->nullable();
            
            // Others
            $table->string('aadhar_no')->nullable();
            $table->string('aadhar_attachment')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('pan_attachment')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_identity_details');
    }
};
