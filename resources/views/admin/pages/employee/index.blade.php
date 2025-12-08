@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">

        <x-button icon="plus" wire:navigate lg :label="__('employee.add')" href="{{ route('admin.employees.create') }}" />

    </section>

    <livewire:admin.common.table listener="added" :with="['user']" model="App\Models\Tenants\Employee" :columns="[
        ['field' => 'name', 'label' => __('employee.name')],
        ['field' => 'phone', 'label' => __('employee.phone')],
        ['field' => 'user.email', 'label' => __('employee.user_name')],
    ]"
        :title="__('employee.title')" detailsRouteName="admin.employees.show" />
@endsection
