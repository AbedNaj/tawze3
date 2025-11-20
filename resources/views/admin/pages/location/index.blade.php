@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">

        <x-admin.button href="{{ route('admin.locations.create') }}">{{ __('location.add') }}</x-admin.button>
    </section>

    <livewire:admin.common.table listener="added" model="App\Models\Tenants\Location" :columns="[['field' => 'name', 'label' => __('location.name')]]" :title="__('location.title')"
        detailsRouteName="admin.locations.show" />
@endsection
