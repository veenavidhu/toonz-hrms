<x-app-layout>
    <x-slot name="header">Employee Types</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="glass-card overflow-hidden">

            {{-- Header --}}
            <div class="px-8 py-6 border-b border-gray-100 bg-white/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#004499]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-gray-800">Edit Employee Type</h2>
                        <p class="text-sm text-gray-500">Update details for <strong>{{ $employeeType->type_name }}</strong>.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('employee-types.update', $employeeType) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Type Code --}}
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Type Code</label>
                        <input type="text" name="type_code" value="{{ old('type_code', $employeeType->type_code) }}"
                            placeholder="e.g. PERM, CONT, TRAIN"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all">
                        @error('type_code')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Type Name --}}
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Type Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="type_name" value="{{ old('type_name', $employeeType->type_name) }}"
                            placeholder="e.g. Permanent, Contract, Trainee"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                        @error('type_name')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Description</label>
                    <textarea name="description" rows="3"
                        placeholder="Brief description of this employee type..."
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all resize-none">{{ old('description', $employeeType->description) }}</textarea>
                </div>

                {{-- Status --}}
                <div class="flex items-center gap-4">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Status</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $employeeType->status ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer
                            peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                            peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                            after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                            after:h-5 after:w-5 after:transition-all peer-checked:bg-[#004499]"></div>
                        <span class="ml-2 text-sm font-bold text-gray-600">Active</span>
                    </label>
                </div>

                {{-- Actions --}}
                <div class="pt-6 border-t border-gray-100 flex items-center justify-between gap-4">
                    <a href="{{ route('employee-types.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold text-sm hover:bg-gray-200 transition-all">
                        ← Back to List
                    </a>
                    <button type="submit" class="btn-primary flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Employee Type
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
