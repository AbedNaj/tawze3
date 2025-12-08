@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">

        <x-button lg icon="plus" :label="__('customer.add')" href="{{ route('admin.customers.create') }}"></x-button>

    </section>

    <livewire:admin.common.table model="App\Models\Tenants\Customer" :columns="[
        ['field' => 'name', 'label' => __('customer.name')],
        ['field' => 'phone', 'label' => __('customer.phone')],
        ['field' => 'location.name', 'label' => __('customer.city')],
    ]" :title="__('customer.title')" :allowSearch="true"
        detailsRouteName="admin.customers.show" />
@endsection
