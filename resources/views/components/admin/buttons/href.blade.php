@props(['href' => '', 'span' => '', 'click' => ''])

<a wire:navigate href="{{ $href }}"
    class="relative inline-flex items-center px-4 py-2.5 overflow-hidden text-sm font-medium rounded-xl group transition-all duration-300 shadow-sm hover:shadow-md">

    <span
        class="absolute inset-0 w-full h-full bg-blue-600 transition-all duration-300 ease-in-out group-hover:bg-blue-700"></span>


    <span
        class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-400 transition-all duration-500 ease-in-out group-hover:h-full group-hover:bg-blue-600/20 opacity-20"></span>


    <span class="relative flex items-center text-white">
        <span class="ml-2">{{ $span }}</span>
        {{ $slot }}
    </span>
</a>
