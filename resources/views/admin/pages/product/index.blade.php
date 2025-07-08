@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
        <x-admin.button
            href="{{ route('admin.products.product-entry-method') }}">{{ __('product.add_new') }}</x-admin.button>

    </section>

    <livewire:admin.common.table listener="added" model="App\Models\Tenants\Product" :columns="[
        ['field' => 'name', 'label' => __('product.name')],
        ['field' => 'productType.name', 'label' => __('product.product_type')],
        ['field' => 'price', 'label' => __('product.price')],
    ]" :title="__('product.title')"
        :allowSearch="false" detailsRouteName="admin.products.show" />
@endsection
