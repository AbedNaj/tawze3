@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
        <x-admin.button href="{{ route('admin.product-types.create') }}">إضافة نوع منتج جديد</x-admin.button>

    </section>

    <livewire:admin.common.table listener="added" model="App\Models\Tenants\ProductType" :columns="[['field' => 'name', 'label' => 'اسم نوع المنتج']]"
        title="
أنواع المنتجات " detailsRouteName="admin.product-types.show" />
@endsection
