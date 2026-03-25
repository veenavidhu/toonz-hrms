<x-app-layout>
    <x-slot name="header">New Employee Enrollment</x-slot>

    <div x-data="{ activeTab: 'official' }" class="px-6 pb-12 max-w-[1600px] mx-auto pt-6">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
            
            <!-- Left Sidebar Navigation (Matching Image) -->
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

                <button @click="activeTab = 'separation'"
                    :class="activeTab === 'separation' ? 'bg-[#004499] text-white shadow-lg shadow-blue-900/20' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100' "
                    class="w-full h-14 flex items-center px-4 rounded-lg transition-all duration-300 group">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 transition-colors"
                        :class="activeTab === 'separation' ? 'bg-white/20' : 'bg-gray-50 group-hover:bg-blue-50 text-blue-500'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest">Separation Details</span>
                </button>

                <button @click="activeTab = 'statutory'"
                    :class="activeTab === 'statutory' ? 'bg-[#004499] text-white shadow-lg shadow-blue-900/20' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100' "
                    class="w-full h-14 flex items-center px-4 rounded-lg transition-all duration-300 group">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 transition-colors"
                        :class="activeTab === 'statutory' ? 'bg-white/20' : 'bg-gray-50 group-hover:bg-blue-50 text-blue-500'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest">Statutory Details</span>
                </button>

                <button @click="activeTab = 'payroll'"
                    :class="activeTab === 'payroll' ? 'bg-[#004499] text-white shadow-lg shadow-blue-900/20' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100' "
                    class="w-full h-14 flex items-center px-4 rounded-lg transition-all duration-300 group">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 transition-colors"
                        :class="activeTab === 'payroll' ? 'bg-white/20' : 'bg-gray-50 group-hover:bg-blue-50 text-blue-500'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest">Payroll Information</span>
                </button>
            </div>

            <!-- Right Content Area -->
            <div class="flex-1 w-full bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden min-h-[850px]">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Section Header -->
                    <div class="px-8 py-4 border-b border-gray-50 bg-[#004499] flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <template x-if="activeTab === 'official'">
                                    <svg class="w-full h-full text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                </template>
                            </div>
                            <h3 class="text-xs font-black text-white uppercase tracking-widest" 
                                x-text="activeTab === 'official' ? 'Official Details' : (activeTab === 'bank' ? 'Bank Details' : (activeTab === 'identity' ? 'Identity Details' : (activeTab === 'separation' ? 'Separation Details' : (activeTab === 'statutory' ? 'Statutory Details' : 'Payroll Information'))))">
                            </h3>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="flex items-center gap-2">
                                <label class="text-[11px] font-black text-white uppercase tracking-widest">Effective Date *</label>
                                <input type="date" name="effective_date" value="{{ date('Y-m-d') }}"
                                    class="px-4 py-2 bg-white/10 border border-white/20 rounded text-[11px] font-bold text-white outline-none focus:bg-white focus:text-gray-800">
                            </div>
                            <p class="text-[10px] text-blue-100 font-bold italic tracking-tight">These changes will be effective from given below date</p>
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
                                <input type="text" name="name" required value="{{ old('name') }}" placeholder="First Name"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Middle Name</label>
                                <input type="text" name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        {{-- Row 2: Gender, Code, Email --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Gender</label>
                                <select name="gender"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Employee Code <span class="text-rose-500">*</span></label>
                                <input type="text" name="employee_id" required value="{{ old('employee_id') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Official Email <span class="text-rose-500">*</span></label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                        </div>

                        {{-- Row 3: Joining, Company, BU --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Joining</label>
                                <input type="date" name="date_of_joining" value="{{ old('date_of_joining') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Company <span class="text-rose-500">*</span></label>
                                <select name="company_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select...</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Business Unit <span class="text-rose-500">*</span></label>
                                <select name="business_unit_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select...</option>
                                    @foreach($businessUnits as $bu)
                                        <option value="{{ $bu->id }}">{{ $bu->business_unit_name }}</option>
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
                                    <option value="">Select...</option>
                                    @foreach($subBusinessUnits as $sbu)
                                        <option value="{{ $sbu->id }}">{{ $sbu->sub_business_unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Job Function <span class="text-rose-500">*</span></label>
                                <select name="job_function_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select...</option>
                                    @foreach($jobFunctions as $fn)
                                        <option value="{{ $fn->id }}">{{ $fn->function_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Sub Function <span class="text-rose-500">*</span></label>
                                <select name="sub_function_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select...</option>
                                    @foreach($subFunctions as $sfn)
                                        <option value="{{ $sfn->id }}">{{ $sfn->sub_function_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Row 5: Designation, Role, Employee Type --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Designation <span class="text-rose-500">*</span></label>
                                <select name="designation_master_id" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select...</option>
                                    @foreach($designations as $des)
                                        <option value="{{ $des->id }}">{{ $des->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Role <span class="text-rose-500">*</span></label>
                                <select name="role" required
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select Role...</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Employee Type</label>
                                <select name="employee_type_id"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select...</option>
                                    @foreach($employeeTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Row 6: Reporting To, Supervisor, ERO --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Reporting To (L1)</label>
                                <select name="reporting_to_id"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select Manager...</option>
                                    @foreach($allEmployees as $emp)
                                        <option value="{{ $emp->id }}" {{ old('reporting_to_id') == $emp->id ? 'selected' : '' }}>{{ $emp->employee_id }} - {{ $emp->name ?? 'N/A' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Functional Supervisor (L2)</label>
                                <select name="function_supervisor_id"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select Supervisor...</option>
                                    @foreach($allEmployees as $emp)
                                        <option value="{{ $emp->id }}" {{ old('function_supervisor_id') == $emp->id ? 'selected' : '' }}>{{ $emp->employee_id }} - {{ $emp->name ?? 'N/A' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">ERO (HR User Roles)</label>
                                <select name="erc"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all searchable-dropdown">
                                    <option value="">Select ERO...</option>
                                    @foreach($hrUsers as $hrUser)
                                        <option value="{{ $hrUser->id }}">{{ $hrUser->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Row 7: Work Phone, Ext, Status --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                             <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Work Phone</label>
                                <input type="text" name="work_phone" value="{{ old('work_phone') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Work Phone Ext.</label>
                                <input type="text" name="work_phone_ext" value="{{ old('work_phone_ext') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Employee Status</label>
                                <select name="employee_status"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="active" {{ old('employee_status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="resigned" {{ old('employee_status') == 'resigned' ? 'selected' : '' }}>Resigned</option>
                                    <option value="inactive" {{ old('employee_status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="suspend" {{ old('employee_status') == 'suspend' ? 'selected' : '' }}>Suspend</option>
                                </select>
                            </div>
                        </div>

                        {{-- Row 8: DOB, Place of Birth, Retirement Date --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Date Of Birth</label>
                                <input type="date" name="dob" value="{{ old('dob') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Place Of Birth</label>
                                <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" placeholder="Place of Birth"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Retirement Date</label>
                                <input type="date" name="retirement_date" value="{{ old('retirement_date') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        {{-- Row 9: Confirmation Required, Probation Start Date, Confirmation Date --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Confirmation Required</label>
                                <select name="confirmation_required"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="0" {{ old('confirmation_required') == '0' ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('confirmation_required') == '1' ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Probation Start Date</label>
                                <input type="date" name="probation_start_date" value="{{ old('probation_start_date') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Confirmation Date</label>
                                <input type="date" name="confirmation_date" value="{{ old('confirmation_date') }}"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                            </div>
                        </div>

                        {{-- Row 10: Confirmation Status --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Confirmation Status</label>
                                <select name="confirmation_status"
                                    class="w-full px-3 py-2 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                                    <option value="NA" {{ old('confirmation_status') == 'NA' ? 'selected' : '' }}>NA</option>
                                    <option value="Probation" {{ old('confirmation_status') == 'Probation' ? 'selected' : '' }}>Probation</option>
                                    <option value="Confirmed" {{ old('confirmation_status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="Extended" {{ old('confirmation_status') == 'Extended' ? 'selected' : '' }}>Extended</option>
                                    <option value="Recommended" {{ old('confirmation_status') == 'Recommended' ? 'selected' : '' }}>Recommended</option>
                                    <option value="Not_Confirmed" {{ old('confirmation_status') == 'Not_Confirmed' ? 'selected' : '' }}>Not Confirmed</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-6 flex justify-end">
                            <button type="submit" class="px-8 py-3 bg-[#004499] text-white rounded font-bold text-[12px] uppercase tracking-widest hover:bg-blue-900 transition-all shadow-md">
                                Save Employee Enrollment
                            </button>
                        </div>
                    </div>

                    <!-- Bank Details Tab Content -->
                    <div x-show="activeTab === 'bank'" 
                        x-data="{ 
                            sameBank: false,
                            salaryBankName: '',
                            salaryIfsc: '',
                            reimbursementBankName: '',
                            reimbursementIfsc: '',
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
                                <input type="text" name="bank_name_as_per_bank" placeholder="Name As Per Bank"
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
                                <input type="text" name="salary_bank_ifsc" x-model="salaryIfsc" @input="syncBanks()" placeholder="IFSC CODE"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all uppercase">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {{-- Salary Account No --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Salary Account No <span class="text-rose-500">*</span></label>
                                <input type="text" name="salary_account_number" placeholder="Numeric Only"
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
                                <input type="text" name="reimbursement_bank_ifsc" x-model="reimbursementIfsc" :disabled="sameBank" placeholder="IFSC CODE"
                                    class="w-full px-3 py-2.5 bg-[#F6F8FA] border border-gray-200 rounded text-[12px] font-bold outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all uppercase disabled:opacity-60">
                            </div>

                            {{-- Reimbursement Account No --}}
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-tight">Reimbursement Account No.</label>
                                <input type="text" name="reimbursement_account_number" placeholder="Numeric Only"
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
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-10 flex justify-end gap-3">
                            <button type="button" @click="activeTab = 'official'" 
                                class="px-8 py-3 bg-gray-100 text-gray-500 rounded font-bold text-[12px] uppercase tracking-widest hover:bg-gray-200 transition-all">
                                Previous
                            </button>
                            <button type="submit" class="px-8 py-3 bg-[#004499] text-white rounded font-bold text-[12px] uppercase tracking-widest hover:bg-blue-900 transition-all shadow-md">
                                Save Employee Enrollment
                            </button>
                        </div>
                    </div>

                    <!-- Other Tabs... -->
                    <div x-show="!['official', 'bank'].includes(activeTab)" class="p-8 text-center text-gray-400 font-bold uppercase tracking-widest animate-fadeIn">
                        Work in Progress for <span x-text="activeTab"></span>
                    </div>

                    <!-- Actions Footer -->
                    <div class="px-10 py-6 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between">
                        <a href="{{ route('employees.index') }}" class="text-sm font-bold text-gray-400 hover:text-rose-500 transition-colors uppercase tracking-widest flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Cancel Enrollment
                        </a>
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
        /* Custom highlight for dropdown items */
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
