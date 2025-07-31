     @props([
         'name' => 'select',
         'label' => 'select',
         'options' => [],
         'value' => '',
     ])
     <label class="block text-sm font-medium text-gray-700 mb-1">
         {{ $slot }}</label>
     <select wire:model.live="{{ $name }}" name="{{ $name }}"
         class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
         <option value="{{ $value }}">{{ $label }}</option>
         @foreach ($options as $key => $optionLabel)
             <option @selected($key == old($name, $value)) value="{{ $key }}">{{ $optionLabel }}</option>
         @endforeach
     </select>

     @error($name)
         <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
     @enderror
