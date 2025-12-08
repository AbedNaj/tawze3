@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
        <x-button icon="plus" wire:navigate lg :label="__('product.add_new_product_type')" href="{{ route('admin.product-types.create') }}">
        </x-button>

    </section>

    <livewire:admin.common.table listener="added" model="App\Models\Tenants\ProductType" :columns="[['field' => 'name', 'label' => __('product.product_type_name')]]" :title="__('product.product_types')"
        detailsRouteName="admin.product-types.show" />
@endsection
