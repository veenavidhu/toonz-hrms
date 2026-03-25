<x-app-layout>
    <x-slot name="header">Cities</x-slot>

    <div class="max-w-[1600px] mx-auto px-6 pb-12">
        <div class="glass-card overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-white/50">
                <h2 class="text-lg font-black text-gray-800 tracking-tight uppercase">UPDATE CITY</h2>
            </div>
            <form action="{{ route('cities.update', $city) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Country <span class="text-rose-500">*</span></label>
                        <select id="country_select" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ $city->state->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">State <span class="text-rose-500">*</span></label>
                        <select id="state_select" name="state_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ $city->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">City Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $city->name) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                    </div>
                </div>

                {{-- Status Toggle --}}
                <div class="flex items-center gap-4">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Status</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $city->status ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-[#004499] after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                    </label>
                </div>

                <div class="pt-6 border-t border-gray-100 flex gap-4">
                    <button type="submit" class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">Update</button>
                    <a href="{{ route('cities.index') }}" class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('country_select').addEventListener('change', function() {
            const countryId = this.value;
            const stateSelect = document.getElementById('state_select');
            stateSelect.innerHTML = '<option value="">Loading...</option>';
            
            if (countryId) {
                fetch(`/cities/get-states/${countryId}`)
                    .then(response => response.json())
                    .then(data => {
                        stateSelect.innerHTML = '<option value="">Select State</option>';
                        data.forEach(state => {
                            stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                        });
                    });
            } else {
                stateSelect.innerHTML = '<option value="">Select State</option>';
            }
        });
    </script>
</x-app-layout>
