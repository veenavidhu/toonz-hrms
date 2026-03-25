<x-app-layout>
    <x-slot name="header">Functions Master</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="glass-card overflow-hidden">

            {{-- Header --}}
            <div class="px-8 py-6 border-b border-gray-100 bg-white/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#004499]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-gray-800 tracking-tight">New Function</h2>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Add Corporate Capability</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('job-functions.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Function Code --}}
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Function Code</label>
                        <input type="text" name="function_code" value="{{ old('function_code') }}"
                            placeholder="e.g. IT, ACC, OPS"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all">
                        @error('function_code')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Function Name --}}
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Function Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="function_name" value="{{ old('function_name') }}"
                            placeholder="e.g. Information Technology, Accounts"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                        @error('function_name')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Description</label>
                    <textarea name="description" rows="3"
                        placeholder="Brief description of this function..."
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all resize-none">{{ old('description') }}</textarea>
                </div>

                {{-- Status --}}
                <div class="flex items-center gap-4">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Status</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1" class="sr-only peer" checked>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer
                            peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                            peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                            after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                            after:h-5 after:w-5 after:transition-all peer-checked:bg-[#004499]"></div>
                        <span class="ml-2 text-sm font-bold text-gray-600 peer-checked:text-[#004499]">Active</span>
                    </label>
                </div>

                {{-- Actions --}}
                <div class="pt-6 border-t border-gray-100 flex items-center justify-between gap-4">
                    <a href="{{ route('job-functions.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold text-sm hover:bg-gray-200 transition-all uppercase tracking-widest">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Function
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
