@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('customer.add')">

        <form method="post" action="{{ route('admin.customers.store') }}" class="space-y-6">
            @csrf
            @method('POST')

            <x-input name="name" :label="__('customer.name')" />

            <x-input name="phone" :label="__('customer.phone')" />

            <x-select name="location" :label="__('customer.city')" :async-data="route('api.v1.locations')" option-label="name" option-value="id" />

            <x-input name="address" :label="__('customer.address')" />

            <div>
                <x-button type="submit" :label="__('employee.add_new')" />
            </div>
        </form>

    </x-admin.form.template>
@endsection
