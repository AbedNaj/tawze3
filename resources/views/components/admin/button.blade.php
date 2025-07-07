    @props(['href' => '', 'span' => ''])

    <a wire:navigate href="{{ $href }}"
        class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium">
        <span class="ml-2">{{ $span }}</span>
        {{ $slot }}
    </a>
