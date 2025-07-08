@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">


    </section>

    <livewire:admin.common.table listener="added" model="App\Models\Tenants\Inventory" :columns="[
        ['field' => 'product.name', 'label' => __('product.name')],
        ['field' => 'quantity', 'label' => __('inventory.quantity')],
        ['field' => 'min_stock_alert', 'label' => __('inventory.min_stock_alert')],
        ['field' => 'last_restock_date', 'label' => __('inventory.last_restock_date')],
    ]" :title="__('inventory.title')"
        :allowSearch="false" detailsRouteName="admin.inventory.show" />
@endsection
