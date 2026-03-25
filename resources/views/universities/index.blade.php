<x-app-layout>
    <x-slot name="header">Universities</x-slot>

    <div class="px-6 pb-12 max-w-[1600px] mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-6 md:p-8 border-b border-gray-100/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-tight">Universities List</h2>
                </div>
                <div class="flex items-center gap-3">
                    {{-- Download Template --}}
                    <a href="{{ route('universities.download-template') }}"
                        class="px-5 py-2.5 bg-gray-50 border-2 border-gray-200 hover:border-gray-400 text-gray-700 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-sm uppercase tracking-wider">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Template
                    </a>

                    {{-- Import CSV --}}
                    <button onclick="document.getElementById('importModal').classList.remove('hidden')"
                        class="px-5 py-2.5 bg-gray-50 border-2 border-gray-200 hover:border-gray-400 text-gray-700 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-sm uppercase tracking-wider">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Import
                    </button>

                    <a href="{{ route('universities.create') }}"
                        class="px-5 py-2.5 bg-[#004499] text-white rounded-xl font-bold text-sm hover:bg-[#003377] transition-all flex items-center gap-2 shadow-md uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New
                    </a>
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/30">
                <form method="GET" action="{{ route('universities.index') }}" class="flex items-center gap-3">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by name or location..."
                        class="max-w-sm w-full px-4 py-2 text-sm border border-gray-200 rounded-xl">
                    <button type="submit" class="px-4 py-2 bg-[#004499] text-white text-sm font-bold rounded-xl active:scale-95 transition-all">Search</button>
                    @if($search)
                        <a href="{{ route('universities.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-bold rounded-xl">Clear</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 text-[11px] font-black text-gray-400 uppercase tracking-widest">
                            <th class="px-6 py-4 border-b border-gray-100 w-16 text-center">#</th>
                            <th class="px-6 py-4 border-b border-gray-100">University Name</th>
                            <th class="px-6 py-4 border-b border-gray-100">Location</th>
                            <th class="px-6 py-4 border-b border-gray-100">Created By</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-center w-32">Status</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/50 text-sm">
                        @foreach ($universities as $university)
                        <tr class="hover:bg-blue-50/40 group transition-colors">
                            <td class="px-6 py-4 text-center font-bold text-gray-400">{{ $loop->iteration + ($universities->currentPage() - 1) * $universities->perPage() }}</td>
                            <td class="px-6 py-4 font-bold text-[#004499]">{{ $university->university_name }}</td>
                            <td class="px-6 py-4 text-gray-600 font-medium">{{ $university->location ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-gray-500 font-medium text-xs">{{ $university->creator->name ?? 'System' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($university->status)
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-wider border border-emerald-100">Active</span>
                                @else
                                    <span class="px-3 py-1 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase tracking-wider border border-rose-100">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right transform group-hover:scale-110 transition-transform">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('universities.edit', $university) }}" class="text-[#004499] font-bold hover:underline">Edit</a>
                                    <form action="{{ route('universities.destroy', $university) }}" method="POST" class="inline">
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
            <div class="px-6 py-4">{{ $universities->links() }}</div>
        </div>
    </div>

    {{-- Import Modal --}}
    <div id="importModal" class="fixed inset-0 z-50 hidden bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Import Universities</h3>
                <button onclick="document.getElementById('importModal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('universities.import') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-[#004499] hover:bg-blue-50/30 transition-colors cursor-pointer relative">
                        <input type="file" name="file" accept=".csv" required
                            onchange="this.nextElementSibling.querySelector('.file-label').textContent = this.files[0].name"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="flex flex-col items-center pointer-events-none">
                            <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-sm font-bold text-gray-600 file-label">Click to upload CSV</p>
                            <p class="text-xs text-gray-400 mt-1">or drag and drop</p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex gap-3">
                    <button type="button"
                        onclick="document.getElementById('importModal').classList.add('hidden')"
                        class="flex-1 px-4 py-2 bg-gray-100 text-gray-600 font-bold text-sm rounded-xl hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-[#004499] text-white font-bold text-sm rounded-xl hover:bg-[#003377] transition-colors">
                        Import Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
