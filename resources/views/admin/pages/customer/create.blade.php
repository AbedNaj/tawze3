@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('customer.add')">

        <form method="post" action="{{ route('admin.customers.store') }}" class="space-y-6">
            @csrf
            @method('POST')

            <x-admin.form.input name="name" :label="__('customer.name')" />

            <x-admin.form.input name="phone" :label="__('customer.phone')" />
            <x-admin.form.select name="location_id" :label="__('customer.city')" :options="$locations" />
            <x-admin.form.input name="address" :label="__('customer.address')" />

            <div>
                <x-admin.form.button>
                    {{ __('employee.add_new') }}
                </x-admin.form.button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
