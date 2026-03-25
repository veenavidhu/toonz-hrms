<x-app-layout> <x-slot name="header"> Employee Details </x-slot>
    <div class="max-w-5xl mx-auto space-y-6"> <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl overflow-hidden border border-gray-100 ">
            <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
            <div class="px-8 pb-8">
                <div class="relative flex justify-between items-end -mt-16">
                    <div class="flex items-end"> <img
                            class="w-32 h-32 rounded-2xl object-cover border-4 border-white dark:border-gray-800 shadow-lg bg-white"
                            src="{{ $employee->photo_path ? asset('storage/' . $employee->photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($employee->name) . '&background=6366f1&color=fff' }}"
                            alt="">
                        <div class="ml-6 mb-2">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $employee->name }}
                            </h2>
                            <p class="text-indigo-600 dark:text-indigo-400 font-medium">
                                {{ $employee->designation->designation_name ?? 'Designation Not Set' }}</p>
                        </div>
                    </div>
                    <div class="mb-2 flex gap-3"> <a href="{{ route('employees.edit', $employee) }}"
                            class="px-5 py-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-xl font-semibold hover:bg-gray-50 dark:hover:bg-gray-600 transition">Edit
                            Profile</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                            onsubmit="return confirm('Delete this employee permanentely?')"> @csrf @method('DELETE')
                            <button type="submit"
                                class="px-5 py-2 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition shadow-lg shadow-red-100 dark:shadow-none">Terminate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"> <!-- Left: Sidebar Info -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-6 border border-gray-100 ">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Contact Info</h3>
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-600 dark:text-gray-400"> <svg
                                class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg> <span class="text-sm">{{ $employee->email }}</span> </div>
                        <div class="flex items-center text-gray-600 dark:text-gray-400"> <svg
                                class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg> <span class="text-sm">{{ $employee->phone ?? 'No phone set' }}</span> </div>
                        <div class="flex items-start text-gray-600 dark:text-gray-400"> <svg
                                class="w-5 h-5 mr-3 mt-0.5 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg> <span class="text-sm">{{ $employee->address ?? 'No address set' }}</span> </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-6 border border-gray-100 ">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Onboarding Docs</h3>
                    @if ($employee->document_path)
                        <div class="flex items-center p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl"> <svg
                                class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-xs font-bold text-indigo-900 dark:text-indigo-200 uppercase">Documents
                                    Attached</p> <a href="{{ asset('storage/' . $employee->document_path) }}"
                                    target="_blank" class="text-sm text-indigo-600 hover:underline">Download / View</a>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 italic">No documents uploaded.</p>
                        @endif
                </div>
            </div> <!-- Right: Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-8 border border-gray-100 ">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Employment Information</h3> <span
                            class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400 rounded-full text-xs font-bold uppercase tracking-wider">{{ $employee->status }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-y-8 gap-x-12">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Employee ID</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $employee->employee_id }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Department</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $employee->department->name ?? 'Unassigned' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Joining Date</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $employee->date_of_joining ? \Carbon\Carbon::parse($employee->date_of_joining)->format('d M, Y') : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Base Salary</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                ${{ number_format($employee->salary ?? 0, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Date of Birth</p>
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $employee->dob ? \Carbon\Carbon::parse($employee->dob)->format('d M, Y') : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Access Role</p>
                            <div class="mt-1 flex flex-wrap gap-1">
                                @foreach ($employee->roles as $role)
                                    <span
                                        class="px-2 py-0.5 bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400 rounded text-xs font-medium">{{ $role->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 pt-8 border-t border-gray-100 ">
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4 uppercase tracking-wider">Bank &
                            Payments</h4>
                        <div
                            class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl text-sm text-gray-600 dark:text-gray-400 italic">
                            {{ $employee->bank_details ?? 'No bank details records provided.' }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
