@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
        <x-admin.button href="{{ route('admin.employees.create') }}">{{ __('employee.add') }}</x-admin.button>

    </section>

    <livewire:admin.common.table listener="added" :with="['user']" model="App\Models\Tenants\Employee" :columns="[
        ['field' => 'name', 'label' => __('employee.name')],
        ['field' => 'phone', 'label' => __('employee.phone')],
        ['field' => 'user.user_name', 'label' => __('employee.user_name')],
    ]"
        :title="__('employee.title')" :allowSearch="false" detailsRouteName="admin.employees.show" />
@endsection
