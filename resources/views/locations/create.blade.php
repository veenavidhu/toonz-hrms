<x-app-layout>
    <x-slot name="header">Locations</x-slot>

    <div class="max-w-[1600px] mx-auto px-6 pb-12">
        <div class="glass-card overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-white/50">
                <h2 class="text-lg font-black text-gray-800 tracking-tight uppercase">ADD LOCATION</h2>
            </div>

            <form action="{{ route('locations.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-8">

                    {{-- Location Code --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Location Code</label>
                        <input type="text" name="location_code" value="{{ old('location_code') }}" placeholder="Location Code"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all">
                    </div>

                    {{-- Country --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Country</label>
                        <select id="country" name="country_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                            <option value="">select..</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- State --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Select State</label>
                        <select id="state" name="state_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required disabled>
                            <option value="">select..</option>
                        </select>
                    </div>

                    {{-- Location Name --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Location Name</label>
                        <input type="text" name="location_name" value="{{ old('location_name') }}" placeholder="Location Name"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                    </div>

                    {{-- Pin Code --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Pin Code</label>
                        <input type="text" name="pin_code" value="{{ old('pin_code') }}" placeholder="Pin Code"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    {{-- City --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Select City</label>
                        <select id="city" name="city_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required disabled>
                            <option value="">select..</option>
                        </select>
                    </div>

                    {{-- Time Zone --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Time Zone</label>
                        <select name="time_zone" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all">
                            <option value="">Select Time Zone</option>
                            @foreach($timezones as $tz)
                                <option value="{{ $tz }}">{{ $tz }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="pt-6 border-t border-gray-100 flex items-center justify-start gap-4">
                    <button type="submit" class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">
                        Save
                    </button>
                    <a href="{{ route('locations.index') }}"
                        class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('country').addEventListener('change', function() {
            const countryId = this.value;
            const stateField = document.getElementById('state');
            const cityField = document.getElementById('city');
            
            stateField.innerHTML = '<option value="">select..</option>';
            stateField.setAttribute('disabled', true);
            cityField.innerHTML = '<option value="">select..</option>';
            cityField.setAttribute('disabled', true);

            if (countryId) {
                fetch(`{{ route('locations.get-states') }}?country_id=${countryId}`)
                    .then(r => r.json())
                    .then(data => {
                        data.forEach(s => {
                            stateField.innerHTML += `<option value="${s.id}">${s.name}</option>`;
                        });
                        stateField.removeAttribute('disabled');
                    });
            }
        });

        document.getElementById('state').addEventListener('change', function() {
            const stateId = this.value;
            const cityField = document.getElementById('city');
            cityField.innerHTML = '<option value="">select..</option>';
            cityField.setAttribute('disabled', true);

            if (stateId) {
                fetch(`{{ route('locations.get-cities') }}?state_id=${stateId}`)
                    .then(r => r.json())
                    .then(data => {
                        data.forEach(c => {
                            cityField.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                        });
                        cityField.removeAttribute('disabled');
                    });
            }
        });
    </script>
</x-app-layout>
