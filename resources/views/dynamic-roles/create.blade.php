<x-app-layout>
    <x-slot name="header">Add Dynamic Role</x-slot>

    <div class="max-w-[1000px] mx-auto px-6 pb-12 mt-8">
        <a href="{{ route('dynamic-roles.index') }}" 
           class="inline-flex items-center gap-2 mb-8 text-[11px] font-black tracking-[0.2em] text-[#004499] hover:translate-x-[-10px] duration-300 transition-transform uppercase group">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.8" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Dynamic Role List
        </a>

        <div class="glass-card overflow-hidden">
            <div class="px-10 py-8 border-b border-gray-100 bg-white/50 backdrop-blur-md">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-2xl bg-[#004499]/10 flex items-center justify-center text-[#004499] shadow-inner">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-gray-800 tracking-tight uppercase">ADD NEW DYNAMIC ROLE</h2>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 ml-0.5">Define core dynamic role information</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('dynamic-roles.store') }}" method="POST" class="p-10 space-y-10 bg-white/30 backdrop-blur-xl">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                    {{-- Role Name --}}
                    <div class="space-y-2">
                        <label class="block text-[11px] font-black text-[#004499] uppercase tracking-widest pl-1">Dynamic Role Name <span class="text-rose-500">*</span></label>
                        <div class="relative group">
                            <input type="text" name="name" required value="{{ old('name') }}" placeholder="Enter Role Name"
                                class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-100/50 rounded-2xl text-[13px] font-bold text-gray-800 placeholder:text-gray-300 outline-none focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 shadow-sm border-shadow group-hover:bg-white group-hover:border-gray-200">
                            <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-gray-200 group-focus-within:text-black transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        @error('role_name') <p class="text-[11px] text-rose-500 font-bold mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Effective Date --}}
                    <div class="space-y-2">
                        <label class="block text-[11px] font-black text-[#004499] uppercase tracking-widest pl-1">Effective Date <span class="text-rose-500">*</span></label>
                        <div class="relative group">
                            <input type="date" name="effective_date" required value="{{ old('effective_date') }}"
                                class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-100/50 rounded-2xl text-[13px] font-bold text-gray-800 outline-none focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 shadow-sm border-shadow group-hover:bg-white group-hover:border-gray-200 uppercase">
                        </div>
                        @error('effective_date') <p class="text-[11px] text-rose-500 font-bold mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Status --}}
                    <div class="space-y-2">
                        <label class="block text-[11px] font-black text-[#004499] uppercase tracking-widest pl-1">Status</label>
                        <select name="status" class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-100/50 rounded-2xl text-[13px] font-bold text-gray-800 outline-none focus:bg-white focus:border-black focus:ring-4 focus:ring-black/5 transition-all duration-300 shadow-sm border-shadow group-hover:bg-white group-hover:border-gray-200 appearance-none cursor-pointer">
                            <option value="1">ACTIVE</option>
                            <option value="0">INACTIVE</option>
                        </select>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-start gap-4">
                    <button type="submit" 
                        class="px-10 py-4 bg-[#004499] text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-[#003377] transition-all shadow-xl shadow-blue-900/10 active:scale-95 group flex items-center gap-3">
                        Save Dynamic Role
                        <svg class="w-4 h-4 translate-x-0 group-hover:translate-x-1 duration-300 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.8" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                    <a href="{{ route('dynamic-roles.index') }}" 
                        class="px-10 py-4 bg-white text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:text-black hover:bg-gray-50 transition-all border-2 border-transparent hover:border-gray-100 duration-300">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
