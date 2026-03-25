<x-app-layout>
    <x-slot name="header">
        Company Master
    </x-slot>

    <div class="space-y-8 pb-10 px-6 max-w-[1600px] mx-auto">

        <!-- Animated Toast Notification -->
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                class="fixed top-6 right-6 z-[200] w-full max-w-[320px] bg-white/80 backdrop-blur-xl rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-white/40 p-4 transform transition-all duration-500">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1 pt-0.5">
                        <p class="text-xs font-black text-gray-900 mb-0.5 tracking-tight uppercase">Success</p>
                        <p class="text-[10px] text-gray-500 font-bold leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="glass-card overflow-hidden">
            <!-- Header & Actions -->
            <div
                class="px-8 py-6 border-b border-white/30 flex flex-col md:flex-row justify-between items-center gap-4 bg-white/40">
                <h2 class="text-xl font-black text-gray-800 tracking-tighter">Companies</h2>

                <div class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                    <!-- Add Button -->
                    <a href="{{ route('companies.create') }}"
                        class="w-full md:w-auto px-6 py-2.5 rounded-xl bg-[#004499] text-white font-black tracking-widest transition-all flex items-center justify-center space-x-2 uppercase transform hover:scale-105 active:scale-95 shadow-lg shadow-blue-900/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-[10px] uppercase tracking-widest">Add New</span>
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-black/5">
                        <tr>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                #</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Company Name</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Email</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Phone</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Location</th>
                            <th
                                class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-white/10">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @if (count($companies) > 0)
                            @foreach ($companies as $company)
                                <tr class="hover:bg-white/40 transition-all group">
                                    <td class="px-8 py-4 text-[11px] font-black text-gray-500 tracking-tighter">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-8 py-4 flex items-center space-x-3">
                                        @if ($company->company_logo)
                                            <div
                                                class="w-8 h-8 rounded border border-gray-100 bg-white flex-shrink-0 flex items-center justify-center overflow-hidden">
                                                <img src="{{ asset($company->company_logo) }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div
                                                class="w-8 h-8 rounded border border-gray-100 bg-gray-50 flex-shrink-0 flex items-center justify-center">
                                                <span
                                                    class="text-xs font-bold text-gray-400">{{ substr($company->company_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <span
                                            class="text-sm font-black text-gray-800 tracking-tight">{{ $company->company_name }}</span>
                                    </td>
                                    <td class="px-8 py-4 text-[12px] font-bold text-gray-600">
                                        {{ $company->email_id }}
                                    </td>
                                    <td class="px-8 py-4 text-[12px] font-bold text-gray-600">
                                        {{ $company->phone_no }}
                                    </td>
                                    <td class="px-8 py-4 text-[11px] font-bold text-gray-500 uppercase">
                                        {{ $company->cityModel->name ?? '' }}, {{ $company->country->name ?? '' }}
                                    </td>
                                    <td class="px-8 py-4 text-[11px]">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('companies.edit', $company) }}"
                                                class="px-4 py-1.5 bg-[#004499] text-white rounded text-[10px] font-black tracking-widest uppercase hover:bg-blue-800 transition-colors shadow-sm">Edit</a>

                                            <form action="{{ route('companies.destroy', $company) }}" method="POST"
                                                onsubmit="return confirm('Delete this company?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-1.5 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded transition-colors"
                                                    title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-xs font-black text-gray-300 uppercase tracking-widest">No
                                            companies found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</x-app-layout>
