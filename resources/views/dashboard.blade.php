<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden">
                <div class="p-12 text-gray-900 min-h-[600px]">
                    <h1 class="text-4xl font-black mb-8">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-xl text-gray-500 mb-12">Here's what's happening in your workspace today.</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Example Stats Cards with even more glass feel -->
                        <div class="bg-white/20 backdrop-blur-3xl p-8 rounded-[3.5rem] border border-white/40 shadow-sm">
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Total Employees
                            </p>
                            <h3 class="text-5xl font-black">124</h3>
                        </div>
                        <div
                            class="bg-white/20 backdrop-blur-3xl p-8 rounded-[3.5rem] border border-white/40 shadow-sm">
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">On Leave</p>
                            <h3 class="text-5xl font-black">12</h3>
                        </div>
                        <div
                            class="bg-white/20 backdrop-blur-3xl p-8 rounded-[3.5rem] border border-white/40 shadow-sm">
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">New Hires</p>
                            <h3 class="text-5xl font-black">5</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
