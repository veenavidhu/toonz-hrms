<header class="h-20 flex items-center justify-between px-8 z-10">
    <!-- Left: Page Title/Breadcrumbs -->
    <div>
        <h2 class="text-2xl font-black text-brand-accent">{{ $header ?? 'Dashboard' }}</h2>
    </div>

    <!-- Center: Horizontal Navigation -->
    <nav
        class="hidden lg:flex items-center space-x-2 bg-white/20 dark:bg-black/40 backdrop-blur-xl p-1.5 rounded-pill border border-white/30 dark:border-white/10 shadow-sm">
        <a href="{{ route('dashboard') }}"
            class="px-8 py-2.5 text-sm font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-[#004499] text-white shadow-xl scale-105 rounded-pill' : 'text-black/80 dark:text-white/60 hover:text-black dark:hover:text-white' }}">Overview</a>
        <a href="{{ route('employees.index') }}"
            class="px-8 py-2.5 text-sm font-bold transition-all {{ request()->routeIs('employees.*') ? 'bg-[#004499] text-white shadow-xl scale-105 rounded-pill' : 'text-black/80 dark:text-white/60 hover:text-black dark:hover:text-white' }}">Team</a>
        <a href="{{ route('attendance.index') }}"
            class="px-8 py-2.5 text-sm font-bold transition-all {{ request()->routeIs('attendance.*') ? 'bg-[#004499] text-white shadow-xl scale-105 rounded-pill' : 'text-black/80 dark:text-white/60 hover:text-black dark:hover:text-white' }}">Attendance</a>
        <a href="{{ route('announcements.index') }}"
            class="px-8 py-2.5 text-sm font-bold transition-all {{ request()->routeIs('announcements.*') ? 'bg-[#004499] text-white shadow-xl scale-105 rounded-pill' : 'text-black/80 dark:text-white/60 hover:text-black dark:hover:text-white' }}">Feed</a>
        <a href="{{ route('payroll.index') }}"
            class="px-8 py-2.5 text-sm font-bold transition-all {{ request()->routeIs('payroll.*') ? 'bg-[#004499] text-white shadow-xl scale-105 rounded-pill' : 'text-black/80 dark:text-white/60 hover:text-black dark:hover:text-white' }}">Payroll</a>
    </nav>

    <!-- Right: Action Widgets -->
    <div class="flex items-center space-x-4">
        <!-- Theme Toggle -->
        <button id="themeToggle"
            class="w-10 h-10 flex items-center justify-center bg-white/60 dark:bg-black/40 backdrop-blur rounded-full hover:shadow-md transition-all text-gray-500 dark:text-white/50">
            <svg id="themeToggleDarkIcon" class="hidden w-5 h-5 pointer-events-none" fill="currentColor"
                viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="themeToggleLightIcon" class="hidden w-5 h-5 pointer-events-none" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                    fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- Search Bubble -->
        <button
            class="w-10 h-10 flex items-center justify-center bg-white/60 dark:bg-black/40 backdrop-blur rounded-full hover:shadow-md transition-all">
            <svg class="w-5 h-5 text-gray-500 dark:text-white/50" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>

        <!-- Message Bubble -->
        <button
            class="w-10 h-10 flex items-center justify-center bg-white/60 dark:bg-black/40 backdrop-blur rounded-full hover:shadow-md transition-all relative">
            <svg class="w-5 h-5 text-gray-500 dark:text-white/50" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 10-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                </path>
            </svg>
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- User Profile -->
        <div
            class="flex items-center bg-white/60 dark:bg-black/40 backdrop-blur p-1 rounded-pill shadow-sm border border-white/50 dark:border-white/10">
            <div
                class="w-8 h-8 rounded-full bg-[#004499] flex items-center justify-center text-white text-xs font-black uppercase border border-white/20 shadow-sm">
                @php
                    $nameParts = explode(' ', Auth::user()->name);
                    echo substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '');
                @endphp
            </div>
            <div class="hidden md:block px-3">
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 leading-none">
                    @role('Super Admin')
                        Super Admin
                    @else
                        Employee
                    @endrole
                </p>
                <p class="text-xs font-bold text-brand-accent dark:text-white">{{ Auth::user()->name }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mr-2">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>
