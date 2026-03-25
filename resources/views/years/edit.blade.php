<x-app-layout>
    <x-slot name="header">Year Master</x-slot>

    <div class="max-w-[1600px] mx-auto px-6 pb-12">
        <div class="glass-card overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 bg-white/50 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#004499]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-black text-gray-800 tracking-tight uppercase">UPDATE YEAR</h2>
            </div>

            <form action="{{ route('years.update', $year) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    {{-- Year Type --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Year Type <span class="text-rose-500">*</span></label>
                        <select name="year_type" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                            <option value="">Select Year Type</option>
                            <option value="FINANCIAL YEAR" {{ $year->year_type == 'FINANCIAL YEAR' ? 'selected' : '' }}>FINANCIAL YEAR</option>
                            <option value="LEAVE YEAR" {{ $year->year_type == 'LEAVE YEAR' ? 'selected' : '' }}>LEAVE YEAR</option>
                            <option value="REIMBURSEMENT" {{ $year->year_type == 'REIMBURSEMENT' ? 'selected' : '' }}>REIMBURSEMENT</option>
                        </select>
                    </div>

                    {{-- Start Date --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Year Start Date <span class="text-rose-500">*</span></label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $year->start_date->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                    </div>

                    {{-- Year Name (Computed) --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Year <span class="text-rose-500">*</span></label>
                        <input type="text" name="year_name" id="year_name" value="{{ old('year_name', $year->year_name) }}" placeholder="Auto-filled from Start Date"
                            class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm font-black outline-none focus:ring-2 focus:ring-[#004499]/20 transition-all uppercase" readonly required>
                    </div>

                    {{-- Select OU --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Select OU <span class="text-rose-500">*</span></label>
                        <select name="ou_based_selection" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                            <option value="">Select OU</option>
                            <option value="COMP_CODE" {{ $year->ou_based_selection == 'COMP_CODE' ? 'selected' : '' }}>COMP</option>
                            <option value="FUNCT_CODE" {{ $year->ou_based_selection == 'FUNCT_CODE' ? 'selected' : '' }}>FUNCTION </option>
                            <option value="SFUNCT_CODE" {{ $year->ou_based_selection == 'SFUNCT_CODE' ? 'selected' : '' }}>SFUNCTION </option>
                            <option value="GRD_CODE" {{ $year->ou_based_selection == 'GRD_CODE' ? 'selected' : '' }}>GRADE </option>
                            <option value="LOC_CODE" {{ $year->ou_based_selection == 'LOC_CODE' ? 'selected' : '' }}>LOCATION </option>
                            <option value="DSG_CODE" {{ $year->ou_based_selection == 'DSG_CODE' ? 'selected' : '' }}>DSGINATION</option>
                            <option value="BussCode" {{ $year->ou_based_selection == 'BussCode' ? 'selected' : '' }}>BUSSINESS</option>
                            <option value="SUBBuss_Code" {{ $year->ou_based_selection == 'SUBBuss_Code' ? 'selected' : '' }}>SUB-BUISNESS</option>
                        </select>
                    </div>

                    {{-- Company --}}
                    <div>
                        <label class="block text-xs font-black text-[#004499] uppercase tracking-widest mb-2">Company <span class="text-rose-500">*</span></label>
                        <select name="company_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all" required>
                            <option value="">Select Company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $year->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    {{-- Status For Pay Calculation --}}
                    <div class="flex items-center gap-4">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Status For Pay Calculation</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="pay_calc_status" value="0">
                            <input type="checkbox" name="pay_calc_status" value="1" class="sr-only peer" {{ $year->pay_calc_status ? 'checked' : '' }}>
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:bg-[#004499] after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                        </label>
                    </div>

                    {{-- Status --}}
                    <div class="flex items-center gap-4">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Status</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1" class="sr-only peer" {{ $year->status ? 'checked' : '' }}>
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:bg-[#004499] after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                        </label>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex items-center justify-start gap-4">
                    <button type="submit" class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">
                        Update
                    </button>
                    <a href="{{ route('years.index') }}"
                        class="px-8 py-2.5 bg-[#004499] text-white rounded-md font-bold text-sm hover:bg-[#003377] transition-all shadow-md active:scale-95">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('start_date').addEventListener('change', function() {
            const date = new Date(this.value);
            if (!isNaN(date.getFullYear())) {
                document.getElementById('year_name').value = date.getFullYear();
            }
        });
    </script>
</x-app-layout>
