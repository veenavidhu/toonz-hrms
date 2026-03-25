<x-app-layout>
    <x-slot name="header">
        Digital Identities
    </x-slot>

    <div class="space-y-8 pb-10">
        <div class="flex justify-between items-center">
            <div
                class="flex items-center space-x-2 bg-white/40 backdrop-blur p-1 rounded-pill border border-white/50 shadow-sm">
                <button class="px-6 py-2 active-bubble text-[10px] font-black uppercase tracking-widest shadow-lg">Access
                    Registry</button>
            </div>

            <a href="#"
                class="pill-button active-bubble shadow-xl flex items-center justify-center space-x-2 font-bold transform hover:scale-105 transition-all text-sm opacity-50 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <span>Authorize Unit</span>
            </a>
        </div>

        <div class="glass-card overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/20">
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Digital
                            Entity</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Logic Role
                        </th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            Verification</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                            Terminal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($users as $user)
                        <tr class="hover:bg-white/30 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=000&color=fff"
                                        class="w-10 h-10 rounded-pill border-2 border-white mr-4">
                                    <div>
                                        <p class="text-sm font-black text-brand-accent">{{ $user->name }}</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="px-2 py-0.5 bg-brand-accent text-white rounded-pill text-[8px] font-black uppercase tracking-widest">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span
                                    class="text-[10px] font-black text-gray-400 uppercase">{{ $user->created_at->format('M d, Y') }}</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('users.edit', $user) }}"
                                    class="pill-button bg-brand-muted text-[10px] font-black uppercase tracking-widest hover:active-bubble transition-all">
                                    Adjust Logic
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
