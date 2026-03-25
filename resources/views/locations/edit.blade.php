<x-app-layout>
    <x-slot name="header">Locations</x-slot>

    <div class="max-w-[1600px] mx-auto px-6 pb-12">
        <div class="glass-card overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-white/50">
                <h2 class="text-lg font-black text-gray-800 tracking-tight uppercase">UPDATE LOCATION</h2>
            </div>

            <form action="{{ route('locations.update', $location) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-8">

                    {{-- Location Code --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Location Code</label>
                        <input type="text" name="location_code" value="{{ old('location_code', $location->location_code) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                    </div>

                    {{-- Country --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Country</label>
                        <select id="country" name="country_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl" required>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ $location->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- State --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Select State</label>
                        <select id="state" name="state_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl" required>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ $location->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Location Name --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Location Name</label>
                        <input type="text" name="location_name" value="{{ old('location_name', $location->location_name) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl" required>
                    </div>

                    {{-- Pin Code --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Pin Code</label>
                        <input type="text" name="pin_code" value="{{ old('pin_code', $location->pin_code) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                            <option value="1" {{ $location->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$location->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- City --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Select City</label>
                        <select id="city" name="city_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl" required>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $location->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Time Zone --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Time Zone</label>
                        <select name="time_zone" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                            @foreach($timezones as $tz)
                                <option value="{{ $tz }}" {{ $location->time_zone == $tz ? 'selected' : '' }}>{{ $tz }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex gap-4">
                    <button type="submit" class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">Update</button>
                    <a href="{{ route('locations.index') }}" class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">Cancel</a>
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
            cityField.innerHTML = '<option value="">select..</option>';

            if (countryId) {
                fetch(`{{ route('locations.get-states') }}?country_id=${countryId}`)
                    .then(r => r.json())
                    .then(data => {
                        data.forEach(s => {
                            stateField.innerHTML += `<option value="${s.id}">${s.name}</option>`;
                        });
                    });
            }
        });

        document.getElementById('state').addEventListener('change', function() {
            const stateId = this.value;
            const cityField = document.getElementById('city');
            cityField.innerHTML = '<option value="">select..</option>';

            if (stateId) {
                fetch(`{{ route('locations.get-cities') }}?state_id=${stateId}`)
                    .then(r => r.json())
                    .then(data => {
                        data.forEach(c => {
                            cityField.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                        });
                    });
            }
        });
    </script>
</x-app-layout>
