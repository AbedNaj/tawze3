@props([
    'name' => 'cardModal',
    'buttonColor' => 'primary',
    'buttonLabel' => 'button',
    'buttonIcon' => null,
    'buttomWireClick' => null,
    'size' => 'lg',
    'title' => 'Modal Title',
    'cancelLabel' => __('common.cancel'),
    'saveLabel' => __('common.save'),
    'saveHref' => null,
    'saveWireClick' => null,
])
<x-button wire:click='{{ $buttomWireClick }}' size="{{ $size }}" label="{{ $buttonLabel }}"
    icon="{{ $buttonIcon }}" x-on:click="$openModal('{{ $name }}')" color="{{ $buttonColor }}" />

<x-modal-card title="{{ $title }}" name="{{ $name }}">

    {{ $slot }}


    <x-slot name="footer" class="flex justify-between gap-x-4">


        <div class="flex gap-x-4">
            <x-button flat label="{{ $cancelLabel }}" x-on:click="close" />

            <x-button primary label="{{ $saveLabel }}" wire:click="{{ $saveWireClick }}" />
        </div>
    </x-slot>
</x-modal-card>
