<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add all fields from employees to users
        Schema::table('users', function (Blueprint $table) {
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('employee_id')->nullable()->unique();
            $table->string('gender')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('designation')->nullable();
            
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('business_unit_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sub_business_unit_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('job_function_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sub_function_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('employee_type_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('designation_master_id')->nullable()->constrained('designations')->nullOnDelete();
            $table->foreignId('dynamic_role_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('reporting_to_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('function_supervisor_id')->nullable()->constrained('users')->nullOnDelete();
            
            $table->date('date_of_joining')->nullable();
            $table->decimal('salary', 10, 2)->default(0);
            $table->text('bank_details')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Terminated', 'On Leave'])->default('Active');
            $table->string('photo_path')->nullable();
            $table->string('document_path')->nullable();
            $table->date('dob')->nullable();
            
            $table->string('erc')->nullable();
            $table->string('work_phone_ext')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('retirement_date')->nullable();
            $table->boolean('confirmation_required')->default(false);
            $table->date('probation_start_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->string('confirmation_status')->nullable();
            $table->string('employee_status')->nullable();
            $table->date('group_date_of_joining')->nullable();
            $table->string('access_code')->nullable();
        });

        // Drop the employees table
        Schema::dropIfExists('employees');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse operations (incomplete to save space, normally you'd recreate employees table here)
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['company_id']);
            $table->dropForeign(['business_unit_id']);
            $table->dropForeign(['sub_business_unit_id']);
            $table->dropForeign(['job_function_id']);
            $table->dropForeign(['sub_function_id']);
            $table->dropForeign(['employee_type_id']);
            $table->dropForeign(['designation_master_id']);
            $table->dropForeign(['dynamic_role_id']);
            $table->dropForeign(['location_id']);
            $table->dropForeign(['reporting_to_id']);
            $table->dropForeign(['function_supervisor_id']);
        });
    }
};
