<x-app-layout>
    <x-slot name="header">Cities</x-slot>

    <div class="px-6 pb-12 max-w-[1600px] mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-6 md:p-8 border-b border-gray-100/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-tight">Cities List</h2>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <button onclick="document.getElementById('importModal').classList.remove('hidden')"
                        class="px-5 py-2.5 bg-gray-50 border-2 border-gray-200 hover:border-gray-400 text-gray-700 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-sm uppercase tracking-wider">
                        Import
                    </button>
                    <a href="{{ route('cities.create') }}"
                        class="px-5 py-2.5 bg-[#004499] text-white rounded-xl font-bold text-sm hover:bg-[#003377] transition-all flex items-center gap-2 shadow-md hover:shadow-lg active:scale-95 uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New
                    </a>
                </div>
            </div>

            {{-- Search --}}
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/30">
                <form method="GET" action="{{ route('cities.index') }}" class="flex items-center gap-3">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by city name..."
                        class="max-w-sm w-full px-4 py-2 text-sm border border-gray-200 rounded-xl bg-white focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] outline-none transition-all">
                    <button type="submit" class="px-4 py-2 bg-[#004499] text-white text-sm font-bold rounded-xl hover:bg-[#003377] transition-all">Search</button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 w-16 text-center">#</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">Country</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">State</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">City Name</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 w-32 text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/50 text-sm">
                        @foreach ($cities as $city)
                        <tr class="hover:bg-blue-50/40 transition-colors group">
                            <td class="px-6 py-4 font-bold text-gray-400 text-center">{{ $loop->iteration + ($cities->currentPage() - 1) * $cities->perPage() }}</td>
                            <td class="px-6 py-4 font-bold text-gray-600 truncate max-w-[150px]">{{ $city->state->country->name }}</td>
                            <td class="px-6 py-4 font-bold text-gray-600">{{ $city->state->name }}</td>
                            <td class="px-6 py-4 font-bold text-[#004499]">{{ $city->name }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($city->status)
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase">Active</span>
                                @else
                                    <span class="px-3 py-1 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('cities.edit', $city) }}" class="text-gray-400 hover:text-[#004499] mx-2">Edit</a>
                                <form action="{{ route('cities.destroy', $city) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-rose-600" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">{{ $cities->links() }}</div>
        </div>
    </div>

    {{-- Import Modal --}}
    <div id="importModal" class="fixed inset-0 z-50 hidden bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-4">Import Cities</h3>
            <form action="{{ route('cities.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".csv" required class="w-full mb-4">
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="flex-1 py-2 bg-gray-100 text-gray-600 font-bold text-sm rounded-xl">Cancel</button>
                    <button type="submit" class="flex-1 py-2 bg-[#004499] text-white font-bold text-sm rounded-xl">Import</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
