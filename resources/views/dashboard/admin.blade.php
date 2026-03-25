<x-app-layout>
    <x-slot name="header">
        Experience Overview
    </x-slot>

    <div class="space-y-10 pb-10">
        <!-- Top Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-glass-stat-card label="Total Team" :value="$stats['total_employees']"
                icon="M17 20h5V10h-5V7a5 5 0 00-10 0v3H2v10h5m10 0a3 3 0 01-3 3H7a3 3 0 01-3-3m10 0V10M7 20V10"
                color="bg-blue-500" />
            <x-glass-stat-card label="Departments" :value="$stats['total_departments']"
                icon="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                color="bg-purple-500" />
            <x-glass-stat-card label="On Duty" :value="$stats['present_today']" icon="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                color="bg-emerald-500" />
            <x-glass-stat-card label="Pending" :value="$stats['pending_leaves']"
                icon="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                color="bg-pink-500" />
        </div>

        <!-- Main Journey Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Attendance Journey (Large Chart) -->
            <div class="lg:col-span-2 glass-card p-10 flex flex-col">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-black">Engagement Flow</h3>
                    <div class="flex space-x-2">
                        <button
                            class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-brand-accent transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                        <button
                            class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-brand-accent transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex-1 min-h-[300px]">
                    <canvas id="attendanceChart"></canvas>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-100 flex justify-around">
                    <div class="text-center">
                        <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Efficiency</p>
                        <p class="text-lg font-bold">94.2%</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Absence Rate</p>
                        <p class="text-lg font-bold text-rose-500">2.8%</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Retention</p>
                        <p class="text-lg font-bold text-emerald-500">98%</p>
                    </div>
                </div>
            </div>

            <!-- Distribution Journey (Donut Chart) -->
            <div class="glass-card p-10 flex flex-col">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-black">Force Mapping</h3>
                </div>
                <div class="flex-1 flex items-center justify-center p-4">
                    <canvas id="deptChart"></canvas>
                </div>
                <div class="mt-8 space-y-4">
                    @foreach ($deptLabels as $index => $label)
                        @if ($index < 3)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="w-2 h-2 rounded-full mr-3"
                                        style="background-color: {{ ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'][$index % 5] }}"></span>
                                    <span
                                        class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $label }}</span>
                                </div>
                                <span class="text-xs font-black">{{ $deptCounts[$index] }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Lower Section: Announcements & Birthdays -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="glass-card p-10">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-black">Fresh Knowledge</h3>
                    <a href="{{ route('announcements.index') }}"
                        class="text-[10px] font-black uppercase text-gray-400 tracking-tighter hover:text-brand-accent transition-all">Deep
                        Dive →</a>
                </div>
                <div class="space-y-6">
                    @if (count($announcements) > 0)
                        @foreach ($announcements as $ann)
                            <div class="flex group">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-brand-muted flex items-center justify-center text-brand-accent mr-4 group-hover:active-bubble transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold">{{ $ann->title }}</h4>
                                    <p class="text-xs text-gray-400 mt-1 line-clamp-1">{{ $ann->content }}</p>
                                </div>
                                <div class="text-[10px] font-black text-gray-300 uppercase whitespace-nowrap pt-1">
                                    {{ $ann->created_at->format('M d') }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500 italic">Static knowledge base...</p>
                    @endif
                </div>
            </div>

            <div class="glass-card p-10">
                <h3 class="text-xl font-black mb-8">Lifecycle Milestones</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @if (count($birthdays) > 0)
                        @foreach ($birthdays as $bd)
                            <div class="flex flex-col items-center">
                                <div class="relative mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($bd->user->name) }}&background=E8EBF2&color=000"
                                        class="w-16 h-16 rounded-pill border-4 border-white shadow-sm transition-transform hover:scale-110">
                                    <span
                                        class="absolute -bottom-1 -right-1 w-6 h-6 bg-brand-accent text-white flex items-center justify-center rounded-full text-[10px] font-bold shadow-lg">🎂</span>
                                </div>
                                <p class="text-xs font-bold text-center leading-tight">
                                    {{ explode(' ', $bd->user->name)[0] }}</p>
                                <p class="text-[10px] font-black text-gray-300 uppercase mt-1">
                                    {{ \Carbon\Carbon::parse($bd->dob)->format('d M') }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full py-10 text-center">
                            <p class="text-sm text-gray-400">No milestones this period.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Engagement Flow (Attendance Chart)
            const ctxA = document.getElementById('attendanceChart').getContext('2d');
            const gradientA = ctxA.createLinearGradient(0, 0, 0, 400);
            gradientA.addColorStop(0, 'rgba(0, 0, 0, 0.05)');
            gradientA.addColorStop(1, 'rgba(255, 255, 255, 0)');

            new Chart(ctxA, {
                type: 'line',
                data: {
                    labels: {!! json_encode($attendanceLabels) !!},
                    datasets: [{
                        label: 'Flow',
                        data: {!! json_encode($attendanceData) !!},
                        borderColor: '#000000',
                        borderWidth: 4,
                        tension: 0.5,
                        fill: true,
                        backgroundColor: gradientA,
                        pointBackgroundColor: '#000',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            display: false
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    weight: 'bold',
                                    size: 10
                                },
                                color: '#9CA3AF'
                            }
                        }
                    }
                }
            });

            // Force Mapping (Department Chart)
            const ctxD = document.getElementById('deptChart').getContext('2d');
            new Chart(ctxD, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($deptLabels) !!},
                    datasets: [{
                        data: {!! json_encode($deptCounts) !!},
                        backgroundColor: ['#000', '#F3F5F9', '#9CA3AF', '#D1D5DB', '#E5E7EB'],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '80%',
                    radius: '90%'
                }
            });
        </script>
    @endpush
</x-app-layout>
