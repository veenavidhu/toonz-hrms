<x-app-layout>
    <x-slot name="header">Recruitment Stages</x-slot>

    <div class="px-6 pb-12 max-w-[1600px] mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-6 md:p-8 border-b border-gray-100/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-tight">Recruitment Stages List</h2>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('recruitment-stages.create') }}"
                        class="px-5 py-2.5 bg-[#004499] text-white rounded-xl font-bold text-sm hover:bg-[#003377] transition-all flex items-center gap-2 shadow-md uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New
                    </a>
                </div>
            </div>

            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/30">
                <form method="GET" action="{{ route('recruitment-stages.index') }}" class="flex items-center gap-3">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by stage name..."
                        class="max-w-sm w-full px-4 py-2 text-sm border border-gray-200 rounded-xl">
                    <button type="submit" class="px-4 py-2 bg-[#004499] text-white text-sm font-bold rounded-xl">Search</button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 w-16 text-center">#</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">Stage Name</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">Created By</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 text-center w-32 font-black uppercase text-gray-500">Status</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/50 text-sm">
                        @foreach ($stages as $stage)
                        <tr class="hover:bg-blue-50/40 group">
                            <td class="px-6 py-4 text-center font-bold text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-bold text-[#004499]">{{ $stage->stage_name }}</td>
                            <td class="px-6 py-4 text-xs font-semibold text-gray-500">{{ $stage->creator->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($stage->status)
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase">Active</span>
                                @else
                                    <span class="px-3 py-1 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('recruitment-stages.edit', $stage) }}" class="text-[#004499] mx-2">Edit</a>
                                <form action="{{ route('recruitment-stages.destroy', $stage) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="text-rose-600" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">{{ $stages->links() }}</div>
        </div>
    </div>
</x-app-layout>
