<x-app-layout>
    <x-slot name="header">Qualifications</x-slot>

    <div class="px-6 pb-12 max-w-[1600px] mx-auto">
        <div class="glass-card overflow-hidden bg-white">

            {{-- Card Header --}}
            <div class="p-6 md:p-8 border-b border-gray-100/50 bg-white/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-tight">Qualifications List</h2>
                    <p class="text-sm text-gray-500 font-medium mt-1">Manage employee educational qualifications.</p>
                </div>
                <div class="flex items-center gap-3 flex-wrap">

                    {{-- Download Template --}}
                    <a href="{{ route('qualifications.download-template') }}"
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

                    {{-- Add New --}}
                    <a href="{{ route('qualifications.create') }}"
                        class="px-5 py-2.5 bg-[#004499] text-white rounded-xl font-bold text-sm hover:bg-[#003377] transition-all flex items-center gap-2 shadow-md hover:shadow-lg active:scale-95 uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New
                    </a>
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/30">
                <form method="GET" action="{{ route('qualifications.index') }}" class="flex items-center gap-3">
                    <div class="relative flex-1 max-w-sm">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"></path>
                        </svg>
                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="Search by qualification name..."
                            class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl bg-white focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] outline-none transition-all">
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-[#004499] text-white text-sm font-bold rounded-xl hover:bg-[#003377] transition-all active:scale-95">
                        Search
                    </button>
                    @if($search)
                        <a href="{{ route('qualifications.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-bold rounded-xl hover:bg-gray-200 transition-all">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 w-16 text-center">#</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">Qualification Name</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 w-32">Status</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 text-right w-32">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/50 text-sm">
                        @if (count($qualifications) > 0)
                            @foreach ($qualifications as $qualification)
                            <tr class="hover:bg-blue-50/40 transition-colors group">
                                <td class="px-6 py-4 font-bold text-gray-400 text-center">{{ $loop->iteration + ($qualifications->currentPage() - 1) * $qualifications->perPage() }}</td>
                                <td class="px-6 py-4 font-bold text-[#004499] uppercase tracking-wide">
                                    {{ $qualification->qualification_name }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($qualification->status)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('qualifications.edit', $qualification) }}"
                                            class="p-2 text-gray-400 hover:text-[#004499] hover:bg-blue-50 rounded-xl transition-colors"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('qualifications.destroy', $qualification) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Delete this qualification?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors"
                                                title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
                                        <svg class="w-8 h-8 text-[#004499]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-500">No qualifications found</p>
                                    <p class="text-xs text-gray-400 mt-1">Get started by creating your first educational qualification.</p>
                                    <a href="{{ route('qualifications.create') }}"
                                        class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-[#004499] text-white text-sm font-bold rounded-xl hover:bg-[#003377] transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Add First Qualification
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($qualifications->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $qualifications->links() }}
                </div>
            @endif

        </div>
    </div>

    {{-- Import Modal --}}
    <div id="importModal" class="fixed inset-0 z-50 hidden bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Import Qualifications</h3>
                <button onclick="document.getElementById('importModal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('qualifications.import') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-[#004499] hover:bg-blue-50/30 transition-colors cursor-pointer relative">
                        <input type="file" name="file" accept=".csv" required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="flex flex-col items-center">
                            <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-sm font-bold text-gray-600">Click to upload CSV</p>
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
