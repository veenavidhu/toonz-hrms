<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-20 w-24 glass-sidebar transition-all duration-500 transform md:translate-x-0 -translate-x-full overflow-visible flex flex-col items-center py-4">
    <!-- Hamburger / Logo Area -->
    <div class="mb-4 w-full flex justify-center border-b border-white/20 pb-4"> <button id="closeSidebar"
            class="md:hidden p-2 text-white hover:bg-white/10 rounded-xl"> <svg class="w-6 h-6" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg> </button> <a href="{{ route('dashboard') }}"
            class="hidden md:flex items-center justify-center transition-all hover:scale-110 active:scale-95"> <img
                src="{{ asset('images/hrmgo-logo-Icon-white.png') }}" alt="HRM GO Logo"
                class="w-10 h-10 object-contain drop-shadow-2xl"> </a> </div> <!-- Navigation Icons -->
    <nav class="flex-1 w-full flex flex-col items-center"> <!-- Home --> <x-sidebar-item href="{{ route('dashboard') }}"
            :active="request()->routeIs('dashboard')"
            icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
            label="Home" /> <!-- Employee (with Flyout) --> <x-sidebar-item href="{{ route('employees.create') }}" :active="request()->routeIs('employees.*')"
            icon="M17 20h5V10h-5V7a5 5 0 00-10 0v3H2v10h5m10 0a3 3 0 01-3 3H7a3 3 0 01-3-3m10 0V10" label="Employee"
            :hasDropdown="true"> 
            <a href="{{ route('employees.create') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Add
                Employee</a> 
            <a href="{{ route('employees.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">View
                Employee</a> 
            <a href="#"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">My
                Profile</a> 
            <a href="#"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Manager
                Update</a> 
            <a href="#"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Company
                Directory</a> </x-sidebar-item> <!-- Attendance --> <x-sidebar-item
            href="{{ route('attendance.index') }}" :active="request()->routeIs('attendance.*')" icon="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
            label="Attendance" /> <!-- Leave --> <x-sidebar-item href="{{ route('leaves.index') }}" :active="request()->routeIs('leaves.*')"
            icon="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
            label="Leave" /> <!-- Reports --> <x-sidebar-item href="#" :active="false"
            icon="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
            label="Reports" /> <!-- Masters --> <x-sidebar-item href="#" :active="request()->routeIs('banks.*') ||
                request()->routeIs('business-units.*') ||
                request()->routeIs('sub-business-units.*') ||
                request()->routeIs('employee-types.*') ||
                request()->routeIs('companies.*') ||
                request()->routeIs('job-functions.*') ||
                request()->routeIs('sub-functions.*') ||
                request()->routeIs('holidays.*') ||
                request()->routeIs('qualifications.*') ||
                request()->routeIs('locations.*') ||
                request()->routeIs('states.*') ||
                request()->routeIs('cities.*') ||
                request()->routeIs('recruitment-stages.*') ||
                request()->routeIs('universities.*') ||
                request()->routeIs('years.*') ||
                request()->routeIs('dynamic-roles.*') ||
                request()->routeIs('designations.*')"
            icon="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 0 1 6 0z"
            label="Masters" :hasDropdown="true"> <a href="{{ route('banks.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Bank
                Master</a> <a href="{{ route('companies.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Company</a>
            <a href="{{ route('business-units.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Business
                Unit</a> <a href="{{ route('sub-business-units.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Sub
                Business Unit</a> 
            <a href="{{ route('employee-types.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Employee Type</a>
            <a href="{{ route('job-functions.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Function</a>
            <a href="{{ route('sub-functions.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Sub Function</a>
            <a href="{{ route('holidays.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Holiday</a>
            <a href="{{ route('qualifications.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Qualification</a>
            <a href="{{ route('locations.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Location</a>
            <a href="{{ route('states.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">State</a>
            <a href="{{ route('cities.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">City</a>
            <a href="{{ route('recruitment-stages.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Recruitment Stage</a>
            <a href="{{ route('universities.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">University</a>
            <a href="{{ route('years.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Year</a>
            <a href="{{ route('dynamic-roles.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Dynamic Role</a>
            <a href="{{ route('designations.index') }}"
                class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">Designation</a>
        </x-sidebar-item> <!-- User Management --> @hasanyrole('Super Admin|Admin')
            <x-sidebar-item href="{{ route('users.index') }}" :active="request()->routeIs('users.*') || request()->routeIs('roles.*')"
                icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                label="User Management" :hasDropdown="true"> 
                <a href="{{ route('users.index') ?? '#' }}"
                    class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">All Users</a> 
                <a href="{{ route('roles.index') }}"
                    class="block px-4 py-2 text-sm font-bold text-gray-600 hover:bg-blue-50 hover:text-[#004499] rounded-xl transition-all">User Roles</a> 
            </x-sidebar-item>
        @else
            <x-sidebar-item href="#" :active="false"
                icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                label="User Management" />
        @endhasanyrole
    </nav>
</aside>
