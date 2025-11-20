@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">


    </section>
    <div class="px-2 py-4 ">
        @livewire('admin.filters.inventoryilters')

    </div>
    <livewire:admin.common.table model="App\Models\Tenants\Inventory" :columns="[
        ['field' => 'product.name', 'label' => __('product.name')],
        ['field' => 'quantity', 'label' => __('inventory.quantity')],
        ['field' => 'min_stock_alert', 'label' => __('inventory.min_stock_alert')],
        ['field' => 'last_restock_date', 'label' => __('inventory.last_restock_date')],
        [
            'field' => 'status',
            'label' => __('inventory.inventory_status'),
            'enum' => App\Enums\InventoryStatusEnum::class,
        ],
    ]" :title="__('inventory.title')" :allowSearch="false"
        detailsRouteName="admin.inventory.show" />
@endsection
