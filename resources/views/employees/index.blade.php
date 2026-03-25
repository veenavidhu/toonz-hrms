<x-app-layout>
    <x-slot name="header">
        Team Directory
    </x-slot>

    <div class="space-y-8">
        <!-- Action Bar -->
        <!-- Action Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Search and Filters -->
            <form action="{{ route('employees.index') }}" method="GET" class="flex flex-wrap items-center gap-4 w-full md:w-auto">
                <div class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Search Members..." 
                        class="w-64 px-10 py-2.5 rounded-xl bg-white/20 border border-white/30 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#004499] focus:bg-white/40 transition-all text-sm">
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 group-focus-within:text-[#004499] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <select name="department" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl bg-white/20 border border-white/30 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#004499] transition-all text-sm min-w-[150px]">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>

                <select name="status" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl bg-white/20 border border-white/30 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#004499] transition-all text-sm">
                    <option value="">All Status</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="Terminated" {{ request('status') == 'Terminated' ? 'selected' : '' }}>Terminated</option>
                </select>

                <button type="submit" class="hidden">Search</button>
            </form>

            <div class="flex items-center space-x-3">
                <a href="{{ route('employees.index', array_merge(request()->all(), ['export' => 1])) }}" 
                    class="px-6 py-2.5 rounded-xl bg-emerald-600 text-white font-black tracking-widest transition-all flex items-center space-x-2 uppercase transform hover:scale-105 active:scale-95 shadow-lg shadow-emerald-900/10 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>Export</span>
                </a>

                <a href="{{ route('employees.create') }}"
                    class="px-6 py-2.5 rounded-xl bg-[#004499] text-white font-black tracking-widest transition-all flex items-center space-x-2 uppercase transform hover:scale-105 active:scale-95 shadow-lg shadow-blue-900/10 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    <span>Add Member</span>
                </a>
            </div>
        </div>

        <!-- Employee Table Glass Card -->
        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/20">
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Member
                            </th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                Identity</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                Division</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status
                            </th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach ($employees as $employee)
                            <tr class="hover:bg-white/30 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 mr-4">
                                            <img class="h-12 w-12 rounded-pill border-2 border-white shadow-sm group-hover:scale-110 transition-transform"
                                                src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=000&color=fff"
                                                alt="">
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-brand-accent">
                                                {{ $employee->name }}</div>
                                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                                                {{ $employee->designation->designation_name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-gray-600">{{ $employee->employee_id }}</div>
                                    <div class="text-[10px] font-black text-gray-300 uppercase">
                                        {{ $employee->email }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-4 py-1 bg-brand-muted text-gray-500 rounded-pill text-[10px] font-black uppercase tracking-widest">
                                        {{ optional($employee->department)->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-pill text-[10px] font-black uppercase tracking-widest">
                                        Active
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('employees.show', $employee) }}"
                                            class="w-10 h-10 flex items-center justify-center rounded-pill bg-white/50 text-gray-500 hover:active-bubble transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('employees.edit', $employee) }}"
                                            class="w-10 h-10 flex items-center justify-center rounded-pill bg-white/50 text-gray-500 hover:active-bubble transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-8 py-4 border-t border-white/20 bg-white/10">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
