@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">

        <x-admin.button href="{{ route('admin.customers.create') }}">{{ __('customer.add') }}</x-admin.button>

    </section>

    <livewire:admin.common.table model="App\Models\Tenants\Customer" :columns="[
        ['field' => 'name', 'label' => __('customer.name')],
        ['field' => 'phone', 'label' => __('customer.phone')],
        ['field' => 'location.name', 'label' => __('customer.city')],
    ]" :title="__('customer.title')" :allowSearch="true"
        detailsRouteName="admin.customers.show" />
@endsection
