@props(['label', 'value', 'icon', 'color'])

<div
    class="glass-card p-8 flex items-center justify-between group hover:bg-brand-accent hover:text-white transition-all duration-500 cursor-pointer">
    <div>
        <p class="text-[10px] font-black uppercase text-gray-400 group-hover:text-white/50 tracking-widest">
            {{ $label }}</p>
        <h3 class="text-4xl font-black mt-1">{{ $value }}</h3>
    </div>
    <div
        class="w-14 h-14 rounded-2xl flex items-center justify-center {{ $color }} text-white shadow-xl group-hover:scale-110 group-hover:rotate-12 transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
        </svg>
    </div>
</div>
