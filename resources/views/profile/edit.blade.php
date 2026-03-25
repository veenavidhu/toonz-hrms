<x-app-layout>
    <x-slot name="header">
        Security & Profile
    </x-slot>

    <div class="px-6 pb-12 max-w-[1200px] mx-auto">
        <div class="space-y-10">
            <!-- Profile Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-black text-gray-800 tracking-tight">Account Parameters</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Manage your identity, security credentials, and account lifecycle.</p>
            </div>

            <!-- Profile Information -->
            <div class="glass-card overflow-hidden bg-white">
                <div class="p-10 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-black text-gray-800 tracking-tight flex items-center gap-2">
                            <div class="w-1.5 h-6 bg-[#004499] rounded-full"></div>
                            Profile Information
                        </h3>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Primary Account Identity</p>
                    </div>
                </div>
                <div class="p-10">
                    <div class="max-w-xl mx-auto md:mx-0">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="glass-card overflow-hidden bg-white">
                <div class="p-10 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-black text-gray-800 tracking-tight flex items-center gap-2">
                            <div class="w-1.5 h-6 bg-[#004499] rounded-full"></div>
                            Security Credentials
                        </h3>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Password Authentication</p>
                    </div>
                </div>
                <div class="p-10">
                    <div class="max-w-xl mx-auto md:mx-0">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account (Danger Zone) -->
            <div class="glass-card overflow-hidden bg-white border-rose-100/50">
                <div class="p-10 border-b border-rose-50 bg-rose-50/10 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-black text-rose-600 tracking-tight flex items-center gap-2">
                            <div class="w-1.5 h-6 bg-rose-500 rounded-full"></div>
                            Lifecycle Termination
                        </h3>
                        <p class="text-xs text-rose-400 font-bold uppercase tracking-widest mt-1">Danger Zone</p>
                    </div>
                </div>
                <div class="p-10">
                    <div class="max-w-xl mx-auto md:mx-0">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
