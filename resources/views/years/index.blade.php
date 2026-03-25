<x-app-layout>
    <x-slot name="header">Year Master</x-slot>

    <div class="px-6 pb-12 max-w-[1600px] mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-6 md:p-8 border-b border-gray-100/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-tight">Years List</h2>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('years.create') }}"
                        class="px-5 py-2.5 bg-[#004499] text-white rounded-xl font-bold text-sm hover:bg-[#003377] transition-all flex items-center gap-2 shadow-md uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New
                    </a>
                </div>
            </div>

            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/30">
                <form method="GET" action="{{ route('years.index') }}" class="flex items-center gap-3">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by name or type..."
                        class="max-w-sm w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] outline-none transition-all">
                    <button type="submit" class="px-4 py-2 bg-[#004499] text-white text-sm font-bold rounded-xl active:scale-95 transition-all">Search</button>
                    @if($search)
                        <a href="{{ route('years.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-bold rounded-xl">Clear</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 text-[11px] font-black text-gray-400 uppercase tracking-widest">
                            <th class="px-6 py-4 border-b border-gray-100 w-16 text-center">#</th>
                            <th class="px-6 py-4 border-b border-gray-100">Year Type</th>
                            <th class="px-6 py-4 border-b border-gray-100">Start Date</th>
                            <th class="px-6 py-4 border-b border-gray-100">Year</th>
                            <th class="px-6 py-4 border-b border-gray-100">OU Selection</th>
                            <th class="px-6 py-4 border-b border-gray-100">Company</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-center">Pay Calc</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-center">Status</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/50 text-sm">
                        @foreach ($years as $year)
                        <tr class="hover:bg-blue-50/40 group transition-colors">
                            <td class="px-6 py-4 text-center font-bold text-gray-400">{{ $loop->iteration + ($years->currentPage() - 1) * $years->perPage() }}</td>
                            <td class="px-6 py-4 font-bold text-[#004499]">{{ $year->year_type }}</td>
                            <td class="px-6 py-4 text-gray-600 font-medium">{{ $year->start_date->format('d-M-Y') }}</td>
                            <td class="px-6 py-4 font-black text-gray-800 uppercase tracking-tighter">{{ $year->year_name }}</td>
                            <td class="px-6 py-4 text-gray-500 font-medium text-xs">{{ $year->ou_based_selection }}</td>
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $year->company->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($year->pay_calc_status)
                                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase tracking-wider border border-blue-100">Yes</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-50 text-gray-400 rounded-full text-[10px] font-black uppercase tracking-wider border border-gray-100">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($year->status)
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-wider border border-emerald-100">Active</span>
                                @else
                                    <span class="px-3 py-1 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase tracking-wider border border-rose-100">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right transform group-hover:scale-110 transition-transform">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('years.edit', $year) }}" class="text-[#004499] font-bold hover:underline">Edit</a>
                                    <form action="{{ route('years.destroy', $year) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-600 font-bold hover:underline" onclick="return confirm('Delete?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">{{ $years->links() }}</div>
        </div>
    </div>
</x-app-layout>
