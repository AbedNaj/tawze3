@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">


        <x-button icon="plus" wire:navigate lg href="{{ route('admin.products.product-entry-method') }}"
            :label="__('product.add_new')"></x-button>

    </section>
    <div class="px-2 py-4 space-x-2">
        @livewire('admin.filters.product-filters')

    </div>

    <livewire:admin.common.table model="App\Models\Tenants\Product" :columns="[
        ['field' => 'name', 'label' => __('product.name')],
        ['field' => 'productType.name', 'label' => __('product.product_type')],
        ['field' => 'price', 'label' => __('product.price')],
    ]" :title="__('product.title')"
        detailsRouteName="admin.products.show" />
@endsection
