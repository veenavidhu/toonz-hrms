<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-6">
            <!-- Current Password -->
            <div>
                <label for="update_password_current_password" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2 ml-1">Current Password</label>
                <input id="update_password_current_password" name="current_password" type="password" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all"
                    placeholder="••••••••" autocomplete="current-password" required>
                @error('current_password', 'updatePassword') 
                    <p class="mt-1 text-xs text-rose-600 font-medium ml-2">{{ $message }}</p> 
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="update_password_password" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2 ml-1">New Password</label>
                <input id="update_password_password" name="password" type="password" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all"
                    placeholder="••••••••" autocomplete="new-password" required>
                @error('password', 'updatePassword') 
                    <p class="mt-1 text-xs text-rose-600 font-medium ml-2">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="update_password_password_confirmation" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2 ml-1">Confirm New Password</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold placeholder:text-gray-300 outline-none focus:ring-2 focus:ring-[#004499]/20 focus:border-[#004499] transition-all"
                    placeholder="••••••••" autocomplete="new-password" required>
                @error('password_confirmation', 'updatePassword') 
                    <p class="mt-1 text-xs text-rose-600 font-medium ml-2">{{ $message }}</p> 
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Update Security
            </button>

            @if (session('status') === 'password-updated')
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
