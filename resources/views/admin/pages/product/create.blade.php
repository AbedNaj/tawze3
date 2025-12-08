@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('product.add_new')">

        <form method="post" action="{{ route('admin.products.store') }}" class="space-y-6">
            @csrf
            @method('POST')

            <x-input name="name" :label="__('product.name')" />

            <x-select name="product_type_id" :label="__('product.product_type')" :options="$productTypes" option-label="name" option-value="id"
                :placeholder="__('common.select')" :value="$product->product_type_id ?? ''" />

            <x-input name="price" type="number" :label="__('product.price')" />

            <x-input name="quantity" type="number" :label="__('product.quantity')" />

            <x-input name="min_stock_alert" type="number" :label="__('product.min_stock_alert')" />

            <x-input name="qr_code" type="hidden" :value="request()->input('qr_code') ?? ''" />

            <div>
                <x-button primary type="submit" :label="__('product.add_new')" />
            </div>

        </form>
    </x-admin.form.template>
@endsection
