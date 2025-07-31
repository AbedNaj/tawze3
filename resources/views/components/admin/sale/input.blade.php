@props(['name' => 'name', 'type' => 'text', 'label' => '', 'value' => ''])
<label class="block text-sm font-medium text-gray-700 mb-1">
    {{ $label }}</label>
<input wire:model='{{ $name }}' autocomplete="off" type="{{ $type }}" name="{{ $name }}"
    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

@error($name)
    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
@enderror
