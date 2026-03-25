<x-app-layout> <x-slot name="header"> Designations </x-slot>
    <div class="px-6 pb-12 max-w-[1600px] mx-auto">
        @if (session('success'))
            <div
                class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center gap-3 text-emerald-800 animate-slide-in">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
            @endif <div class="glass-card overflow-hidden"> <!-- Header Section -->
                <div
                    class="p-6 md:p-8 border-b border-gray-100/50 bg-white/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-black text-gray-800 tracking-tight">Designation List</h2>
                        <p class="text-sm text-gray-500 font-medium mt-1">Manage designation codes and descriptions.</p>
                    </div>
                    <div class="flex items-center gap-3" x-data="{ showImportModal: false }">
                        <button @click="showImportModal = true"
                            class="px-5 py-2.5 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 text-gray-700 rounded-xl font-bold text-sm hover:bg-gray-50 hover:border-gray-300 transition-all flex items-center gap-2 shadow-sm">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg> Import CSV </button>
                        <a href="{{ route('designations.create') }}"
                            class="px-5 py-2.5 bg-[#004499] text-white rounded-xl font-bold text-sm hover:bg-blue-800 transition-all flex items-center gap-2 shadow-md hover:shadow-lg active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg> Add Designation </a>

                        <!-- Import Modal -->
                        <div x-show="showImportModal" style="display: none;"
                            class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 transition-all"
                            x-transition.opacity>
                            <div @click.away="showImportModal = false" x-data="{ loading: false, fileName: '' }"
                                class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all animate-grow"
                                x-transition.scale>
                                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Import Designations</h3>
                                    <button @click="showImportModal = false"
                                        class="text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <form action="{{ route('designations.import') }}" method="POST" enctype="multipart/form-data"
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
                                                <span>CSV Format: designation_name, designation_code, about_designation</span>
                                            </div>
                                            <a href="{{ asset('samples/designations_sample.csv') }}" download 
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
                </div> <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th
                                    class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 w-16">
                                    ID</th>
                                <th
                                    class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">
                                    Designation Name</th>
                                <th
                                    class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">
                                    Designation Code</th>
                                <th
                                    class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100">
                                    Status</th>
                                <th
                                    class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-widest border-b border-gray-100 text-right w-32">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100/50 text-sm">
                            @if (count($designations) > 0)
                                @foreach ($designations as $designation)
                                    <tr class="hover:bg-blue-50/50 transition-colors group">
                                        <td class="px-6 py-4 font-bold text-gray-400">#{{ $designation->id }}</td>
                                        <td class="px-6 py-4 font-bold text-[#004499]">
                                            {{ $designation->designation_name }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-600">
                                            {{ $designation->designation_code ?? '-' }}</td>
                                        <td class="px-6 py-4">
                                            @if ($designation->status)
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Inactive
                                                </span>
                                                @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div
                                                class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('designations.edit', $designation) }}"
                                                    class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors"
                                                    title="Edit"> <svg class="w-4 h-4" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg> </a>
                                                <form action="{{ route('designations.destroy', $designation) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this designation?');">
                                                    @csrf @method('DELETE') <button type="submit"
                                                        class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors"
                                                        title="Delete"> <svg class="w-4 h-4" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg> </button> </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div
                                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg> </div>
                                        <p class="text-sm font-bold text-gray-500">No designations found</p>
                                        <p class="text-xs text-gray-400 mt-1">Get started by creating a new designation.
                                        </p>
                                    </td>
                                </tr> @endif
                        </tbody>
                    </table>
                </div>
                @if ($designations->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50"> {{ $designations->links() }} </div>
                    @endif
            </div>
    </div>
</x-app-layout>
