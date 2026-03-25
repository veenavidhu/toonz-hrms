<x-app-layout>
    <x-slot name="header">Edit Employee Profile</x-slot>

    <div x-data="{ activeTab: 'official' }" class="px-6 pb-12 max-w-[1600px] mx-auto pt-6">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            
            <!-- Left Sidebar Navigation -->
            <div class="w-full lg:w-80 flex-shrink-0 space-y-3">
                <button @click="activeTab = 'official'"
                    :class="activeTab === 'official' ? 'bg-[#004499] text-white shadow-lg shadow-blue-900/20' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100' "
                    class="w-full h-14 flex items-center px-4 rounded-lg transition-all duration-300 group">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 transition-colors"
                        :class="activeTab === 'official' ? 'bg-white/20' : 'bg-gray-50 group-hover:bg-blue-50 text-blue-500'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest">Official Details</span>
                </button>

                <button @click="activeTab = 'bank'"
                    :class="activeTab === 'bank' ? 'bg-[#004499] text-white shadow-lg shadow-blue-900/20' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100' "
                    class="w-full h-14 flex items-center px-4 rounded-lg transition-all duration-300 group">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 transition-colors"
                        :class="activeTab === 'bank' ? 'bg-white/20' : 'bg-gray-50 group-hover:bg-blue-50 text-blue-500'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest">Bank Details</span>
                </button>

                <button @click="activeTab = 'identity'"
                    :class="activeTab === 'identity' ? 'bg-[#004499] text-white shadow-lg shadow-blue-900/20' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100' "
                    class="w-full h-14 flex items-center px-4 rounded-lg transition-all duration-300 group">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 transition-colors"
                        :class="activeTab === 'identity' ? 'bg-white/20' : 'bg-gray-50 group-hover:bg-blue-50 text-blue-500'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-4 0a1 1 0 011-1h2a1 1 0 011 1v1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest">Identity Details</span>
                </button>
                
                <div class="pt-6 px-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 ml-1">Lifecycle Management</p>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-gray-500 ml-1">Employment Status</label>
                            <select name="status" form="editForm"
                                class="w-full px-4 py-2 bg-white border border-gray-100 rounded text-xs font-bold outline-none focus:ring-1 focus:ring-blue-500 transition-all cursor-pointer searchable-select">
                                <option value="Active" {{ $employee->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $employee->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Terminated" {{ $employee->status == 'Terminated' ? 'selected' : '' }}>Terminated</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Area -->
            <div class="flex-1 w-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden min-h-[850px]">
                <form id="editForm" action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Section Header -->
                    <div class="px-8 py-4 border-b border-gray-50 bg-[#004499] flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <h3 class="text-xs font-black text-white uppercase tracking-widest" 
                                x-text="activeTab === 'official' ? 'Edit Official Details' : (activeTab === 'bank' ? 'Edit Bank Details' : 'Edit Identity Verification')">
                            </h3>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="flex items-center gap-2">
                                <label class="text-[11px] font-black text-white uppercase tracking-widest">Effective Date</label>
                                <input type="date" name="effective_date" value="{{ old('effective_date', $employee->effective_date ?? date('Y-m-d')) }}"
                                    class="px-4 py-2 bg-white/10 border border-white/20 rounded text-[11px] font-bold text-white outline-none focus:bg-white focus:text-gray-800">
                            </div>
                        </div>
                    </div>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mx-8 mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <h4 class="text-[12px] font-bold text-red-700 uppercase tracking-tight">Please fix the following errors:</h4>
                            </div>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-[11px] font-semibold text-red-600">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Official Details Tab Content -->
                    <div x-show="activeTab === 'official'" class="p-8 space-y-6 animate-fadeIn">
                        
                        {{-- Row 1: Names --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">First Name <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" required value="{{ old('name', explode(' ', $employee->name)[0] ?? '') }}" placeholder="First Name"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Middle Name</label>
                                <input type="text" name="middle_name" value="{{ old('middle_name', $employee->middle_name) }}" placeholder="Middle Name"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" placeholder="Last Name"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        {{-- Row 2: Gender, Code, Email --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Gender</label>
                                <select name="gender"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $employee->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Employee Code <span class="text-rose-500">*</span></label>
                                <input type="text" name="employee_id" required value="{{ old('employee_id', $employee->employee_id) }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Official Email <span class="text-rose-500">*</span></label>
                                <input type="email" name="email" required value="{{ old('email', $employee->email ?? '') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                        </div>

                        {{-- Row 3: Joining, Company, BU --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Joining</label>
                                <input type="date" name="date_of_joining" value="{{ old('date_of_joining', $employee->date_of_joining) }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Company <span class="text-rose-500">*</span></label>
                                <select name="company_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Business Unit <span class="text-rose-500">*</span></label>
                                <select name="business_unit_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    @foreach($businessUnits as $bu)
                                        <option value="{{ $bu->id }}" {{ $employee->business_unit_id == $bu->id ? 'selected' : '' }}>{{ $bu->business_unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Row 4: SBU, Function, SubFunction --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Sub Business Unit <span class="text-rose-500">*</span></label>
                                <select name="sub_business_unit_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    @foreach($subBusinessUnits as $sbu)
                                        <option value="{{ $sbu->id }}" {{ $employee->sub_business_unit_id == $sbu->id ? 'selected' : '' }}>{{ $sbu->sub_business_unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Job Function <span class="text-rose-500">*</span></label>
                                <select name="job_function_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    @foreach($jobFunctions as $fn)
                                        <option value="{{ $fn->id }}" {{ $employee->job_function_id == $fn->id ? 'selected' : '' }}>{{ $fn->function_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Sub Function <span class="text-rose-500">*</span></label>
                                <select name="sub_function_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    @foreach($subFunctions as $sfn)
                                        <option value="{{ $sfn->id }}" {{ $employee->sub_function_id == $sfn->id ? 'selected' : '' }}>{{ $sfn->sub_function_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Row 5: Designation, Role --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Designation <span class="text-rose-500">*</span></label>
                                <select name="designation_master_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    @foreach($designations as $des)
                                        <option value="{{ $des->id }}" {{ $employee->designation_master_id == $des->id ? 'selected' : '' }}>{{ $des->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Role <span class="text-rose-500">*</span></label>
                                <select name="role" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select Role...</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $employee->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Employee Status</label>
                                <select name="employee_status"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="active" {{ $employee->employee_status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="resigned" {{ $employee->employee_status == 'resigned' ? 'selected' : '' }}>Resigned</option>
                                    <option value="inactive" {{ $employee->employee_status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="suspend" {{ $employee->employee_status == 'suspend' ? 'selected' : '' }}>Suspend</option>
                                </select>
                            </div>
                        </div>

                        {{-- Row: DOB, Place of Birth, Retirement Date --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Birth</label>
                                <input type="date" name="dob" value="{{ old('dob', $employee->dob) }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Place Of Birth</label>
                                <input type="text" name="place_of_birth" value="{{ old('place_of_birth', $employee->place_of_birth) }}" placeholder="Place of Birth"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Retirement Date</label>
                                <input type="date" name="retirement_date" value="{{ old('retirement_date', $employee->retirement_date) }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        {{-- Row: Confirmation Required, Probation Start, Confirmation Date --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Confirmation Required</label>
                                <select name="confirmation_required"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="0" {{ old('confirmation_required', $employee->confirmation_required) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('confirmation_required', $employee->confirmation_required) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Probation Start Date</label>
                                <input type="date" name="probation_start_date" value="{{ old('probation_start_date', $employee->probation_start_date) }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Confirmation Date</label>
                                <input type="date" name="confirmation_date" value="{{ old('confirmation_date', $employee->confirmation_date) }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        {{-- Row: Confirmation Status --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Confirmation Status</label>
                                <select name="confirmation_status"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="NA" {{ old('confirmation_status', $employee->confirmation_status) == 'NA' ? 'selected' : '' }}>NA</option>
                                    <option value="Probation" {{ old('confirmation_status', $employee->confirmation_status) == 'Probation' ? 'selected' : '' }}>Probation</option>
                                    <option value="Confirmed" {{ old('confirmation_status', $employee->confirmation_status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="Extended" {{ old('confirmation_status', $employee->confirmation_status) == 'Extended' ? 'selected' : '' }}>Extended</option>
                                    <option value="Recommended" {{ old('confirmation_status', $employee->confirmation_status) == 'Recommended' ? 'selected' : '' }}>Recommended</option>
                                    <option value="Not_Confirmed" {{ old('confirmation_status', $employee->confirmation_status) == 'Not_Confirmed' ? 'selected' : '' }}>Not Confirmed</option>
                                </select>
                            </div>
                        </div>

                        {{-- Row: Password Update --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Update Password</label>
                                <input type="password" name="password" placeholder="Leave blank to keep current"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                        </div>

                        <div class="pt-6 flex justify-end">
                            <button type="submit" class="px-8 py-3 bg-[#004499] text-white rounded font-bold text-[12px] uppercase tracking-widest hover:bg-blue-900 transition-all shadow-md">
                                Update Employee Profile
                            </button>
                        </div>
                    </div>

                    <!-- Bank Details Tab Content -->
                    <div x-show="activeTab === 'bank'" 
                        x-data="{ 
                            sameBank: false,
                            salaryBankName: '{{ $employee->bankDetails->salary_bank_id ?? '' }}',
                            salaryIfsc: '{{ $employee->bankDetails->salary_bank_ifsc ?? '' }}',
                            reimbursementBankName: '{{ $employee->bankDetails->reimbursement_bank_id ?? '' }}',
                            reimbursementIfsc: '{{ $employee->bankDetails->reimbursement_bank_ifsc ?? '' }}',
                            syncBanks() {
                                if(this.sameBank) {
                                    this.reimbursementBankName = this.salaryBankName;
                                    this.reimbursementIfsc = this.salaryIfsc;
                                }
                            }
                        }"
                        class="p-8 space-y-8 animate-fadeIn">
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {{-- Name As Per Bank --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Name As Per Bank</label>
                                <input type="text" name="bank_name_as_per_bank" value="{{ old('bank_name_as_per_bank', $employee->bankDetails->name_as_per_bank ?? '') }}" placeholder="Name As Per Bank"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all uppercase">
                            </div>

                            {{-- Salary Bank Name --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Salary Bank Name <span class="text-rose-500">*</span></label>
                                <select name="salary_bank_id" x-model="salaryBankName" @change="syncBanks()"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="">Select Bank...</option>
                                    @foreach($banks ?? [] as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- IFSC Code --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">IFSC Code <span class="text-rose-500">*</span></label>
                                <input type="text" name="salary_bank_ifsc" x-model="salaryIfsc" @input="syncBanks()" value="{{ old('salary_bank_ifsc', $employee->bankDetails->salary_bank_ifsc ?? '') }}" placeholder="IFSC CODE"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all uppercase">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {{-- Salary Account No --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Salary Account No <span class="text-rose-500">*</span></label>
                                <input type="text" name="salary_account_number" value="{{ old('salary_account_number', $employee->bankDetails->salary_account_number ?? '') }}" placeholder="Numeric Only"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        {{-- Same Bank Checkbox --}}
                        <div class="flex items-center gap-2 py-2">
                            <input type="checkbox" id="same_bank" x-model="sameBank" @change="syncBanks()"
                                class="w-4 h-4 text-[#004499] border-gray-300 rounded focus:ring-[#004499]">
                            <label for="same_bank" class="text-[11px] font-bold text-gray-500 uppercase tracking-tight cursor-pointer">Check this box for same salary bank.</label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-2">
                            {{-- Reimbursement Bank Name --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Reimbursement Bank Name</label>
                                <select name="reimbursement_bank_id" x-model="reimbursementBankName" :disabled="sameBank"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all disabled:opacity-60">
                                    <option value="">Select Bank...</option>
                                    @foreach($banks ?? [] as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Reimbursement IFSC --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">IFSC Code</label>
                                <input type="text" name="reimbursement_bank_ifsc" x-model="reimbursementIfsc" :disabled="sameBank" value="{{ old('reimbursement_bank_ifsc', $employee->bankDetails->reimbursement_bank_ifsc ?? '') }}" placeholder="IFSC CODE"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all uppercase disabled:opacity-60">
                            </div>

                            {{-- Reimbursement Account No --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Reimbursement Account No.</label>
                                <input type="text" name="reimbursement_account_number" value="{{ old('reimbursement_account_number', $employee->bankDetails->reimbursement_account_number ?? '') }}" placeholder="Numeric Only"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {{-- Payment Mode --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Payment mode.</label>
                                <select name="payment_mode"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="">Select...</option>
                                    <option value="Bank Transfer" {{ (old('payment_mode', $employee->bankDetails->payment_mode ?? '') == 'Bank Transfer') ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="Cheque" {{ (old('payment_mode', $employee->bankDetails->payment_mode ?? '') == 'Cheque') ? 'selected' : '' }}>Cheque</option>
                                    <option value="Cash" {{ (old('payment_mode', $employee->bankDetails->payment_mode ?? '') == 'Cash') ? 'selected' : '' }}>Cash</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-10 flex justify-end gap-3">
                            <button type="button" @click="activeTab = 'official'" 
                                class="px-8 py-3 bg-gray-100 text-gray-500 rounded font-bold text-[12px] uppercase tracking-widest hover:bg-gray-200 transition-all">
                                Previous
                            </button>
                            <button type="submit" class="px-8 py-3 bg-[#004499] text-white rounded font-bold text-[12px] uppercase tracking-widest hover:bg-blue-900 transition-all shadow-md">
                                Update Employee Profile
                            </button>
                        </div>
                    </div>

                    <!-- Identity Details Tab Content -->
                    <div x-show="activeTab === 'identity'" class="p-8 space-y-8 animate-fadeIn">
                        
                        {{-- Passport Details Section --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                                <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                <h4 class="text-[11px] font-black text-gray-800 uppercase tracking-widest">Passport Details</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Passport No</label>
                                    <input type="text" name="passport_no" value="{{ old('passport_no', $employee->identityDetails->passport_no ?? '') }}" placeholder="Passport No."
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Place Of Issue</label>
                                    <input type="text" name="passport_place_of_issue" value="{{ old('passport_place_of_issue', $employee->identityDetails->passport_place_of_issue ?? '') }}" placeholder="Place Of Issue"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Issue</label>
                                    <input type="date" name="passport_date_of_issue" value="{{ old('passport_date_of_issue', $employee->identityDetails->passport_date_of_issue ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Passport Validity</label>
                                    <input type="date" name="passport_expiry_date" value="{{ old('passport_expiry_date', $employee->identityDetails->passport_expiry_date ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1 md:col-span-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Address On Passport</label>
                                    <input type="text" name="passport_address" value="{{ old('passport_address', $employee->identityDetails->passport_address ?? '') }}" placeholder="Address On Passport"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Passport Attachment</label>
                                    <input type="file" name="passport_attachment" 
                                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-black file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    @if($employee->identityDetails->passport_attachment ?? false)
                                        <a href="{{ Storage::url($employee->identityDetails->passport_attachment) }}" target="_blank" class="text-[10px] text-blue-500 font-bold hover:underline mt-1 block">View Current Passport</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- VISA & Work Permit Section --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                                <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                <h4 class="text-[11px] font-black text-gray-800 uppercase tracking-widest">VISA & WORK PERMIT DETAILS</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Visa Number</label>
                                    <input type="text" name="visa_no" value="{{ old('visa_no', $employee->identityDetails->visa_no ?? '') }}" placeholder="Visa Number"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Visa Expiry</label>
                                    <input type="date" name="visa_expiry" value="{{ old('visa_expiry', $employee->identityDetails->visa_expiry ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Visa Attachment</label>
                                    <input type="file" name="visa_attachment"
                                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-black file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    @if($employee->identityDetails->visa_attachment ?? false)
                                        <a href="{{ Storage::url($employee->identityDetails->visa_attachment) }}" target="_blank" class="text-[10px] text-blue-500 font-bold hover:underline mt-1 block">View Current Visa</a>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Work Permit Number</label>
                                    <input type="text" name="work_permit_no" value="{{ old('work_permit_no', $employee->identityDetails->work_permit_no ?? '') }}" placeholder="Work Permit Number"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">WP Expiry</label>
                                    <input type="date" name="work_permit_expiry" value="{{ old('work_permit_expiry', $employee->identityDetails->work_permit_expiry ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">WP Attachment</label>
                                    <input type="file" name="work_permit_attachment"
                                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-black file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    @if($employee->identityDetails->work_permit_attachment ?? false)
                                        <a href="{{ Storage::url($employee->identityDetails->work_permit_attachment) }}" target="_blank" class="text-[10px] text-blue-500 font-bold hover:underline mt-1 block">View Current WP</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Driving Details Section --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                                <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                <h4 class="text-[11px] font-black text-gray-800 uppercase tracking-widest">DRIVING DETAILS</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Driving Licence No</label>
                                    <input type="text" name="driving_licence_no" value="{{ old('driving_licence_no', $employee->identityDetails->driving_licence_no ?? '') }}" placeholder="Driving Licence No"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Place of Issue</label>
                                    <input type="text" name="driving_licence_place_of_issue" value="{{ old('driving_licence_place_of_issue', $employee->identityDetails->driving_licence_place_of_issue ?? '') }}" placeholder="Place Of Issue"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Issue</label>
                                    <input type="date" name="driving_licence_date_of_issue" value="{{ old('driving_licence_date_of_issue', $employee->identityDetails->driving_licence_date_of_issue ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">DL Validity</label>
                                    <input type="date" name="driving_licence_validity" value="{{ old('driving_licence_validity', $employee->identityDetails->driving_licence_validity ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Driving Licence Address</label>
                                    <input type="text" name="driving_licence_address" value="{{ old('driving_licence_address', $employee->identityDetails->driving_licence_address ?? '') }}" placeholder="Driving Licence Address"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">DL Attachment</label>
                                    <input type="file" name="driving_licence_attachment"
                                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-black file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    @if($employee->identityDetails->driving_licence_attachment ?? false)
                                        <a href="{{ Storage::url($employee->identityDetails->driving_licence_attachment) }}" target="_blank" class="text-[10px] text-blue-500 font-bold hover:underline mt-1 block">View Current DL</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Others Section --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                                <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                <h4 class="text-[11px] font-black text-gray-800 uppercase tracking-widest">OTHERS DETAILS</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Aadhaar Card No.</label>
                                    <input type="text" name="aadhar_no" value="{{ old('aadhar_no', $employee->identityDetails->aadhar_no ?? '') }}" placeholder="Aadhaar Card No."
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Aadhar Attachment</label>
                                    <input type="file" name="aadhar_attachment"
                                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-black file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    @if($employee->identityDetails->aadhar_attachment ?? false)
                                        <a href="{{ Storage::url($employee->identityDetails->aadhar_attachment) }}" target="_blank" class="text-[10px] text-blue-500 font-bold hover:underline mt-1 block">View Current Aadhar</a>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">PAN No</label>
                                    <input type="text" name="pan_no" value="{{ old('pan_no', $employee->identityDetails->pan_no ?? '') }}" placeholder="PAN No"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Pan Attachment</label>
                                    <input type="file" name="pan_attachment"
                                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-black file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    @if($employee->identityDetails->pan_attachment ?? false)
                                        <a href="{{ Storage::url($employee->identityDetails->pan_attachment) }}" target="_blank" class="text-[10px] text-blue-500 font-bold hover:underline mt-1 block">View Current PAN</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 flex justify-end gap-3">
                            <button type="button" @click="activeTab = 'bank'" 
                                class="px-8 py-3 bg-gray-100 text-gray-500 rounded font-bold text-[12px] uppercase tracking-widest hover:bg-gray-200 transition-all">
                                Previous
                            </button>
                            <button type="submit" class="px-8 py-3 bg-[#004499] text-white rounded font-bold text-[12px] uppercase tracking-widest hover:bg-blue-900 transition-all shadow-md">
                                Update Employee Profile
                            </button>
                        </div>
                    </div>

                    <!-- Separation Details Tab Content -->
                    <div x-show="activeTab === 'separation'" class="p-8 space-y-8 animate-fadeIn">
                        <div class="space-y-6">
                            <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                                <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                <h4 class="text-[11px] font-black text-gray-800 uppercase tracking-widest">Separation Information</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Employee Separation Status <span class="text-red-500">*</span></label>
                                    <select name="separation_status" 
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                        <option value="">select</option>
                                        <option value="01" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '01') ? 'selected' : '' }}>Active</option>
                                        <option value="07" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '07') ? 'selected' : '' }}>Death</option>
                                        <option value="11" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '11') ? 'selected' : '' }}>Future Hire</option>
                                        <option value="04" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '04') ? 'selected' : '' }}>Inactive</option>
                                        <option value="10" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '10') ? 'selected' : '' }}>LOA out</option>
                                        <option value="02" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '02') ? 'selected' : '' }}>Payhold</option>
                                        <option value="05" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '05') ? 'selected' : '' }}>Retired</option>
                                        <option value="08" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '08') ? 'selected' : '' }}>Stop Processing</option>
                                        <option value="06" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '06') ? 'selected' : '' }}>Suspended</option>
                                        <option value="03" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '03') ? 'selected' : '' }}>Terminated</option>
                                        <option value="09" {{ (old('separation_status', $employee->separationDetails->status ?? '') == '09') ? 'selected' : '' }}>Transfer out</option>
                                    </select>
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Leaving <span class="text-red-500">*</span></label>
                                    <input type="date" name="date_of_leaving" value="{{ old('date_of_leaving', $employee->separationDetails->date_of_leaving ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Leaving Reason</label>
                                    <input type="text" name="leaving_reason" value="{{ old('leaving_reason', $employee->separationDetails->leaving_reason ?? '') }}" placeholder="Leaving Reason"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Settlement</label>
                                    <input type="date" name="date_of_settlement" value="{{ old('date_of_settlement', $employee->separationDetails->date_of_settlement ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Resignation <span class="text-red-500">*</span></label>
                                    <input type="date" name="date_of_resignation" value="{{ old('date_of_resignation', $employee->separationDetails->date_of_resignation ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Contract Start Date</label>
                                    <input type="date" name="contract_start_date" value="{{ old('contract_start_date', $employee->separationDetails->contract_start_date ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-1">
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Contract End Date</label>
                                    <input type="date" name="contract_end_date" value="{{ old('contract_end_date', $employee->separationDetails->contract_end_date ?? '') }}"
                                        class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 flex justify-end gap-3">
                            <button type="button" @click="activeTab = 'identity'" 
                                class="px-8 py-3 bg-gray-100 text-gray-500 rounded font-bold text-[12px] uppercase tracking-widest hover:bg-gray-200 transition-all">
                                Previous
                            </button>
                            <button type="submit" class="px-8 py-3 bg-[#004499] text-white rounded font-bold text-[12px] uppercase tracking-widest hover:bg-blue-900 transition-all shadow-md">
                                Update Employee Profile
                            </button>
                        </div>
                    </div>

                    <!-- Other Tabs... -->
                    <div x-show="!['official', 'bank', 'identity', 'separation'].includes(activeTab)" class="p-8 text-center text-gray-400 font-bold uppercase tracking-widest animate-fadeIn">
                        Work in Progress for <span x-text="activeTab"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Select2 Initialization for large dropdowns -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Minimal clean Tailwind-matching Select2 style */
        .select2-container .select2-selection--single {
            height: 38px !important;
            background-color: #F6F8FA !important;
            border: 1px solid #E5E7EB !important;
            border-radius: 0.25rem !important;
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #4B5563 !important;
            font-size: 12px !important;
            font-weight: bold !important;
            padding-left: 12px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--open .select2-selection--single {
            border-color: #E5E7EB !important;
            box-shadow: 0 0 0 1px #2563eb !important;
            background-color: white !important;
        }
        .select2-results__option--highlighted[aria-selected],
        .select2-results__option--selected {
            background-color: #2563eb !important;
            color: white !important;
        }
        .select2-search__field:focus {
            outline: none !important;
            box-shadow: none !important;
            border: 1px solid #2563eb !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var initSelect2 = function() {
                if (window.jQuery && window.jQuery.fn.select2) {
                    window.jQuery('.searchable-dropdown').select2({
                        width: '100%',
                        placeholder: "Select an option..."
                    });
                } else {
                    setTimeout(initSelect2, 50);
                }
            };
            initSelect2();
        });
    </script>
</x-app-layout>
