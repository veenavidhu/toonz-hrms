<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2 ml-1">Full Name <span class="text-rose-500">*</span></label>
                <input id="name" name="name" type="text" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name') 
                    <p class="mt-1 text-xs text-rose-600 font-medium ml-2">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2 ml-1">Email address <span class="text-rose-500">*</span></label>
                <input id="email" name="email" type="email" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all"
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email') 
                    <p class="mt-1 text-xs text-rose-600 font-medium ml-2">{{ $message }}</p> 
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-xs font-bold text-gray-800">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="text-blue-600 hover:underline">
                                {{ __('Re-send verification email.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Save Profile
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">{{ __('Updated Successfully') }}</span>
                </p>
            @endif
        </div>
    </form>
</section>
