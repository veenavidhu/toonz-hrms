<x-app-layout>
    <x-slot name="header">
        Employee Types
    </x-slot>

    <div class="space-y-8 pb-10 px-6 max-w-[1600px] mx-auto">
        <!-- Animated Toast Notification -->
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                class="fixed top-6 right-6 z-[200] w-full max-w-[320px] bg-white/80 backdrop-blur-xl rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-white/40 p-4 transform transition-all duration-500">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1 pt-0.5">
                        <p class="text-xs font-black text-gray-900 mb-0.5 tracking-tight uppercase">Success</p>
                        <p class="text-[10px] text-gray-500 font-bold leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="glass-card overflow-hidden">
            <!-- Header & Actions -->
            <div
                class="px-8 py-6 border-b border-white/30 flex flex-col md:flex-row justify-between items-center gap-4 bg-white/40">
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-tighter">Employee Types</h2>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto" x-data="{ showImportModal: false }">
                    <a href="{{ route('employee-types.download-template') }}"
                        class="w-full md:w-auto px-6 py-2.5 rounded-xl bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 text-gray-700 font-black tracking-widest transition-all flex items-center justify-center space-x-2 uppercase transform hover:bg-gray-50 hover:scale-105 active:scale-95 shadow-sm">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span class="text-[10px] uppercase tracking-widest">Template</span>
                    </a>

                    <!-- Import Button -->
                    <button @click="showImportModal = true"
                        class="w-full md:w-auto px-6 py-2.5 rounded-xl bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 text-gray-700 font-black tracking-widest transition-all flex items-center justify-center space-x-2 uppercase transform hover:bg-gray-50 hover:scale-105 active:scale-95 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        <span class="text-[10px] uppercase tracking-widest">Import</span>
                    </button>

                    <!-- Add Button -->
                    <a href="{{ route('employee-types.create') }}"
                        class="w-full md:w-auto px-6 py-2.5 rounded-xl bg-[#004499] text-white font-black tracking-widest transition-all flex items-center justify-center space-x-2 uppercase transform hover:scale-105 active:scale-95 shadow-lg shadow-blue-900/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-[10px] uppercase tracking-widest">Add New</span>
                    </a>

                    <!-- Import Modal -->
                    <div x-show="showImportModal" style="display: none;"
                        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm"
                        x-transition.opacity>
                        <div @click.away="showImportModal = false"
                            class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 w-full max-w-md transform transition-all"
                            x-transition.scale>
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-black text-gray-800 tracking-tight">Import Employee Types</h3>
                                <button @click="showImportModal = false"
                                    class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('employee-types.import') }}" method="POST"
                                enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-xs font-black text-gray-700 tracking-widest uppercase mb-2">Upload CSV File</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-xl hover:border-blue-400 transition-colors group">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300 group-hover:text-blue-400 transition-colors"
                                                stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Select a file</span>
                                                    <input type="file" name="file" class="sr-only" accept=".csv,.txt" required>
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">CSV files only</p>
                                        </div>
                                    </div>
                                    <div class="mt-3 bg-blue-50 border border-blue-100 p-3 rounded-xl text-[10px] text-blue-800 font-medium">
                                        <p class="font-bold mb-1">CSV Format required (exactly matches layout headers):</p>
                                        <p>Type Name, Type Code, Description</p>
                                    </div>
                                </div>
                                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                                    <button type="button" @click="showImportModal = false"
                                        class="px-5 py-2 text-xs font-bold text-gray-600 hover:text-gray-800 transition-colors uppercase tracking-widest">Cancel</button>
                                    <button type="submit"
                                        class="px-6 py-2 bg-[#004499] text-white text-xs font-black tracking-widest uppercase rounded-xl shadow-md hover:bg-blue-800 hover:scale-105 active:scale-95 transition-all">Import Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-8 py-4 border-b border-white/30 bg-white/20">
                <form method="GET" action="{{ route('employee-types.index') }}" class="flex items-center gap-3">
                    <div class="relative flex-1 max-w-sm">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"></path>
                        </svg>
                        <input type="text" name="search" value="{{ $search ?? '' }}"
                            placeholder="Search by name or code..."
                            class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl bg-white focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] outline-none transition-all">
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-[#004499] text-white text-sm font-bold rounded-xl hover:bg-[#003377] transition-all active:scale-95">
                        Search
                    </button>
                    @if(isset($search) && $search !== '')
                        <a href="{{ route('employee-types.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-bold rounded-xl hover:bg-gray-200 transition-all">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-black/5">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">#</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">Type Code</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">Type Name</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">Description</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @if (count($employeeTypes) > 0)
                            @foreach ($employeeTypes as $type)
                                <tr class="hover:bg-white/40 transition-all group">
                                    <td class="px-8 py-4 text-[11px] font-black text-gray-500 tracking-tighter">{{ $loop->iteration + ($employeeTypes->currentPage() - 1) * $employeeTypes->perPage() }}</td>
                                    <td class="px-8 py-4 text-[11px] font-black text-gray-700 tracking-tighter uppercase">{{ $type->type_code ?? '—' }}</td>
                                    <td class="px-8 py-4"><span class="text-sm font-black text-gray-800 tracking-tight">{{ $type->type_name }}</span></td>
                                    <td class="px-8 py-4 text-[11px] font-medium text-gray-500">{{ Str::limit($type->description, 50) ?? '—' }}</td>
                                    <td class="px-8 py-4">
                                        <span class="px-3 py-1 rounded-pill text-[8px] font-black uppercase tracking-widest border {{ $type->status ? 'bg-[#004499]/10 text-[#004499] border-[#004499]/20' : 'bg-rose-500/10 text-rose-600 border-rose-500/20' }}">
                                            {{ $type->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-4 text-[11px]">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('employee-types.edit', $type) }}"
                                                class="px-4 py-1.5 bg-[#004499] text-white rounded text-[10px] font-black tracking-widest uppercase hover:bg-blue-800 transition-colors shadow-sm">Edit</a>
                                            <form action="{{ route('employee-types.destroy', $type) }}" method="POST"
                                                onsubmit="return confirm('Delete this employee type?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-1.5 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded transition-colors"
                                                    title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-xs font-black text-gray-300 uppercase tracking-widest">No employee types found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $employeeTypes->links() }}
        </div>
    </div>
</x-app-layout>
