<x-app-layout>
    <x-slot name="header">
        Add Designation
    </x-slot>

    <div class="px-6 pb-12 max-w-4xl mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-10 border-b border-gray-100">
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Designation Registration</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Define a new job role or title within the organizational structure.</p>
            </div>

            <form action="{{ route('designations.store') }}" method="POST" class="p-10 space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <!-- Designation Code -->
                    <div class="space-y-1">
                        <label for="designation_code" class="block text-sm font-bold text-gray-700 ml-1">Designation Code</label>
                        <input type="text" name="designation_code" id="designation_code"
                            value="{{ old('designation_code') }}"
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all"
                            placeholder="e.g. SEN-ENG">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Internal reference code for this role.</p>
                        @error('designation_code')
                            <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Designation Name -->
                    <div class="space-y-1">
                        <label for="designation_name" class="block text-sm font-bold text-gray-700 ml-1">Designation Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="designation_name" id="designation_name" required
                            value="{{ old('designation_name') }}"
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all"
                            placeholder="e.g. Senior Software Engineer">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">The official title of the position.</p>
                        @error('designation_name')
                            <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- About Designation -->
                <div class="space-y-1">
                    <label for="about_designation" class="block text-sm font-bold text-gray-700 ml-1">About Designation</label>
                    <textarea name="about_designation" id="about_designation" rows="4"
                        class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all"
                        placeholder="Briefly describe the responsibilities and requirements of this role...">{{ old('about_designation') }}</textarea>
                    @error('about_designation')
                        <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-10 border-t border-gray-100 flex justify-center">
                    <button type="submit"
                        class="btn-primary flex items-center gap-2">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
