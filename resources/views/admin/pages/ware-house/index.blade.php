@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
        <x-button icon="plus" wire:navigate lg :label="__('warehouse.create_warehouse')" href="{{ route('admin.ware-houses.create') }}">
        </x-button>

    </section>

    <livewire:admin.common.table :with="['location']" listener="added" model="App\Models\Tenants\WareHouse" :columns="[
        ['field' => 'name', 'label' => __('warehouse.name')],
        ['field' => 'location.name', 'label' => __('warehouse.location')],
        ['field' => 'address', 'label' => __('warehouse.address')],
    ]"
        :title="__('warehouse.warehouses')" detailsRouteName="admin.ware-houses.show" />
@endsection
