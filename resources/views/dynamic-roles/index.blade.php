<x-app-layout>
    <x-slot name="header">Dynamic Role Master</x-slot>

    <div class="max-w-[1600px] mx-auto px-6 pb-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight uppercase">DYNAMIC ROLE MASTER</h1>
                <p class="text-sm text-gray-400 font-bold mt-1 tracking-widest">MANAGE SYSTEM DYNAMIC ROLES</p>
            </div>
            <div class="flex items-center gap-3" x-data="{ showImportModal: false }">
                <!-- Import Button -->
                <button @click="showImportModal = true"
                    class="px-5 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 text-gray-700 rounded-xl font-bold text-sm hover:bg-gray-50 hover:border-gray-300 transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg> IMPORT ROLES </button>

                <a href="{{ route('dynamic-roles.create') }}" 
                   class="flex items-center gap-2 px-6 py-3 bg-[#004499] text-white rounded-xl font-bold text-sm hover:bg-[#003377] transition-all shadow-lg shadow-blue-900/10 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    ADD NEW DYNAMIC ROLE
                </a>

                <!-- Import Modal -->
                <div x-show="showImportModal" style="display: none;"
                    class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 transition-all"
                    x-transition.opacity>
                    <div @click.away="showImportModal = false" x-data="{ loading: false, fileName: '' }"
                        class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all animate-grow"
                        x-transition.scale>
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Import Dynamic Roles</h3>
                            <button @click="showImportModal = false"
                                class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <form action="{{ route('dynamic-roles.import') }}" method="POST" enctype="multipart/form-data"
                            class="p-6" @submit="loading = true">
                            @csrf
                            <div class="space-y-4">
                                <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-blue-400 hover:bg-blue-50/50 transition-colors cursor-pointer relative"
                                    :class="fileName ? 'border-blue-400 bg-blue-50/50' : ''">
                                    <input type="file" name="file" accept=".csv" required
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                        @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                                    
                                    <div class="flex flex-col items-center" x-show="!fileName">
                                        <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-bold text-gray-600">Click to upload CSV</p>
                                        <p class="text-xs text-gray-400 mt-1">or drag and drop</p>
                                    </div>

                                    <div class="flex flex-col items-center" x-show="fileName" x-cloak>
                                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-black text-gray-800" x-text="fileName"></p>
                                        <p class="text-[10px] text-blue-600 font-bold uppercase tracking-widest mt-1">File selected & ready</p>
                                    </div>
                                </div>

                                <div class="mt-4 p-4 bg-blue-50/50 border border-blue-100 rounded-xl space-y-3">
                                    <div class="flex items-start gap-2 text-[10px] text-blue-800 font-bold uppercase tracking-widest leading-relaxed">
                                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>CSV Format: name, effective_date, status</span>
                                    </div>
                                    <a href="{{ asset('samples/dynamic_roles_sample.csv') }}" download 
                                       class="w-full flex items-center justify-center gap-2 py-2.5 bg-white border-2 border-blue-200 text-blue-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all group">
                                        <svg class="w-4 h-4 transform group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Download Sample CSV
                                    </a>
                                </div>
                            </div>
                            <div class="mt-6 flex gap-3">
                                <button type="button" @click="showImportModal = false"
                                    class="flex-1 px-4 py-2 bg-gray-100 text-gray-600 font-bold text-sm rounded-xl hover:bg-gray-200 transition-colors uppercase tracking-widest">Cancel</button>
                                <button type="submit" :disabled="loading"
                                    class="flex-1 px-4 py-2 bg-[#004499] text-white font-black text-sm rounded-xl hover:bg-blue-800 transition-all flex items-center justify-center gap-2 shadow-md hover:shadow-lg active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-widest">
                                    <template x-if="!loading">
                                        <span>Import Data</span>
                                    </template>
                                    <template x-if="loading">
                                        <div class="flex items-center gap-2">
                                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span>Importing...</span>
                                        </div>
                                    </template>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/50">
                <form action="{{ route('dynamic-roles.index') }}" method="GET" class="relative group max-w-md w-full">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search Dynamic Roles..."
                           class="w-full pl-12 pr-4 py-3 bg-gray-50 border-2 border-gray-100 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>
            </div>

            <div class="overflow-x-auto overflow-y-visible">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">Name</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">Effective Date</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">Status</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">Created By</th>
                            <th class="px-8 py-5 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white/30 backdrop-blur-md">
                        @forelse ($dynamicRoles as $role)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-[#004499]/5 flex items-center justify-center text-[#004499] font-black text-sm group-hover:bg-[#004499] group-hover:text-white transition-all duration-300">
                                            {{ substr($role->name, 0, 2) }}
                                        </div>
                                        <span class="text-sm font-bold text-gray-800 tracking-tight">{{ $role->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm font-bold text-gray-600">{{ \Carbon\Carbon::parse($role->effective_date)->format('d M, Y') }}</td>
                                <td class="px-8 py-5">
                                    @if($role->status)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-600 uppercase tracking-widest border border-emerald-200">ACTIVE</span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-rose-100 text-rose-600 uppercase tracking-widest border border-rose-200">INACTIVE</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-bold text-gray-800">{{ $role->creator->name }}</div>
                                    <div class="text-[10px] font-bold text-gray-400 tracking-tighter">{{ $role->created_at->format('d M, g:i A') }}</div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('dynamic-roles.edit', $role) }}" 
                                           class="p-2.5 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition-all duration-300 shadow-sm border border-blue-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('dynamic-roles.destroy', $role) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this Role?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2.5 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition-all duration-300 shadow-sm border border-rose-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-400 font-bold tracking-widest text-xs uppercase">No Dynamic Roles found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($dynamicRoles->hasPages())
                <div class="p-8 border-t border-gray-100 bg-white/50 backdrop-blur-sm">
                    {{ $dynamicRoles->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
