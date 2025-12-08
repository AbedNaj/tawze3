@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6">


        <div x-show="!editing">
            <div class="bg-white p-6 rounded-lg shadow relative">

                <div class="absolute top-4 left-4">
                    <x-common.delete-modal :route="route('admin.product-types.delete', ['id' => $productType->id])" />
                </div>

                <h2 class="text-lg font-semibold mb-4">
                    {{ __('product.prodtct_type') . ' - ' . $productType->name }}
                </h2>

                <dl class="space-y-2">
                    <x-input :label="__('product.product_type_name')" :value="$productType->name" disabled />
                </dl>

                <x-button class="mt-2" @click="editing = true" :label="__('common.edit')" />

            </div>
        </div>

        <div x-show="editing" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">{{ __('common.edit') }}</h2>

                <form action="{{ route('admin.product-types.update', [$productType->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-input name="name" :label="__('product.product_type_name')" :value="$productType->name" />

                    <div class="flex items-center gap-4">
                        <x-button primary type="submit" :label="__('inventory.save')" />
                        <x-button type="button" @click="editing = false" :label="__('common.cancel')" />
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
