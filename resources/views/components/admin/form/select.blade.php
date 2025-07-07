@props([
    'name' => 'select',
    'label' => '--',
    'options' => [],
    'value' => '',
])

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <select name="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full py-1 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm']) }}>
        <option value="">اختر...</option>
        @foreach ($options as $key => $text)
            <option value="{{ $key }}" @selected($key == old($name, $value))>{{ $text }}</option>
        @endforeach
    </select>

    {{ $slot }}

    @error($name)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
