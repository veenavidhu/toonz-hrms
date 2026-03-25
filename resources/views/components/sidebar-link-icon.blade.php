<a href="{{ $href }}"
    class="sidebar-icon-link w-12 h-12 flex items-center justify-center transition-all duration-300 rounded-2xl group relative {{ $active ? 'active-bubble shadow-2xl scale-110' : 'text-white/70 hover:bg-white hover:text-[#004499]' }}">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
    </svg>
    <!-- Tooltip -->
    <span
        class="absolute left-16 px-3 py-1.5 bg-black text-white text-xs font-bold rounded-xl opacity-0 group-hover:opacity-100 transition-all transform scale-90 group-hover:scale-100 whitespace-nowrap z-50 pointer-events-none shadow-xl">
        {{ $label }}
    </span>
</a>
