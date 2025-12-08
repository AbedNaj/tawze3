@extends('admin.layout.default')

@section('content')
    <section class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">



        <x-button icon="plus" wire:navigate lg href="{{ route('admin.locations.create') }}" :label="__('location.add')"></x-button>
    </section>

    <livewire:admin.common.table listener="added" model="App\Models\Tenants\Location" :columns="[['field' => 'name', 'label' => __('location.name')]]" :title="__('location.title')"
        detailsRouteName="admin.locations.show" />
@endsection
