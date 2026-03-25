<x-app-layout> <x-slot name="header"> Company Settings </x-slot>
    <div class="max-w-4xl mx-auto mt-6">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl text-sm font-medium"> {{ session('success') }}
            </div>
        @endif
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 ">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Global Configuration</h3>
            </div>
            <form action="{{ route('settings.update') }}" method="POST" class="p-8 space-y-8"> @csrf <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-8"> <!-- Branding Section -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Branding</h4>
                        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Company
                                Name</label> <input type="text" name="company_name"
                                value="{{ $settings['company_name'] ?? 'HRMS Solution' }}"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div> <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tagline</label>
                            <input type="text" name="company_tagline"
                                value="{{ $settings['company_tagline'] ?? 'Advanced Resource Management' }}"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div> <!-- HR Config Section -->
                    <div class="space-y-6">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">HR Policy</h4>
                        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Default
                                Salary Month</label> <select name="salary_month"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="Current"
                                    {{ ($settings['salary_month'] ?? '') == 'Current' ? 'selected' : '' }}>Current Month
                                </option>
                                <option value="Previous"
                                    {{ ($settings['salary_month'] ?? '') == 'Previous' ? 'selected' : '' }}>Previous
                                    Month</option>
                            </select> </div>
                        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Late
                                Attendance Threshold (HH:MM)</label> <input type="time" name="late_threshold"
                                value="{{ $settings['late_threshold'] ?? '09:30' }}"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                </div> <!-- System Config -->
                <div class="pt-8 border-t border-gray-100 space-y-6">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Contact Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">System
                                Email</label> <input type="email" name="system_email"
                                value="{{ $settings['system_email'] ?? 'admin@hrms.com' }}"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div> <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Company
                                Address</label>
                            <textarea name="company_address" rows="1"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-indigo-500">{{ $settings['company_address'] ?? '123 Business Way, Tech City' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end space-x-4 pt-6 mt-6 border-t border-gray-100 "> <button
                        type="submit"
                        class="btn-primary">Save
                        Global Settings</button> </div>
            </form>
        </div>
    </div>
</x-app-layout>
