@extends('super-admin.layout.default')

@section('content')
    <x-super-admin.heading>
        الشركات
    </x-super-admin.heading>


    <livewire:common.table listener="categoryAdded" model="\App\Models\Tenant" :columns="[['field' => 'id', 'label' => 'اسم الشركه'], ['field' => 'domains.0.domain', 'label' => 'معرف الشركة']]" :with="['domains']"
        title="
الشركات المسجلة" :allowSearch="false" detailsRouteName="company.index" />
@endsection
