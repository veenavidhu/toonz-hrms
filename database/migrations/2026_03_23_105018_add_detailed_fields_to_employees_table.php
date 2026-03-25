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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('middle_name')->nullable()->after('user_id');
            $table->string('last_name')->nullable()->after('middle_name');
            $table->string('gender')->nullable()->after('last_name');
            $table->date('effective_date')->nullable()->after('last_name');

            $table->foreignId('company_id')->nullable()->after('department_id')->constrained()->nullOnDelete();
            $table->foreignId('business_unit_id')->nullable()->after('company_id')->constrained()->nullOnDelete();
            $table->foreignId('sub_business_unit_id')->nullable()->after('business_unit_id')->constrained()->nullOnDelete();
            $table->foreignId('job_function_id')->nullable()->after('sub_business_unit_id')->constrained()->nullOnDelete();
            $table->foreignId('sub_function_id')->nullable()->after('job_function_id')->constrained()->nullOnDelete();
            $table->foreignId('employee_type_id')->nullable()->after('sub_function_id')->constrained()->nullOnDelete();
            $table->foreignId('designation_master_id')->nullable()->after('employee_type_id')->constrained('designations')->nullOnDelete();
            $table->foreignId('dynamic_role_id')->nullable()->after('designation_master_id')->constrained()->nullOnDelete();

            $table->foreignId('reporting_to_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('function_supervisor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('erc')->nullable(); // Will be ERO
            $table->string('work_phone_ext')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('retirement_date')->nullable();
            $table->boolean('confirmation_required')->default(false);
            $table->date('probation_start_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->string('confirmation_status')->nullable();
            $table->string('employee_status')->nullable(); // active, resigned, inactive, suspend
            $table->date('group_date_of_joining')->nullable();
            $table->string('access_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['business_unit_id']);
            $table->dropForeign(['sub_business_unit_id']);
            $table->dropForeign(['job_function_id']);
            $table->dropForeign(['sub_function_id']);
            $table->dropForeign(['employee_type_id']);
            $table->dropForeign(['designation_master_id']);
            $table->dropForeign(['dynamic_role_id']);
            $table->dropForeign(['reporting_to_id']);
            $table->dropForeign(['function_supervisor_id']);
            
            $table->dropColumn([
                'middle_name', 'last_name', 'gender', 'effective_date',
                'company_id', 'business_unit_id', 'sub_business_unit_id',
                'job_function_id', 'sub_function_id', 'employee_type_id',
                'designation_master_id', 'dynamic_role_id', 'reporting_to_id',
                'function_supervisor_id', 'erc', 'work_phone_ext',
                'place_of_birth', 'retirement_date', 'confirmation_required',
                'probation_start_date', 'confirmation_date', 'confirmation_status',
                'employee_status', 'group_date_of_joining', 'access_code'
            ]);
        });
    }
};
