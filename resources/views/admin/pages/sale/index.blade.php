@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">



        <x-button icon="plus" wire:navigate lg :label="__('sale.sale.add')" href="{{ route('admin.sales.create') }}" />

    </section>
    <div class="px-2 py-4 ">
        @livewire('admin.filters.sale-filters')

    </div>
    <livewire:admin.common.table :allowSearch="false" listener="added" model="App\Models\Tenants\Sale" :columns="[
        ['field' => 'invoice_date', 'label' => __('sale.sale.invoice_date')],
        ['field' => 'invoice_number', 'label' => __('sale.sale.invoice_number')],
        ['field' => 'employee.name', 'label' => __('sale.sale.employee_name')],
        ['field' => 'customer.name', 'label' => __('sale.sale.customer_name')],
        ['field' => 'user.name', 'label' => __('sale.sale.created_by')],
        ['field' => 'status', 'label' => __('sale.sale.status'), 'enum' => App\Enums\SaleStatusEnum::class],
        [
            'field' => 'payment_status',
            'label' => __('sale.sale.payment_status'),
            'enum' => App\Enums\SalePaymentStatusEnum::class,
        ],
    ]"
        :title="__('sale.sale.title')" detailsRouteName="admin.sales.show" />
@endsection
