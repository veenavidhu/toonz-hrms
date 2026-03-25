<x-app-layout>
    <x-slot name="header">
        Edit Sub Business Unit
    </x-slot>

    <div class="px-6 pb-12 max-w-4xl mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-10 border-b border-gray-100">
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Modify Sub Business Unit</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Update parameters for <strong>{{ $subBusinessUnit->sub_business_unit_name }}</strong>.</p>
            </div>

            <form action="{{ route('sub-business-units.update', $subBusinessUnit) }}" method="POST" class="p-10 space-y-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <!-- Sub Business Unit Name -->
                    <div class="space-y-1">
                        <label for="sub_business_unit_name" class="block text-sm font-bold text-gray-700 ml-1">Sub Business Unit Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="sub_business_unit_name" id="sub_business_unit_name" required
                            value="{{ old('sub_business_unit_name', $subBusinessUnit->sub_business_unit_name) }}"
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Update the division name.</p>
                        @error('sub_business_unit_name')
                            <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 ml-1 mb-2">Status</label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" class="sr-only peer" {{ old('status', $subBusinessUnit->status) ? 'checked' : '' }}>
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                            <span class="ms-3 text-sm font-bold text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="pt-10 border-t border-gray-100 flex justify-center">
                    <button type="submit" class="btn-primary flex items-center gap-2">
                        Update Sub Business Unit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
