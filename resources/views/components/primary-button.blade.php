<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#004499] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#003377] focus:bg-[#003377] active:bg-[#002255] focus:outline-none focus:ring-2 focus:ring-[#004499] focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm']) }}>
    {{ $slot }}
</button>
