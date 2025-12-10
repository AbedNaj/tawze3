@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6">

        <div x-show="!editing">
            <div class="bg-white p-6 rounded-lg shadow relative">

                <div class="absolute top-4 left-4">
                    <x-common.delete-modal :route="route('admin.ware-houses.destroy', ['ware_house' => $wareHouse->id])" />
                </div>

                <h2 class="text-lg font-semibold mb-4">
                    {{ __('product.prodtct_type') . ' - ' . $wareHouse->name }}
                </h2>

                <dl class="space-y-2">
                    <x-input :label="__('warehouse.name')" :value="$wareHouse->name" disabled />

                    <x-input :label="__('warehouse.location')" :value="$wareHouse->location_name" disabled />
                    <x-input :label="__('warehouse.address')" :value="$wareHouse->address" disabled />
                </dl>

                <x-button class="mt-2" @click="editing = true" :label="__('common.edit')" />

            </div>
        </div>

        <div x-show="editing" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">{{ __('common.edit') }}</h2>

                <form action="{{ route('admin.ware-houses.update', [$wareHouse->id]) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <x-input name="name" :label="__('warehouse.name')" :value="$wareHouse->name" />

                    <x-select name="location" :value="$wareHouse->location->id ?? null" :label="__('warehouse.location')" :async-data="route('api.v1.locations')" option-label="name"
                        option-value="id" />

                    <x-input name="address" :label="__('warehouse.address')" :value="$wareHouse->address" />
                    <div class="flex items-center gap-4">
                        <x-button primary type="submit" :label="__('inventory.save')" />
                        <x-button type="button" @click="editing = false" :label="__('common.cancel')" />
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
