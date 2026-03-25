<x-app-layout>
    <x-slot name="header">
        Absence Request
    </x-slot>

    <div class="px-6 pb-12 max-w-4xl mx-auto">
        <div class="glass-card overflow-hidden bg-white">
            <div class="p-10 border-b border-gray-100">
                <h2 class="text-2xl font-black text-gray-800 tracking-tight text-center">New Leave Request</h2>
                <p class="text-sm text-gray-500 font-medium mt-1 text-center">Submit your leave details for approval by the department head.</p>
            </div>

            <form action="{{ route('leaves.store') }}" method="POST" class="p-10 space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <!-- Leave Type -->
                    <div class="space-y-1">
                        <label for="type" class="block text-sm font-bold text-gray-700 ml-1">Leave Type <span class="text-rose-500">*</span></label>
                        <select name="type" id="type" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold shadow-sm outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all cursor-pointer">
                            <option value="Casual">Casual Leave</option>
                            <option value="Sick">Sick Leave</option>
                            <option value="Annual">Annual Leave</option>
                            <option value="Unpaid">Unpaid Leave</option>
                        </select>
                        <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Select the category of absence.</p>
                    </div>

                    <!-- Duration -->
                    <div class="space-y-1">
                        <label for="days" class="block text-sm font-bold text-gray-700 ml-1">Duration (Days) <span class="text-rose-500">*</span></label>
                        <input type="number" name="days" id="days" required min="0.5" step="0.5"
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all"
                            placeholder="e.g. 1">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1 font-medium">Total number of working days.</p>
                    </div>

                    <!-- Start Date -->
                    <div class="space-y-1">
                        <label for="start_date" class="block text-sm font-bold text-gray-700 ml-1">Start Date <span class="text-rose-500">*</span></label>
                        <input type="date" name="start_date" id="start_date" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                    </div>

                    <!-- End Date -->
                    <div class="space-y-1">
                        <label for="end_date" class="block text-sm font-bold text-gray-700 ml-1">End Date <span class="text-rose-500">*</span></label>
                        <input type="date" name="end_date" id="end_date" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all">
                    </div>
                </div>

                <!-- Reason -->
                <div class="space-y-1">
                    <label for="reason" class="block text-sm font-bold text-gray-700 ml-1">Reason / Context <span class="text-rose-500">*</span></label>
                    <textarea name="reason" id="reason" rows="4" required
                        class="w-full px-4 py-3 bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:bg-white duration-300 focus:border-black focus:ring-0 transition-all"
                        placeholder="Please provide context or justification for your absence..."></textarea>
                </div>

                <div class="pt-10 border-t border-gray-100 flex justify-center gap-6">
                    <a href="{{ route('leaves.index') }}"
                        class="px-10 py-4 bg-gray-100 text-gray-500 rounded-xl font-bold text-sm hover:bg-gray-200 transition-all active:scale-95 uppercase tracking-widest text-center">
                        Discard
                    </a>
                    <button type="submit"
                        class="btn-primary flex items-center gap-2">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
