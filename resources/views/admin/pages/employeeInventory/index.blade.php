@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
        <x-admin.button href="{{ route('admin.inventory.transfer') }}">
            {{ __('sidebar.admin.transfer_to_employee') }}</x-admin.button>

    </section>

    <livewire:admin.common.table :allowSearch="false" listener="added" :with="['product', 'employee']"
        model="App\Models\Tenants\EmployeeInventory" :columns="[
            ['field' => 'employee.name', 'label' => __('inventory.employee')],
            ['field' => 'product.name', 'label' => __('inventory.product')],
            ['field' => 'quantity', 'label' => __('inventory.quantity')],
        ]" :title="__('inventory.employees_inventory')"
        detailsRouteName="admin.employeeInventory.show" />
@endsection
