@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6">

        <div x-show="!editing">
            <div class="bg-white p-6 rounded-lg shadow relative">

                <div class="absolute flex space-x-2 top-4 left-4">

                    <x-common.delete-modal :route="route('admin.products.delete', ['product' => $product->id])"></x-common.delete-modal>


                    <x-button href="{{ route('admin.inventory.show', ['inventory' => $product->inventory->id]) }}"
                        :label="__('product.show_inventory')" />
                </div>

                <h2 class="text-lg font-semibold mb-4">{{ $product->name }}</h2>

                <dl class="space-y-2">
                    <x-input :label="__('product.name')" :value="$product->name" disabled />
                    <x-input :label="__('product.product_type')" :value="$product->productType->name" disabled />
                    <x-input :label="__('product.price')" :value="$product->price" disabled />
                    <x-input :label="__('product.qr_code')" :value="$product->qr_code ?? __('product.no_qr_code')" disabled />
                </dl>

                <x-button class="mt-2" @click="editing = true" :label="__('common.edit')" />

            </div>
        </div>

        <div x-show="editing" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">{{ __('common.edit') }} </h2>

                <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-input name="name" :label="__('product.name')" :value="$product->name" />

                    <x-select name="product_type_id" :label="__('product.product_type')" :options="$productTypes" option-label="name"
                        option-value="id" :value="$product->productType->id" :placeholder="__('common.select')" />



                    <x-input name="price" :label="__('product.price')" :value="$product->price" type="number" />

                    <div class="flex items-center gap-4">
                        <x-button primary type="submit" :label="__('product.save')" />
                        <x-button type="button" @click="editing = false" :label="__('common.cancel')" />
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
