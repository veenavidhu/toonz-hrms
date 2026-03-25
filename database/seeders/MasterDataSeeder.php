<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Department;
use App\Models\BusinessUnit;
use App\Models\SubBusinessUnit;
use App\Models\JobFunction;
use App\Models\SubFunction;
use App\Models\Designation;
use App\Models\EmployeeType;
use App\Models\DynamicRole;
use App\Models\Bank;

class MasterDataSeeder extends Seeder
{
    public function run()
    {
        // Fetch random location for company
        $country = DB::table('countries')->first();
        $state = DB::table('states')->first();
        $city = DB::table('cities')->first();

        // Add default Company
        if ($country && $state && $city) {
            Company::firstOrCreate(
                ['company_name' => 'Demo Corporation'],
                [
                    'company_address' => '123 Tech Park, Silicon Valley',
                    'country_id' => $country->id,
                    'state_id' => $state->id,
                    'city_id' => $city->id,
                    'postal_code' => '10001',
                    'phone_no' => '+1234567890',
                    'pf_no' => 'PF123456',
                    'esi_no' => 'ESI123456',
                    'pan_no' => 'ABCDE1234F',
                    'tan_no' => 'DEL12345',
                    'tds_circle' => 'Zone A',
                    'uen' => 'UEN1234',
                    'registration_no' => 'REG987654',
                    'lst_no' => 'LST111',
                    'cst_no' => 'CST222',
                    'service_tax_no' => 'STX333',
                    'email_id' => 'info@democorp.com',
                    'reg_address' => '123 Registered Office',
                    'reg_city' => 'Metropolis',
                    'reg_pin_no' => '10001',
                ]
            );
        }

        // Add default Departments
        $depts = ['Engineering', 'Human Resources', 'Sales', 'Marketing', 'Finance', 'Operations'];
        foreach ($depts as $dept) {
            Department::firstOrCreate(['name' => $dept]);
        }

        // Add default Business Units
        $bus = ['Software Development', 'Hardware Systems', 'Customer Success'];
        $buModels = [];
        foreach ($bus as $bu) {
            $buModels[] = BusinessUnit::firstOrCreate(['business_unit_name' => $bu]);
        }

        // Add default Sub Business Units
        $sbus = ['Backend Systems', 'Frontend UI/UX', 'Cloud Infrastructure'];
        foreach ($sbus as $sbu) {
            SubBusinessUnit::firstOrCreate([
                'sub_business_unit_name' => $sbu
            ]);
        }

        // Add Job Functions
        $functions = ['Technology', 'Administration', 'Support', 'Logistics'];
        foreach ($functions as $func) {
            JobFunction::firstOrCreate(['function_name' => $func]);
        }

        // Add Sub Functions
        $subFunctions = ['Quality Assurance', 'IT Support', 'Talent Acquisition', 'Payroll'];
        foreach ($subFunctions as $sfunc) {
            SubFunction::firstOrCreate(['sub_function_name' => $sfunc]);
        }

        // Add Designations
        $designations = ['CEO', 'Director', 'Manager', 'Team Lead', 'Senior Developer', 'Junior Developer', 'HR Assistant', 'Sales Executive', 'QA Engineer', 'Accountant'];
        foreach ($designations as $desig) {
            Designation::firstOrCreate(['designation_name' => $desig]);
        }

        // Add Employee Types
        $types = [
            ['type_name' => 'Permanent', 'type_code' => 'PERM'],
            ['type_name' => 'Contractor', 'type_code' => 'CONT'],
            ['type_name' => 'Internship', 'type_code' => 'INTN'],
            ['type_name' => 'Probation', 'type_code' => 'PROB'],
        ];
        foreach ($types as $type) {
            if (\Schema::hasColumn('employee_types', 'type_code')) {
                EmployeeType::firstOrCreate(['type_name' => $type['type_name']], $type);
            } else {
                EmployeeType::firstOrCreate(['type_name' => $type['type_name']]);
            }
        }

        // Dynamic Roles
        $roles = ['Administrator', 'Manager', 'Employee', 'HR Executive'];
        foreach ($roles as $role) {
            DynamicRole::firstOrCreate(
                ['name' => $role],
                [
                    'effective_date' => now()->toDateString(),
                    'created_by' => 1,
                    'status' => true
                ]
            );
        }

        // Add Banks
        $banks = [
            ['bank_name' => 'State Bank of India', 'bank_code' => 'SBI', 'ifsc_code' => 'SBIN0001234'],
            ['bank_name' => 'HDFC Bank', 'bank_code' => 'HDFC', 'ifsc_code' => 'HDFC0005678'],
            ['bank_name' => 'ICICI Bank', 'bank_code' => 'ICICI', 'ifsc_code' => 'ICIC0009012'],
        ];
        foreach ($banks as $bank) {
            Bank::firstOrCreate(['bank_name' => $bank['bank_name']], $bank);
        }
    }
}
