<x-app-layout>
    <x-slot name="header">
        Financial Cycles
    </x-slot>

    <div class="space-y-10 pb-10">
        <!-- Action Board -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 glass-card p-10">
                <h3 class="text-xl font-black mb-8 tracking-tighter">Process New Cycle</h3>
                <form action="{{ route('payroll.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Target
                            Period</label>
                        <div class="grid grid-cols-2 gap-4">
                            <select name="month"
                                class="w-full bg-brand-muted border-0 rounded-2xl p-4 text-sm font-bold focus:ring-2 focus:ring-brand-accent">
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="year" value="{{ date('Y') }}"
                                class="w-full bg-brand-muted border-0 rounded-2xl p-4 text-sm font-bold focus:ring-2 focus:ring-brand-accent">
                        </div>
                    </div>

                    <button type="submit"
                        class="btn-primary w-full !py-5 !rounded-2xl">
                        Generate Ledger
                    </button>
                </form>
            </div>

            <!-- Stats Summary -->
            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="glass-card p-10 flex items-center justify-between group cursor-pointer hover:bg-brand-accent hover:text-white transition-all duration-500">
                    <div>
                        <p
                            class="text-[10px] font-black uppercase text-gray-400 group-hover:text-white/50 tracking-widest leading-none">
                            Net Disbursed</p>
                        <h3 class="text-4xl font-black mt-2 tracking-tighter">$42,850</h3>
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-brand-muted flex items-center justify-center text-brand-accent group-hover:bg-white group-hover:scale-110 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div
                    class="glass-card p-10 flex items-center justify-between group cursor-pointer hover:bg-brand-accent hover:text-white transition-all duration-500">
                    <div>
                        <p
                            class="text-[10px] font-black uppercase text-gray-400 group-hover:text-white/50 tracking-widest leading-none">
                            Cycles Processed</p>
                        <h3 class="text-4xl font-black mt-2 tracking-tighter">{{ count($payrolls) }}</h3>
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-brand-muted flex items-center justify-center text-brand-accent group-hover:bg-white group-hover:scale-110 transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ledger History -->
        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/20">
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                Stakeholder</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Period
                            </th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Base
                                Salary</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Net
                                Payable</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                                Ledger</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach ($payrolls as $payroll)
                            <tr class="hover:bg-white/30 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-pill bg-brand-muted flex items-center justify-center font-black text-brand-accent mr-4">
                                            {{ substr($payroll->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-brand-accent">{{ $payroll->user->name }}
                                            </div>
                                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                                                {{ $payroll->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-black text-gray-600">
                                        {{ date('F', mktime(0, 0, 0, $payroll->month, 1)) }}, {{ $payroll->year }}
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-gray-500">
                                        ${{ number_format($payroll->base_salary, 2) }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-black text-brand-accent">
                                        ${{ number_format($payroll->net_salary, 2) }}</div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('payroll.download', $payroll) }}"
                                        class="pill-button bg-brand-muted text-[10px] font-black uppercase tracking-widest hover:active-bubble transition-all">
                                        Export PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
