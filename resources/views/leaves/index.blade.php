<x-app-layout>
    <x-slot name="header">
        Absence Flow
    </x-slot>

    <div class="space-y-8 pb-10">
        <!-- Action & Filter Bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div
                class="flex items-center space-x-2 bg-white/40 backdrop-blur p-1 rounded-pill border border-white/50 shadow-sm">
                <button class="px-6 py-2 active-bubble text-[10px] font-black uppercase tracking-widest shadow-lg">All
                    Cycles</button>
                <button
                    class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-brand-accent transition-all">Pending</button>
                <button
                    class="px-6 py-2 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-brand-accent transition-all">Approved</button>
            </div>

            <a href="{{ route('leaves.create') }}"
                class="px-6 py-2.5 rounded-xl bg-[#004499] text-white font-black tracking-widest transition-all flex items-center justify-center space-x-2 uppercase transform hover:scale-105 active:scale-95 shadow-lg shadow-blue-900/10 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Request Leave</span>
            </a>
        </div>

        <!-- Leaves Grid/Table -->
        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/20">
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                Employee</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                Category</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                Duration</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status
                            </th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach ($leaves as $leave)
                            <tr class="hover:bg-white/30 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-pill border-2 border-white shadow-sm mr-4"
                                            src="https://ui-avatars.com/api/?name={{ urlencode($leave->user->name) }}&background=000&color=fff"
                                            alt="">
                                        <div>
                                            <div class="text-sm font-black text-brand-accent">{{ $leave->user->name }}
                                            </div>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                                                {{ $leave->reason }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 bg-brand-muted text-gray-500 rounded-pill text-[10px] font-black uppercase tracking-widest">
                                        {{ $leave->type }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-gray-600">
                                        {{ Carbon\Carbon::parse($leave->start_date)->format('M d') }} -
                                        {{ Carbon\Carbon::parse($leave->end_date)->format('M d') }}</div>
                                    <div class="text-[10px] font-black text-gray-300 uppercase">{{ $leave->days }}
                                        Total Days</div>
                                </td>
                                <td class="px-8 py-6">
                                    @if ($leave->status == 'pending')
                                        <span
                                            class="px-3 py-1 bg-amber-100 text-amber-600 rounded-pill text-[10px] font-black uppercase tracking-widest">Pending</span>
                                    @elseif($leave->status == 'approved')
                                        <span
                                            class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-pill text-[10px] font-black uppercase tracking-widest">Approved</span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-rose-100 text-rose-600 rounded-pill text-[10px] font-black uppercase tracking-widest">Rejected</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    @if ($leave->status == 'pending')
                                        @hasanyrole('Super Admin|Admin|HR|Manager')
                                            <form action="{{ route('leaves.approve', $leave) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="w-10 h-10 flex items-center justify-center rounded-pill bg-[#004499] text-white hover:bg-[#003377] hover:shadow-xl hover:scale-110 transition-all shadow-md shadow-blue-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endhasanyrole
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
