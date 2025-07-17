@props(['name' => 'name', 'type' => 'text', 'label' => '', 'value' => ''])
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <input wire:model='{{ $name }}' autocomplete="off" type="{{ $type }}" name="{{ $name }}"
        value="{{ $value }}"
        class="w-full py-1 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" />
    {{ $slot }}
    @error($name)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror

</div>
