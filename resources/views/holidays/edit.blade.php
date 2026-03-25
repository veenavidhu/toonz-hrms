<x-app-layout>
    <x-slot name="header">Holidays</x-slot>

    <div class="max-w-[1600px] mx-auto px-6 pb-12">
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
                        <h2 class="text-lg font-black text-gray-800 tracking-tight uppercase">UPDATE HOLIDAY</h2>
                    </div>
                </div>
            </div>

            <form action="{{ route('holidays.update', $holiday) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">

                    {{-- Holiday Date --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Holiday Date <span class="text-rose-500">*</span></label>
                        <input type="date" name="holiday_date" value="{{ old('holiday_date', $holiday->holiday_date->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                        @error('holiday_date')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Holiday Name --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Holiday Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="holiday_name" value="{{ old('holiday_name', $holiday->holiday_name) }}"
                            placeholder="Holiday Name"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                        @error('holiday_name')
                            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Is Holiday (Mandatory/Optional) --}}
                    <div class="flex items-center gap-8">
                        <span class="text-xs font-black text-[#004499] uppercase tracking-widest">Is Holiday</span>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="is_mandatory" value="1" class="w-4 h-4 text-[#004499] border-gray-300 focus:ring-[#004499]/20" {{ $holiday->is_mandatory ? 'checked' : '' }}>
                                <span class="text-sm font-bold text-gray-600 group-hover:text-[#004499] transition-colors">Mandatory</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="is_mandatory" value="0" class="w-4 h-4 text-[#004499] border-gray-300 focus:ring-[#004499]/20" {{ !$holiday->is_mandatory ? 'checked' : '' }}>
                                <span class="text-sm font-bold text-gray-600 group-hover:text-[#004499] transition-colors">Optional</span>
                            </label>
                        </div>
                    </div>

                </div>

                {{-- Status Toggle --}}
                <div class="flex items-center gap-4">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Status</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $holiday->status ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer
                            peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                            peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px]
                            after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full
                            after:h-5 after:w-5 after:transition-all peer-checked:bg-[#004499]"></div>
                        <span class="ml-2 text-sm font-bold text-gray-600 peer-checked:text-[#004499]">Active</span>
                    </label>
                </div>

                {{-- Actions --}}
                <div class="pt-6 border-t border-gray-100 flex items-center justify-start gap-4">
                    <button type="submit" class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">
                        Update
                    </button>
                    <a href="{{ route('holidays.index') }}"
                        class="px-8 py-2.5 bg-gray-100 text-gray-600 rounded-md font-bold text-sm hover:bg-gray-200 transition-all">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
