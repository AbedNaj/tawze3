@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('product.add_new')">

        <form method="post" action="{{ route('admin.products.store') }}" class="space-y-6">
            @csrf
            @method('POST')


            <x-admin.form.input name="name" :label="__('product.name')" />



            <x-admin.form.select name="product_type_id" :label="__('product.product_type')" :options="$productTypes" :value="$product->product_type_id ?? ''" />

            <x-admin.form.input name="price" type="number" :label="__('product.price')" />
            <x-admin.form.input name="quantity" type="number" :label="__('product.quantity')" />
            <x-admin.form.input name="min_stock_alert" type="number" :label="__('product.min_stock_alert')" />
            <x-admin.form.input name="qr_code" value="{{ request()->input('qr_code') ?? '' }}" type="hidden" />
            <div>
                <x-admin.form.button>
                    إضافه
                </x-admin.form.button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
