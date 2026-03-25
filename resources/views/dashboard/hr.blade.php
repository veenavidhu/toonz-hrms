<x-app-layout> <x-slot name="header"> Super Admin Dashboard </x-slot>
    <div class="space-y-6"> <!-- Overview Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="glass-card p-6 transition-all hover:scale-[1.02] duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Employees</p>
                        <h3 class="text-3xl font-black text-gray-900 mt-1">142</h3>
                    </div>
                    <div class="p-3 bg-indigo-50/50 backdrop-blur-md rounded-2xl"> <svg class="w-6 h-6 text-indigo-600"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg> </div>
                </div>
                <div class="mt-4 flex items-center text-xs"> <span
                        class="text-green-500 font-black flex items-center bg-green-50 px-2 py-1 rounded-xl"> <svg
                            class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg> +12% </span> <span class="text-gray-400 ml-2 font-bold uppercase tracking-tighter">vs
                        last month</span> </div>
            </div>
            <div class="glass-card p-6 transition-all hover:scale-[1.02] duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Present Today</p>
                        <h3 class="text-3xl font-black text-gray-900 mt-1">118</h3>
                    </div>
                    <div class="p-3 bg-green-50/50 backdrop-blur-md rounded-2xl"> <svg class="w-6 h-6 text-green-600"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg> </div>
                </div>
                <div class="mt-4 flex items-center text-xs"> <span
                        class="text-gray-400 font-bold uppercase tracking-widest">83% attendance rate</span> </div>
            </div>
            <div class="glass-card p-6 transition-all hover:scale-[1.02] duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">On Leave</p>
                        <h3 class="text-3xl font-black text-gray-900 mt-1">12</h3>
                    </div>
                    <div class="p-3 bg-yellow-50/50 backdrop-blur-md rounded-2xl"> <svg class="w-6 h-6 text-yellow-600"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg> </div>
                </div>
                <div class="mt-4 flex items-center text-xs"> <span
                        class="text-gray-400 font-bold uppercase tracking-widest">4 approvals pending</span> </div>
            </div>
            <div class="glass-card p-6 transition-all hover:scale-[1.02] duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Payroll Run</p>
                        <h3 class="text-3xl font-black text-gray-900 mt-1">$2.4M</h3>
                    </div>
                    <div class="p-3 bg-purple-50/50 backdrop-blur-md rounded-2xl"> <svg class="w-6 h-6 text-purple-600"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg> </div>
                </div>
                <div class="mt-4 flex items-center text-xs"> <span
                        class="text-purple-600 font-black bg-purple-50 px-2 py-1 rounded-xl">Next run: Nov 28</span>
                </div>
            </div>
        </div> <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 glass-card p-8 transition-all duration-300">
                <h3 class="text-lg font-black text-gray-900 mb-6 uppercase tracking-widest">Attendance Trends</h3>
                <div class="h-64 w-full relative"> <canvas id="attendanceChart"></canvas> </div>
            </div>
            <div class="glass-card p-8 transition-all duration-300">
                <h3 class="text-lg font-black text-gray-900 mb-6 uppercase tracking-widest">Department Distribution</h3>
                <div class="h-64 w-full relative flex justify-center"> <canvas id="departmentChart"></canvas> </div>
            </div>
        </div> <!-- Info & Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"> <!-- Latest Activity -->
            <div class="lg:col-span-2 glass-card p-8 transition-all duration-300">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-black text-gray-900 uppercase tracking-widest">Recent Activity</h3> <a
                        href="#"
                        class="text-xs font-black text-indigo-600 hover:text-black transition-all uppercase tracking-widest bg-indigo-50 px-4 py-2 rounded-pill">View
                        all</a>
                </div>
                <div class="space-y-6"> <!-- Activity item -->
                    <div class="flex items-start group">
                        <div
                            class="flex-shrink-0 h-12 w-12 rounded-2xl bg-blue-100 flex items-center justify-center transition-transform group-hover:scale-110">
                            <span class="font-black text-blue-600">SJ</span> </div>
                        <div class="ml-4 flex-1">
                            <p class="text-md text-gray-900"><span class="font-black">Sarah Jenkins</span> applied for
                                <span class="font-black text-indigo-600">Sick Leave</span></p>
                            <p class="text-xs text-gray-400 mt-1 font-bold">10 MINUTES AGO</p>
                        </div>
                    </div> <!-- Activity item -->
                    <div class="flex items-start group">
                        <div
                            class="flex-shrink-0 h-12 w-12 rounded-2xl bg-green-100 flex items-center justify-center transition-transform group-hover:scale-110">
                            <span class="font-black text-green-600">MK</span> </div>
                        <div class="ml-4 flex-1">
                            <p class="text-md text-gray-900"><span class="font-black">Mike Kramer</span> was <span
                                    class="font-black text-green-600">approved</span> for payroll</p>
                            <p class="text-xs text-gray-400 mt-1 font-bold">2 HOURS AGO</p>
                        </div>
                    </div> <!-- Activity item -->
                    <div class="flex items-start group">
                        <div
                            class="flex-shrink-0 h-12 w-12 rounded-2xl bg-purple-100 flex items-center justify-center transition-transform group-hover:scale-110">
                            <span class="font-black text-purple-600">RD</span> </div>
                        <div class="ml-4 flex-1">
                            <p class="text-md text-gray-900"><span class="font-black">HR Department</span> published
                                an announcement</p>
                            <p class="text-xs text-gray-400 mt-1 font-bold">YESTERDAY AT 4:32 PM</p>
                        </div>
                    </div>
                </div>
            </div> <!-- Upcoming Birthdays -->
            <div class="glass-card p-8 transition-all duration-300 relative overflow-hidden group">
                <div class="flex items-center gap-3 mb-8 relative z-10">
                    <div class="p-2 bg-yellow-100/50 rounded-xl group-hover:rotate-12 transition-transform"> <svg
                            class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z"
                                clip-rule="evenodd"></path>
                            <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path>
                        </svg> </div>
                    <h3 class="text-lg font-black text-gray-900 uppercase tracking-widest">Upcoming Birthdays</h3>
                </div>
                <div class="space-y-4 relative z-10">
                    <div
                        class="flex items-center justify-between bg-gray-50/50 dark:bg-white/5 p-4 rounded-2xl border border-gray-100 dark:border-white/5 transition-all hover:translate-x-1">
                        <div class="flex items-center gap-4"> <img
                                class="w-12 h-12 rounded-full ring-2 ring-white shadow-sm"
                                src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff"
                                alt="Avatar">
                            <div>
                                <p class="text-sm font-black text-gray-900">John Doe</p>
                                <p class="text-xs font-bold text-indigo-600 uppercase tracking-tighter">Engineering</p>
                            </div>
                        </div>
                        <div class="text-right"> <span
                                class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-black rounded-pill uppercase tracking-widest">Today</span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between bg-gray-50/50 dark:bg-white/5 p-4 rounded-2xl border border-gray-100 dark:border-white/5 transition-all hover:translate-x-1">
                        <div class="flex items-center gap-4"> <img
                                class="w-12 h-12 rounded-full ring-2 ring-white shadow-sm"
                                src="https://ui-avatars.com/api/?name=Alice+Smith&background=10b981&color=fff"
                                alt="Avatar">
                            <div>
                                <p class="text-sm font-black text-gray-900">Alice Smith</p>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-tighter">Marketing</p>
                            </div>
                        </div>
                        <div class="text-right pl-4 border-l border-gray-200 dark:border-white/10">
                            <p class="text-md font-black text-gray-900">Nov 15</p>
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">3 days left</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded',
            function() { // Check for dark mode to style charts const isDarkMode = document.documentElement.classList.contains('dark'); const textColor = isDarkMode ? '#9ca3af' : '#4b5563'; const gridColor = isDarkMode ? '#374151' : '#e5e7eb'; // Attendance Trend Chart const ctx1 = document.getElementById('attendanceChart').getContext('2d'); new Chart(ctx1, { type: 'line', data: { labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'], datasets: [{ label: 'Present', data: [112, 118, 115, 120, 114], borderColor: '#4f46e5', backgroundColor: 'rgba(79, 70, 229, 0.1)', borderWidth: 3, tension: 0.4, fill: true }, { label: 'Absent', data: [10, 5, 8, 3, 9], borderColor: '#ef4444', backgroundColor: 'rgba(239, 68, 68, 0.0)', borderWidth: 2, tension: 0.4, borderDash: [5, 5] }] }, options: { responsive: true, maintainAspectRatio: false, color: textColor, scales: { y: { beginAtZero: true, grid: { color: gridColor }, ticks: { color: textColor } }, x: { grid: { display: false }, ticks: { color: textColor } } }, plugins: { legend: { labels: { color: textColor } } } } }); // Department Chart const ctx2 = document.getElementById('departmentChart').getContext('2d'); new Chart(ctx2, { type: 'doughnut', data: { labels: ['Engineering', 'Marketing', 'Sales', 'HR', 'Finance'], datasets: [{ data: [45, 20, 35, 10, 15], backgroundColor: [ '#4f46e5', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6' ], borderWidth: 0, hoverOffset: 4 }] }, options: { responsive: true, maintainAspectRatio: false, color: textColor, cutout: '70%', plugins: { legend: { position: 'bottom', labels: { color: textColor, padding: 20 } } } } }); }); 
    </script>
</x-app-layout>
