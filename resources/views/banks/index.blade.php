<x-app-layout> <x-slot name="header"> Bank Masters </x-slot>
    <div class="space-y-8 pb-10 px-6 max-w-[1600px] mx-auto"> <!-- Animated Toast Notification (Simplified for now) -->
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                class="fixed top-6 right-6 z-[200] w-full max-w-[320px] bg-white/80 backdrop-blur-xl rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-white/40 p-4 transform transition-all duration-500">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg> </div>
                    <div class="flex-1 pt-0.5">
                        <p class="text-xs font-black text-gray-900 mb-0.5 tracking-tight uppercase">Success</p>
                        <p class="text-[10px] text-gray-500 font-bold leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif <div class="glass-card overflow-hidden"> <!-- Header & Actions -->
                <div
                    class="px-8 py-6 border-b border-white/30 flex flex-col md:flex-row justify-between items-center gap-4 bg-white/40">
                    <h2 class="text-xl font-black text-gray-800 tracking-tighter">Bank Directory</h2>
                    <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto" x-data="{ showImportModal: false }">
                        <!-- Import Bank Button --> <button @click="showImportModal = true"
                            class="w-full md:w-auto px-6 py-2.5 rounded-xl bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 text-gray-700 font-black tracking-widest transition-all flex items-center justify-center space-x-2 uppercase transform hover:bg-gray-50 hover:scale-105 active:scale-95 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg> <span class="text-[10px] uppercase tracking-widest">Import</span> </button>
                        <!-- Add Bank Button --> <a href="{{ route('banks.create') }}"
                            class="w-full md:w-auto px-6 py-2.5 rounded-xl bg-[#004499] text-white font-black tracking-widest transition-all flex items-center justify-center space-x-2 uppercase transform hover:scale-105 active:scale-95 shadow-lg shadow-blue-900/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg> <span class="text-[10px] uppercase tracking-widest">Connect Bank</span> </a>
                        <!-- Import Modal -->
                        <div x-show="showImportModal" style="display: none;"
                            class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm"
                            x-transition.opacity>
                            <div @click.away="showImportModal = false"
                                class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 w-full max-w-md transform transition-all"
                                x-transition.scale>
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-black text-gray-800 tracking-tight">Import Banks</h3>
                                    <button @click="showImportModal = false"
                                        class="text-gray-400 hover:text-gray-600 transition-colors"> <svg
                                            class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg> </button>
                                </div>
                                <form action="{{ route('banks.import') }}" method="POST" enctype="multipart/form-data"
                                    class="space-y-6"> @csrf <div> <label
                                            class="block text-xs font-black text-gray-700 tracking-widest uppercase mb-2">Upload
                                            CSV File</label>
                                        <div
                                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-xl hover:border-blue-400 transition-colors group">
                                            <div class="space-y-1 text-center"> <svg
                                                    class="mx-auto h-12 w-12 text-gray-300 group-hover:text-blue-400 transition-colors"
                                                    stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600 justify-center"> <label
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                        <span>Select a file</span> <input type="file" name="file"
                                                            class="sr-only" accept=".csv,.txt" required> </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">CSV
                                                    files only</p>
                                            </div>
                                        </div>
                                        <div
                                            class="mt-3 bg-blue-50 border border-blue-100 p-3 rounded-xl text-[10px] text-blue-800 font-medium">
                                            <p class="font-bold mb-1">CSV Format required (exactly matches layout
                                                headers):</p>
                                            <p>Bank Code, Bank Name, Branch, IFSC Code, MICR Code, Bank Type, Company
                                                IFSC, Company MICR, Company Acc</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100"> <button
                                            type="button" @click="showImportModal = false"
                                            class="px-5 py-2 text-xs font-bold text-gray-600 hover:text-gray-800 transition-colors uppercase tracking-widest">Cancel</button>
                                        <button type="submit"
                                            class="px-6 py-2 bg-[#004499] text-white text-xs font-black tracking-widest uppercase rounded-xl shadow-md hover:bg-blue-800 hover:scale-105 active:scale-95 transition-all">Import
                                            Now</button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-black/5">
                            <tr>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                    #</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                    Bank Code</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                    Institution Name</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                    Branch</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                    IFSC Code</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                    Type</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                    Status</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right border-b border-white/10">
                                    Operations</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @if (count($banks) > 0)
                                @foreach ($banks as $bank)
                                    <tr class="hover:bg-white/40 transition-all group">
                                        <td class="px-8 py-4 text-[11px] font-black text-gray-500 tracking-tighter">
                                            {{ $loop->iteration }} </td>
                                        <td
                                            class="px-8 py-4 text-[11px] font-black text-gray-700 tracking-tighter uppercase">
                                            {{ $bank->bank_code }} </td>
                                        <td class="px-8 py-4"> <span
                                                class="text-sm font-black text-gray-800 tracking-tight">{{ $bank->bank_name }}</span>
                                        </td>
                                        <td
                                            class="px-8 py-4 text-[11px] text-gray-500 font-bold uppercase tracking-widest">
                                            {{ $bank->branch ?? '---' }} </td>
                                        <td class="px-8 py-4 text-[11px] font-bold text-gray-400 font-mono">
                                            {{ $bank->ifsc_code }} </td>
                                        <td class="px-8 py-4"> <span
                                                class="px-3 py-1 bg-white/60 text-gray-500 border border-white/50 rounded-pill text-[9px] font-black uppercase tracking-widest">
                                                {{ $bank->bank_type }} </span> </td>
                                        <td class="px-8 py-4"> <span
                                                class="px-3 py-1 rounded-pill text-[8px] font-black uppercase tracking-widest border {{ $bank->status ? 'bg-emerald-500/10 text-emerald-600 border-emerald-500/20' : 'bg-rose-500/10 text-rose-600 border-rose-500/20' }}">
                                                {{ $bank->status ? 'Active' : 'Archived' }} </span> </td>
                                        <td class="px-8 py-4 text-right text-[11px]">
                                            <div class="flex justify-end items-center space-x-3"> <a
                                                    href="{{ route('banks.edit', $bank) }}"
                                                    class="text-[#004499] hover:scale-110 transition-transform font-bold uppercase tracking-widest text-[9px]">Modify</a>
                                                <form action="{{ route('banks.destroy', $bank) }}" method="POST"
                                                    onsubmit="return confirm('Disconnect this financial institution?');"
                                                    class="inline"> @csrf @method('DELETE') <button type="submit"
                                                        class="text-rose-400 hover:text-rose-600 font-bold uppercase tracking-widest text-[9px] transition-colors">Archive</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="px-8 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-gray-200" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                    </path>
                                                </svg> </div>
                                            <p class="text-xs font-black text-gray-300 uppercase tracking-widest">Vault
                                                is empty. No banks found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div> <!-- Pagination -->
            <div class="mt-4"> {{ $banks->links() }} </div>
    </div>
</x-app-layout>
