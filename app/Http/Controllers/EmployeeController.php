<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Models\Company;
use App\Models\BusinessUnit;
use App\Models\SubBusinessUnit;
use App\Models\JobFunction;
use App\Models\SubFunction;
use App\Models\Designation;
use App\Models\EmployeeType;
use App\Models\Location;
use App\Models\DynamicRole;
use App\Models\Bank;
use App\Models\EmployeeBankDetail;
use App\Models\EmployeeIdentityDetail;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['department', 'designation'])
            ->whereNotNull('employee_id');

        // Apply Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('employee_id', 'like', "%{$search}%");
            });
        }

        // Apply Department Filter
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        // Apply Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Handle Export
        if ($request->has('export')) {
            return $this->exportCsv($query->get());
        }

        $employees = $query->paginate(10)->withQueryString();
        $departments = Department::orderBy('name')->get();

        return view('employees.index', compact('employees', 'departments'));
    }

    private function exportCsv($employees)
    {
        $fileName = 'employees_export_' . now()->format('YmdHis') . '.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['Employee ID', 'Name', 'Email', 'Department', 'Designation', 'Status'];

        $callback = function() use($employees, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($employees as $employee) {
                fputcsv($file, [
                    $employee->employee_id,
                    $employee->name,
                    $employee->email,
                    $employee->department->name ?? 'N/A',
                    $employee->designation->designation_name ?? 'N/A',
                    $employee->status ?? 'Active'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        $companies = Company::orderBy('company_name')->get();
        $departments = Department::orderBy('name')->get();
        $businessUnits = BusinessUnit::orderBy('business_unit_name')->get();
        $subBusinessUnits = SubBusinessUnit::orderBy('sub_business_unit_name')->get();
        $jobFunctions = JobFunction::orderBy('function_name')->get();
        $subFunctions = SubFunction::orderBy('sub_function_name')->get();
        $designations = Designation::orderBy('designation_name')->get();
        $employeeTypes = EmployeeType::orderBy('type_name')->get();
        $locations = Location::orderBy('location_name')->get();
        $dynamicRoles = DynamicRole::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $allEmployees = User::whereNotNull('employee_id')->orderBy('name')->get();
        
        $hrUsers = User::role(User::ROLE_HR ?? 'HR')->get();
        if ($hrUsers->isEmpty()) {
            $hrUsers = User::all();
        }
        $roles = Role::all();
        $banks = Bank::orderBy('bank_name')->get();

        return view('employees.create', compact(
            'companies', 'departments', 'businessUnits', 'subBusinessUnits', 
            'jobFunctions', 'subFunctions', 'designations', 'employeeTypes', 
            'locations', 'dynamicRoles', 'users', 'allEmployees', 'hrUsers', 'roles', 'banks'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'employee_id' => 'required|string|unique:users',
            'company_id' => 'required|exists:companies,id',
            'business_unit_id' => 'required|exists:business_units,id',
            'sub_business_unit_id' => 'required|exists:sub_business_units,id',
            'location_id' => 'nullable|exists:locations,id',
            'job_function_id' => 'required|exists:job_functions,id',
            'sub_function_id' => 'required|exists:sub_functions,id',
            'designation_master_id' => 'required|exists:designations,id',
            'role' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $bankFields = [
            'bank_name_as_per_bank', 'salary_bank_id', 'salary_bank_ifsc', 'salary_account_number',
            'reimbursement_bank_id', 'reimbursement_bank_ifsc', 'reimbursement_account_number', 'payment_mode'
        ];

        $identityFields = [
            'passport_no', 'passport_place_of_issue', 'passport_date_of_issue', 'passport_expiry_date', 'passport_address',
            'visa_no', 'visa_expiry', 'work_permit_no', 'work_permit_expiry',
            'driving_licence_no', 'driving_licence_place_of_issue', 'driving_licence_date_of_issue', 'driving_licence_validity', 'driving_licence_address',
            'aadhar_no', 'pan_no'
        ];

        $data = $request->except(array_merge(['password', 'role', 'photo', 'document'], $bankFields, $identityFields));
        $data['name'] = $request->name . ($request->last_name ? ' ' . $request->last_name : '');
        $data['password'] = Hash::make($request->password ?? 'password123');

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('employees/photos', 'public');
        }

        if ($request->hasFile('document')) {
            $data['document_path'] = $request->file('document')->store('employees/documents', 'public');
        }

        $user = User::create($data);
        $user->assignRole($request->role ?? 'Employee');

        // Save Bank Details
        $user->bankDetails()->create([
            'name_as_per_bank' => $request->bank_name_as_per_bank,
            'salary_bank_id' => $request->salary_bank_id,
            'salary_bank_ifsc' => $request->salary_bank_ifsc,
            'salary_account_number' => $request->salary_account_number,
            'reimbursement_bank_id' => $request->reimbursement_bank_id,
            'reimbursement_bank_ifsc' => $request->reimbursement_bank_ifsc,
            'reimbursement_account_number' => $request->reimbursement_account_number,
            'payment_mode' => $request->payment_mode,
        ]);

        // Save Identity Details
        $identityData = $request->only($identityFields);
        
        $attachmentFields = [
            'passport_attachment', 'visa_attachment', 'work_permit_attachment', 
            'driving_licence_attachment', 'aadhar_attachment', 'pan_attachment'
        ];

        foreach ($attachmentFields as $field) {
            if ($request->hasFile($field)) {
                $identityData[$field] = $request->file($field)->store('employees/identity', 'public');
            }
        }

        $user->identityDetails()->create($identityData);

        return redirect()->route('employees.index')->with('success', 'Employee profile enrollment completed successfully.');
    }

    public function show($id)
    {
        $employee = User::with(['bankDetails', 'identityDetails'])->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = User::with(['bankDetails', 'identityDetails'])->findOrFail($id);
        
        $companies = Company::orderBy('company_name')->get();
        $departments = Department::orderBy('name')->get();
        $businessUnits = BusinessUnit::orderBy('business_unit_name')->get();
        $subBusinessUnits = SubBusinessUnit::orderBy('sub_business_unit_name')->get();
        $jobFunctions = JobFunction::orderBy('function_name')->get();
        $subFunctions = SubFunction::orderBy('sub_function_name')->get();
        $designations = Designation::orderBy('designation_name')->get();
        $employeeTypes = EmployeeType::orderBy('type_name')->get();
        $locations = Location::orderBy('location_name')->get();
        $dynamicRoles = DynamicRole::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $allEmployees = User::whereNotNull('employee_id')->orderBy('name')->get();
        $roles = Role::orderBy('name')->get();
        $banks = Bank::orderBy('bank_name')->get();

        return view('employees.edit', compact(
            'employee', 'companies', 'departments', 'businessUnits', 'subBusinessUnits', 
            'jobFunctions', 'subFunctions', 'designations', 'employeeTypes', 
            'locations', 'dynamicRoles', 'users', 'allEmployees', 'roles', 'banks'
        ));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'employee_id' => 'required|string|unique:users,employee_id,' . $user->id,
            'department_id' => 'nullable|exists:departments,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'nullable|mimes:pdf,doc,docx,zip|max:5120',
        ]);

        $bankFields = [
            'bank_name_as_per_bank', 'salary_bank_id', 'salary_bank_ifsc', 'salary_account_number',
            'reimbursement_bank_id', 'reimbursement_bank_ifsc', 'reimbursement_account_number', 'payment_mode'
        ];

        $identityFields = [
            'passport_no', 'passport_place_of_issue', 'passport_date_of_issue', 'passport_expiry_date', 'passport_address',
            'visa_no', 'visa_expiry', 'work_permit_no', 'work_permit_expiry',
            'driving_licence_no', 'driving_licence_place_of_issue', 'driving_licence_date_of_issue', 'driving_licence_validity', 'driving_licence_address',
            'aadhar_no', 'pan_no'
        ];

        $data = $request->except(array_merge(['password', 'role', 'photo', 'document'], $bankFields, $identityFields));

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->role) {
            $user->syncRoles([$request->role]);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo_path) Storage::disk('public')->delete($user->photo_path);
            $data['photo_path'] = $request->file('photo')->store('employees/photos', 'public');
        }

        if ($request->hasFile('document')) {
            if ($user->document_path) Storage::disk('public')->delete($user->document_path);
            $data['document_path'] = $request->file('document')->store('employees/documents', 'public');
        }

        $user->update($data);

        // Update Bank Details
        $user->bankDetails()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'name_as_per_bank' => $request->bank_name_as_per_bank,
                'salary_bank_id' => $request->salary_bank_id,
                'salary_bank_ifsc' => $request->salary_bank_ifsc,
                'salary_account_number' => $request->salary_account_number,
                'reimbursement_bank_id' => $request->reimbursement_bank_id,
                'reimbursement_bank_ifsc' => $request->reimbursement_bank_ifsc,
                'reimbursement_account_number' => $request->reimbursement_account_number,
                'payment_mode' => $request->payment_mode,
            ]
        );

        // Update Identity Details
        $identityData = $request->only($identityFields);
        
        $attachmentFields = [
            'passport_attachment', 'visa_attachment', 'work_permit_attachment', 
            'driving_licence_attachment', 'aadhar_attachment', 'pan_attachment'
        ];

        $currentIdentity = $user->identityDetails;

        foreach ($attachmentFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($currentIdentity && $currentIdentity->$field) {
                    Storage::disk('public')->delete($currentIdentity->$field);
                }
                $identityData[$field] = $request->file($field)->store('employees/identity', 'public');
            }
        }

        $user->identityDetails()->updateOrCreate(
            ['user_id' => $user->id],
            $identityData
        );

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->photo_path) Storage::disk('public')->delete($user->photo_path);
        if ($user->document_path) Storage::disk('public')->delete($user->document_path);
        
        $user->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
