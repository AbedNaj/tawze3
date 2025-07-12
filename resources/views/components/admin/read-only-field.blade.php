@props(['label' => 'العنوان', 'value' => ''])

<div>
    <dt class="text-sm text-gray-500">{{ $label }} :</dt>
    <dd class="text-base text-gray-800">{{ $value ? $value : __('element.no_data') }}</dd>
</div>
