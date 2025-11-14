@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6">

        <div x-show="!editing">
            <div class="bg-white p-6 rounded-lg shadow relative">


                <div class="absolute top-4 left-4">
                    <form action="{{ route('admin.customers.delete', ['customer' => $customer->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-admin.buttons.delete />
                    </form>
                </div>


                <h2 class="text-lg font-semibold mb-4">{{ __('customer.the_customer') }} - {{ $customer->name }}</h2>

                <dl class="space-y-2">
                    <x-admin.read-only-field :label="__('customer.name')" :value="$customer->name" />
                    <x-admin.read-only-field :label="__('customer.phone')" :value="$customer->phone" />
                    <x-admin.read-only-field :label="__('customer.city')" :value="$customer->location->name" />
                    <x-admin.read-only-field :label="__('customer.address')" :value="$customer->address" />

                </dl>

                <x-admin.buttons.edit click="editing = true" />

            </div>
        </div>




        <div x-show="editing" x-cloak>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">{{ __('location.edit_data') }}</h2>

                <form action="{{ route('admin.customers.update', ['customer' => $customer->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.input name="name" :label="__('customer.name')" :value="$customer->name" />
                    <x-admin.form.input name="phone" :label="__('customer.phone')" :value="$customer->phone" />
                    <x-admin.form.select name="location_id" :label="__('customer.location')" :value="$customer->location_id" :options="$locations" />

                    <x-admin.form.input name="address" :label="__('customer.address')" :value="$customer->address" />
                    <div class="flex items-center gap-4">

                        <x-admin.form.button>{{ __('inventory.save') }}</x-admin.form.button>

                        <x-admin.buttons.cancel click="editing = false"></x-admin.buttons.cancel>


                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
