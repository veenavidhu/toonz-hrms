@props([
    'href' => '#',
    'icon',
    'label',
    'active' => false,
    'hasDropdown' => false,
])

<div class="w-full group">
    <a href="{{ $href }}"
        class="w-full flex flex-col items-center justify-center py-4 transition-all duration-300 relative {{ $active ? 'bg-white/10 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' }}">

        <!-- Icon -->
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}"></path>
        </svg>

        <!-- Label -->
        <span class="text-xs font-medium tracking-wide text-center px-1 leading-tight">{{ $label }}</span>
    </a>

    <!-- Flyout Full-Height Slideout Panel -->
    @if ($hasDropdown)
        <div
            class="fixed top-0 left-24 h-screen w-72 bg-white text-gray-800 shadow-2xl invisible opacity-0 -translate-x-4 group-hover:visible group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 z-50 border-r border-gray-100 overflow-y-auto">
            <div class="p-5">
                <!-- Header -->
                <div
                    class="font-black text-xl text-[#004499] tracking-tight border-b-2 border-gray-100 pb-4 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-[#004499]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}">
                        </path>
                    </svg>
                    {{ $label }}
                </div>

                <!-- Links (styled via slot wrapper) -->
                <div class="flex flex-col space-y-1.5">
                    {{ $slot }}
                </div>
            </div>
        </div>
    @endif
</div>
