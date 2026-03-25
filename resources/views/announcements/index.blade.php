<x-app-layout>
    <x-slot name="header">
        Corporate Knowledge Feed
    </x-slot>

    <div class="space-y-10 pb-10">
        <!-- New Stream Entry -->
        @hasanyrole('Super Admin|Admin|HR')
            <div class="glass-card p-10">
                <h3 class="text-xl font-black mb-8 tracking-tighter">Publish Insight</h3>
                <form action="{{ route('announcements.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Headline</label>
                        <input type="text" name="title"
                            class="w-full bg-brand-muted border-0 rounded-2xl p-4 text-sm font-bold focus:ring-2 focus:ring-brand-accent"
                            placeholder="What's breaking?">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Context /
                            Detail</label>
                        <textarea name="content" rows="4"
                            class="w-full bg-brand-muted border-0 rounded-2xl p-4 text-sm font-bold focus:ring-2 focus:ring-brand-accent"
                            placeholder="Provide depth to your insight..."></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-8 py-4 bg-[#004499] text-white rounded-2xl shadow-xl shadow-blue-200 flex items-center space-x-2 font-black uppercase tracking-widest text-[11px] transform hover:scale-105 hover:bg-[#003377] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span>Distribute to organization</span>
                        </button>
                    </div>
                </form>
            </div>
        @endrole

        <!-- Feedback Stream -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($announcements as $announcement)
                <div class="glass-card p-10 group relative overflow-hidden transition-all hover:bg-white/80">
                    <div class="absolute top-0 right-0 p-8">
                        <div class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">
                            {{ $announcement->created_at->format('M d, Y') }}</div>
                        <div class="text-[10px] font-bold text-gray-300 uppercase tracking-widest flex justify-end">
                            {{ $announcement->created_at->diffForHumans() }}</div>
                    </div>

                    <div class="flex flex-col h-full">
                        <div
                            class="w-14 h-14 rounded-2xl bg-brand-muted flex items-center justify-center text-brand-accent mb-8 group-hover:active-bubble transition-all duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                </path>
                            </svg>
                        </div>

                        <h4 class="text-xl font-black mb-4 tracking-tighter">{{ $announcement->title }}</h4>
                        <p class="text-sm font-bold text-gray-500 leading-relaxed mb-8 flex-1">
                            {{ $announcement->content }}
                        </p>

                        <div class="flex items-center justify-between pt-8 border-t border-gray-100">
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></span>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Active
                                    Insight</span>
                            </div>
                            @hasanyrole('Super Admin|Admin')
                                <form action="{{ route('announcements.destroy', $announcement) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-[10px] font-black text-gray-300 hover:text-red-500 uppercase tracking-widest transition-colors">Retract
                                        Insight</button>
                                </form>
                            @endrole
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
