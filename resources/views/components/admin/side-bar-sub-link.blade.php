@props(['href' => '#', 'is_active' => false])

@php
    $classes = 'block text-sm px-4 py-2 text-slate-600 hover:text-blue-600 transition';
    $classes .= $is_active ? ' font-semibold text-blue-600' : '';
@endphp

<a x-cloak wire:navigate href="{{ $href }}" class="{{ $classes }}">
    {{ $slot }}
</a>
