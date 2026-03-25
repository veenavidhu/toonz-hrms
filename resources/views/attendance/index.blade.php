<x-app-layout>
    <x-slot name="header">
        Lifecycle Tracking
    </x-slot>

    <div class="max-w-6xl mx-auto space-y-10">
        <!-- Live Clock & Action Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 glass-card p-10 flex flex-col items-center justify-center text-center">
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-[0.3em] mb-4">Current Moment</p>
                <div id="liveClock" class="text-6xl font-black text-brand-accent tracking-tighter mb-8">00:00:00</div>
                <div class="text-xs font-bold text-gray-400 uppercase mb-10">{{ date('l, d F Y') }}</div>

                @if (!$todayAttendance)
                    <form action="{{ route('attendance.clockIn') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full py-5 bg-[#004499] text-white rounded-pill shadow-2xl shadow-blue-200 font-black uppercase tracking-widest transform hover:scale-105 hover:bg-[#003377] transition-all text-sm">
                            Initiate session
                        </button>
                    </form>
                @elseif(!$todayAttendance->clock_out)
                    <form action="{{ route('attendance.clockOut') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full py-5 bg-rose-500 text-white rounded-pill shadow-2xl shadow-rose-200 font-black uppercase tracking-widest transform hover:scale-105 transition-all text-sm">
                            Terminal session
                        </button>
                    </form>
                @else
                    <div
                        class="w-full py-5 bg-emerald-100 text-emerald-600 rounded-pill font-black uppercase tracking-widest text-sm">
                        Lifecycle Complete
                    </div>
                @endif
            </div>

            <!-- Recent History -->
            <div class="lg:col-span-2 glass-card p-10">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-xl font-black">History Log</h3>
                    <div class="flex space-x-2">
                        <div
                            class="w-8 h-8 rounded-full border border-gray-100 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    @if (count($attendances) > 0)
                        @foreach ($attendances as $attendance)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-brand-muted flex items-center justify-center text-brand-accent mr-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black">{{ $attendance->user->name }}</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase">
                                            {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-8 text-right">
                                    <div>
                                        <p class="text-[10px] font-black uppercase text-gray-300 tracking-tighter">In
                                        </p>
                                        <p class="text-sm font-bold text-brand-accent">{{ $attendance->clock_in }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase text-gray-300 tracking-tighter">Out
                                        </p>
                                        <p class="text-sm font-bold text-brand-accent">
                                            {{ $attendance->clock_out ?? '--:--' }}</p>
                                    </div>
                                    <div class="hidden md:block">
                                        <span
                                            class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-pill text-[10px] font-black uppercase tracking-widest">
                                            {{ $attendance->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-10">
                            <p class="text-sm text-gray-400 italic">No cycles detected.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateClock() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('en-GB', {
                    hour12: false
                });
                document.getElementById('liveClock').textContent = timeString;
            }
            setInterval(updateClock, 1000);
            updateClock();
        </script>
    @endpush
</x-app-layout>
