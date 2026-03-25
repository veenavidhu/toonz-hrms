<x-app-layout>
    <x-slot name="header">
        Add Company
    </x-slot>

    <div class="px-6 pb-12 max-w-[1400px] mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-10 border-b border-gray-100">
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Company Master Registration</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Please fill out this form to register a new company and its registration details in the system.</p>
            </div>

            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" x-data="locationSetup()" class="p-10 space-y-12">
                @csrf
                
                <!-- Section 1: Basic Details -->
                <div class="space-y-8">
                    <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                        <h3 class="text-xs font-black text-blue-900 uppercase tracking-widest">Basic Information</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Company Name <span class="text-rose-500">*</span></label>
                            <input type="text" name="company_name" required value="{{ old('company_name') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Enter the full legal name of the entity.</p>
                            @error('company_name')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Company Logo</label>
                            <div class="w-full px-4 py-2 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl transition-all">
                                <input type="file" name="company_logo" accept="image/*"
                                    class="w-full text-xs text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Recommended: PNG or JPG, max 2MB.</p>
                            @error('company_logo')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Company Address <span class="text-rose-500">*</span></label>
                            <textarea name="company_address" required rows="1"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all resize-none">{{ old('company_address') }}</textarea>
                            <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Physical location of the headquarters.</p>
                            @error('company_address')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Country <span class="text-rose-500">*</span></label>
                            <select name="country_id" x-model="selectedCountry" @change="fetchStates()" required
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold text-gray-700 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all cursor-pointer">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">State <span class="text-rose-500">*</span></label>
                            <select name="state_id" x-model="selectedState" @change="fetchCities()" :disabled="!states.length" required
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold text-gray-700 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all cursor-pointer disabled:opacity-50">
                                <option value="">Select State</option>
                                <template x-for="state in states" :key="state.id">
                                    <option :value="state.id" x-text="state.name"></option>
                                </template>
                            </select>
                            @error('state_id')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">City <span class="text-rose-500">*</span></label>
                            <select name="city_id" :disabled="!cities.length" required
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold text-gray-700 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all cursor-pointer disabled:opacity-50">
                                <option value="">Select City</option>
                                <template x-for="city in cities" :key="city.id">
                                    <option :value="city.id" x-text="city.name"></option>
                                </template>
                            </select>
                            @error('city_id')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Postal Code <span class="text-rose-500">*</span></label>
                            <input type="text" name="postal_code" required value="{{ old('postal_code') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('postal_code')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Phone No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="phone_no" required value="{{ old('phone_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('phone_no')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Fax No.</label>
                            <input type="text" name="fax_no" value="{{ old('fax_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('fax_no')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Statutory Details -->
                <div class="space-y-8">
                    <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                        <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                        <h3 class="text-xs font-black text-blue-900 uppercase tracking-widest">Statutory Information</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">PF No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="pf_no" required value="{{ old('pf_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('pf_no')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">ESI. No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="esi_no" required value="{{ old('esi_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('esi_no')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">PAN No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="pan_no" required value="{{ old('pan_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('pan_no')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">TAN No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="tan_no" required value="{{ old('tan_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('tan_no')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">TDS Circle <span class="text-rose-500">*</span></label>
                            <input type="text" name="tds_circle" required value="{{ old('tds_circle') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('tds_circle')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">UEN <span class="text-rose-500">*</span></label>
                            <input type="text" name="uen" required value="{{ old('uen') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('uen')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">GST No.</label>
                            <input type="text" name="gst_no" value="{{ old('gst_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">LST No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="lst_no" required value="{{ old('lst_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('lst_no') <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">CST No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="cst_no" required value="{{ old('cst_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('cst_no') <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Service Tax No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="service_tax_no" required value="{{ old('service_tax_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('service_tax_no') <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 3: Registration Contact -->
                <div class="space-y-8">
                    <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <h3 class="text-xs font-black text-blue-900 uppercase tracking-widest">Registration Contact</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Registration No/UEN <span class="text-rose-500">*</span></label>
                            <input type="text" name="registration_no" required value="{{ old('registration_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('registration_no')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Email ID <span class="text-rose-500">*</span></label>
                            <input type="email" name="email_id" required value="{{ old('email_id') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all"
                                placeholder="example@company.com">
                            <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Primary corporate contact email.</p>
                            @error('email_id')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Website</label>
                            <input type="url" name="website" value="{{ old('website') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all"
                                placeholder="https://">
                            @error('website')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Registered Address <span class="text-rose-500">*</span></label>
                            <input type="text" name="reg_address" required value="{{ old('reg_address') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('reg_address')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Registered City <span class="text-rose-500">*</span></label>
                            <input type="text" name="reg_city" required value="{{ old('reg_city') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('reg_city') <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">PIN No. <span class="text-rose-500">*</span></label>
                            <input type="text" name="reg_pin_no" required value="{{ old('reg_pin_no') }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('reg_pin_no') <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-gray-100 flex justify-center">
                    <button type="submit"
                        class="btn-primary flex items-center gap-2">
                        Save Company
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for handling cascading dropdowns -->
    <script>
        function locationSetup() {
            return {
                selectedCountry: '{{ old('country_id') }}',
                selectedState: '{{ old('state_id') }}',
                states: [],
                cities: [],
                init() {
                    if (this.selectedCountry) {
                        this.fetchStates();
                    }
                },
                fetchStates() {
                    this.states = [];
                    this.cities = [];
                    this.selectedState = '';
                    if (!this.selectedCountry) return;
                    fetch(`{{ route('locations.get-states') }}?country_id=${this.selectedCountry}`)
                        .then(response => response.json())
                        .then(data => {
                            this.states = data;
                            if ('{{ old('state_id') }}') {
                                this.selectedState = '{{ old('state_id') }}';
                                this.fetchCities();
                            }
                        });
                },
                fetchCities() {
                    this.cities = [];
                    if (!this.selectedState) return;
                    fetch(`{{ route('locations.get-cities') }}?state_id=${this.selectedState}`)
                        .then(response => response.json())
                        .then(data => {
                            this.cities = data;
                            setTimeout(() => {
                                let oldCity = '{{ old('city_id') }}';
                                if (oldCity) {
                                    const select = document.querySelector('select[name="city_id"]');
                                    if (select) select.value = oldCity;
                                }
                            }, 50);
                        });
                }
            }
        }
    </script>
</x-app-layout>
