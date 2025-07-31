@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">

        <x-admin.button
            href="{{ route('admin.paymentMethods.create') }}">{{ __('sale.payment_method.add') }}</x-admin.button>
    </section>

    <livewire:admin.common.table listener="added" model="App\Models\Tenants\PaymentMethod" :columns="[['field' => 'name', 'label' => __('sale.payment_method.name')]]" :title="__('sale.payment_method.title')"
        detailsRouteName="admin.paymentMethods.show" />
@endsection
