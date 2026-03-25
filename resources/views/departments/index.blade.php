<x-app-layout>
    <x-slot name="header">
        Organizational Units
    </x-slot>

    <div class="space-y-10 pb-10">
        <!-- Dashboard / Action row -->
        <div class="flex justify-between items-center">
            <div
                class="flex items-center space-x-2 bg-white/40 backdrop-blur p-1 rounded-pill border border-white/50 shadow-sm">
                <button
                    class="px-6 py-2 active-bubble text-[10px] font-black uppercase tracking-widest shadow-lg">Functional
                    Mapping</button>
            </div>

            <a href="{{ route('departments.create') }}"
                class="px-6 py-2.5 rounded-xl bg-[#004499] text-white font-black tracking-widest transition-all flex items-center justify-center space-x-2 uppercase transform hover:scale-105 active:scale-95 shadow-lg shadow-blue-900/10 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Instantiate Unit</span>
            </a>
        </div>

        <!-- Units Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($departments as $department)
                <div
                    class="glass-card p-10 flex flex-col group cursor-pointer hover:bg-white/80 transition-all duration-500">
                    <div class="flex justify-between items-start mb-10">
                        <div
                            class="w-16 h-16 rounded-3xl bg-brand-muted flex items-center justify-center text-brand-accent group-hover:active-bubble transition-all duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('departments.edit', $department) }}"
                                class="p-2 text-gray-400 hover:text-brand-accent"><svg class="w-5 h-5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg></a>
                            <form action="{{ route('departments.destroy', $department) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-rose-500"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg></button>
                            </form>
                        </div>
                    </div>

                    <h4 class="text-2xl font-black mb-2 tracking-tighter">{{ $department->name }}</h4>
                    <p class="text-[10px] font-black uppercase text-gray-300 tracking-[0.2em] mb-10">Functional Hub</p>

                    <div class="mt-auto pt-8 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex -space-x-2 mr-3">
                                @for ($i = 0; $i < min(3, $department->employees_count); $i++)
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-200"></div>
                                @endfor
                            </div>
                            <span class="text-xs font-bold text-gray-500">{{ $department->employees_count }}
                                Members</span>
                        </div>
                        <div class="flex items-center text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            Manager: <span
                                class="text-brand-accent ml-2">{{ $department->manager->name ?? 'None' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
