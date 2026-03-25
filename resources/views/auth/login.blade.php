<x-guest-layout>
    <div class="h-screen w-full flex overflow-hidden">
        <!-- Left Side: Branding/Visual (60% Width) -->
        <div class="hidden lg:flex lg:w-[60%] relative bg-[#004499] justify-center items-center overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10s] hover:scale-110"
                style="background-image: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); opacity: 0.5;">
            </div>

            <!-- Decorative Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/20"></div>

            <div class="relative z-10 px-24 text-left w-full h-full flex flex-col justify-center">
                <div class="mb-12">
                    <img src="{{ asset('images/hrmgo-logo-Icon-white.png') }}" alt="HRM GO Logo"
                        class="w-20 h-20 object-contain drop-shadow-2xl">
                </div>
                <h1 class="text-7xl font-black tracking-tighter mb-4 text-white leading-tight">HRM<span
                        class="text-white/40">GO</span></h1>
                <p class="text-2xl text-white/70 mb-12 max-w-md font-medium tracking-tight">Elevating human capital
                    management with state-of-the-art design and seamless intelligence.</p>

                <div class="flex gap-4">
                    <div class="h-1 w-12 bg-white/40 rounded-full"></div>
                    <div class="h-1 w-4 bg-white/20 rounded-full"></div>
                    <div class="h-1 w-4 bg-white/20 rounded-full"></div>
                </div>
            </div>

            <!-- Version Tag -->
            <div class="absolute bottom-10 left-24 text-white/20 text-[10px] font-black uppercase tracking-[0.5em]">
                Platform v2.4.0
            </div>
        </div>

        <!-- Right Side: Login Form Area (40% Width) -->
        <div class="w-full lg:w-[40%] flex items-center justify-center p-8 lg:p-12 bg-white relative overflow-hidden">
            <!-- Subtle Mesh Background for Depth -->
            <div class="absolute inset-0 opacity-[0.15] pointer-events-none"
                style="background-image: radial-gradient(at 100% 0%, #b1bfda 0, transparent 50%), radial-gradient(at 0% 100%, #c7cddb 0, transparent 50%);">
            </div>

            <div class="w-full max-w-md space-y-12 relative z-10">
                <div class="text-left">
                    <h2 class="text-5xl font-black tracking-tight text-gray-900 leading-tight">Login</h2>
                    <p class="mt-4 text-lg text-gray-500 font-medium leading-relaxed">Enter your organizational
                        credentials to access your workspace.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-8">
                    @csrf

                    <div class="space-y-8">
                        <!-- Email Address -->
                        <div>
                            <label for="email"
                                class="block text-sm font-black uppercase tracking-[0.1em] text-black mb-2">Professional
                                Email</label>
                            <div class="relative group">
                                <input id="email" name="email" type="email" autocomplete="username" required
                                    class="block w-full px-8 py-5 bg-gray-50 border-2 border-[#d1d1d1] hover:border-gray-400 focus:bg-white focus:border-black focus:ring-0 rounded-3xl shadow-sm text-gray-900 transition-all duration-300 placeholder:text-gray-200 font-bold"
                                    value="{{ old('email') }}" placeholder="name@company.com">
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-8 opacity-30 group-focus-within:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-bold" />
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password"
                                    class="block text-sm font-black uppercase tracking-[0.1em] text-black">Security
                                    Key</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-xs font-black text-black hover:underline transition-all uppercase tracking-widest">Forgot
                                        Key?</a>
                                @endif
                            </div>
                            <div class="relative group">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="block w-full px-8 py-5 bg-gray-50 border-2 border-[#d1d1d1] hover:border-gray-400 focus:bg-white focus:border-black focus:ring-0 rounded-3xl shadow-sm text-gray-900 transition-all duration-300 placeholder:text-gray-200 font-bold"
                                    placeholder="••••••••">
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-8 opacity-30 group-focus-within:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-bold" />
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer group">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 bg-gray-50 border-gray-200 rounded-md text-black focus:ring-0 focus:ring-offset-0 transition-all cursor-pointer">
                            <span
                                class="ml-4 text-xs font-black text-black group-hover:underline transition-all uppercase tracking-[0.1em]">Keep
                                me authenticated</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-6 px-8 border border-transparent rounded-3xl shadow-2xl text-sm font-black text-white bg-[#004499] hover:bg-[#003377] focus:outline-none focus:ring-4 focus:ring-blue-100 active:scale-[0.98] transition-all duration-300 uppercase tracking-[0.2em]">
                            Enter HR Workspace
                        </button>
                    </div>
                </form>

                <!-- Footer Attribution -->
                <div class="mt-12 text-center space-y-1">
                    <p class="text-[9px] font-black uppercase tracking-[0.4em] text-black">Powered by:</p>
                    <p class="text-[11px] font-black uppercase tracking-[0.15em] text-black">TOONZ MEDIA GROUP</p>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
