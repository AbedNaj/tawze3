    @props(['href' => '', 'span' => '', 'click' => ''])

    <a wire:navigate href="{{ $href }}"
        class="inline-flex items-center px-4 py-2 hover:cursor-pointer bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
        <span class="ml-2">{{ $span }}</span>
        {{ $slot }}
    </a>
