@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('warehouse.add_warehouse')">

        <form method="post" action="{{ route('admin.ware-houses.store') }}" class="space-y-2">
            @csrf
            @method('POST')


            <x-input name="name" :label="__('warehouse.name')" />
            <x-select name="location" :label="__('warehouse.location')" :async-data="route('api.v1.locations')" option-label="name" option-value="id" />
            <x-input name="address" :label="__('warehouse.address')" />



            <div>
                <x-button :label="__('common.add')" type="submit">
                </x-button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
