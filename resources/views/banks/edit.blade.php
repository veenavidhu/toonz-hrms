<x-app-layout>
    <x-slot name="header">
        Edit Bank Master
    </x-slot>

    <div class="px-6 pb-12 max-w-[1400px] mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-10 border-b border-gray-100">
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Modify Bank Details</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Update parameters for <strong>{{ $bank->bank_name }}</strong> master entry.</p>
            </div>

            <form action="{{ route('banks.update', $bank) }}" method="POST" class="p-10 space-y-12">
                @csrf
                @method('PUT')
                
                <!-- Section 1: Personal Bank Details -->
                <div class="space-y-8">
                    <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                        <h3 class="text-xs font-black text-blue-900 uppercase tracking-widest">Personal Bank Details</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Bank Code <span class="text-rose-500">*</span></label>
                            <input type="text" name="bank_code" required value="{{ old('bank_code', $bank->bank_code) }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                            @error('bank_code')
                                <p class="text-[10px] text-rose-500 font-bold mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Bank Name <span class="text-rose-500">*</span></label>
                            <input type="text" name="bank_name" required value="{{ old('bank_name', $bank->bank_name) }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Bank Branch</label>
                            <input type="text" name="branch" value="{{ old('branch', $bank->branch) }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">IFSC Code <span class="text-rose-500">*</span></label>
                            <input type="text" name="ifsc_code" required value="{{ old('ifsc_code', $bank->ifsc_code) }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">MICR Code</label>
                            <input type="text" name="micr_code" value="{{ old('micr_code', $bank->micr_code) }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Bank Type <span class="text-rose-500">*</span></label>
                            <select name="bank_type"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all cursor-pointer">
                                <option value="Salary" {{ old('bank_type', $bank->bank_type) == 'Salary' ? 'selected' : '' }}>Salary</option>
                                <option value="Reimbursement" {{ old('bank_type', $bank->bank_type) == 'Reimbursement' ? 'selected' : '' }}>Reimbursement</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Company Bank Details -->
                <div class="space-y-8">
                    <div class="flex items-center gap-2 pb-2 border-b border-gray-50">
                        <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                        <h3 class="text-xs font-black text-blue-900 uppercase tracking-widest">Company Bank Details</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Company IFSC Code</label>
                            <input type="text" name="company_ifsc_code" value="{{ old('company_ifsc_code', $bank->company_ifsc_code) }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Company MICR Code</label>
                            <input type="text" name="company_micr_code" value="{{ old('company_micr_code', $bank->company_micr_code) }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Company Account Number</label>
                            <input type="text" name="company_account_number" value="{{ old('company_account_number', $bank->company_account_number) }}"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-gray-100 flex justify-center">
                    <button type="submit"
                        class="btn-primary flex items-center gap-2">
                        Update Bank Details
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
