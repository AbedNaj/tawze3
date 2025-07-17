@props(['href' => '', 'span' => ''])

<a wire:navigate href="{{ $href }}"
    class="relative inline-flex items-center justify-center px-6 py-3 overflow-hidden font-medium rounded-xl group shadow-md hover:shadow-lg transition-all duration-300">

    <span
        class="absolute inset-0 w-full h-full transition-all duration-300 ease-in-out bg-gradient-to-r from-blue-500 to-indigo-600 group-hover:from-blue-600 group-hover:to-indigo-700"></span>


    <span
        class="absolute top-0 left-0 w-8 h-full -ml-12 bg-white/30 transform -skew-x-12 transition-all duration-700 ease-in-out group-hover:translate-x-72"></span>

    <span class="relative flex items-center w-full text-white font-medium tracking-wide">
        <span class="ml-2">{{ $span }}</span>
        {{ $slot }}
    </span>
</a>
