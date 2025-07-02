@props(['is_active' => false, 'label', 'icon' => null])

@php
    $baseClasses =
        'group flex items-center px-4 py-3 text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-200 cursor-pointer';
    $activeClasses = $is_active ? 'bg-blue-100 text-blue-600' : '';
@endphp

<div x-data="{ open: {{ $is_active ? 'true' : 'false' }} }">
    <div @click="open = !open" class="{{ $baseClasses }} {{ $activeClasses }}">
        <span class="text-xl ml-3">
            {!! $icon !!}
        </span>
        <span class="font-medium flex-1">{{ $label }}</span>
        <svg x-bind:class="{ 'rotate-90': open }" class="h-4 w-4 transform transition-transform" viewBox="0 0 24 24"
            fill="none" stroke="currentColor">
            <path d="M6 9l6 6 6-6" />
        </svg>
    </div>
    <div x-show="open" class="pl-12 mt-1 space-y-1" x-transition>
        {{ $slot }}
    </div>
</div>
