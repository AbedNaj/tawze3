@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6 max-w-3xl mx-auto">

        <div x-show="!editing" class="bg-white p-6 rounded-lg shadow-md border border-gray-100">


            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('inventory.the_product') }}: {{ $inventory->product->name }}
                </h2>
                <x-admin.button href="{{ route('admin.products.show', ['product' => $inventory->product_id]) }}">
                    {{ __('inventory.product_details') }}
                </x-admin.button>
            </div>

            <dl class="divide-y divide-gray-200 text-gray-700">
                <div class="py-2 flex justify-between">
                    <dt class="font-medium">{{ __('inventory.quantity') }}</dt>
                    <dd>{{ $inventory->quantity }}</dd>
                </div>

                <div class="py-2 flex justify-between">
                    <dt class="font-medium">{{ __('inventory.min_stock_alert') }}</dt>
                    <dd>{{ $inventory->min_stock_alert }}</dd>
                </div>

                <div class="py-2 flex justify-between">
                    <dt class="font-medium">{{ __('inventory.last_restock_date') }}</dt>
                    <dd>{{ $inventory->last_restock_date ?? __('inventory.not_available') }}</dd>
                </div>
            </dl>

            <div class="mt-6 flex gap-4">
                <x-admin.button href="">
                    {{ __('inventory.restock') }}
                </x-admin.button>

                <x-admin.button href="">
                    {{ __('inventory.assign_to_employee') }}
                </x-admin.button>

                <x-admin.buttons.default click="editing = true">{{ __('inventory.edit') }}</x-admin.buttons.default>
            </div>

        </div>

        <div x-show="editing" class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('inventory.edit_the_product') }}
                </h2>

            </div>

            <form class="space-y-2" action="{{ route('admin.inventory.update', ['inventory' => $inventory->id]) }}"
                method="POST">
                @method('PATCH')
                @csrf

                <x-admin.form.input name="min_stock_alert" :value="$inventory->min_stock_alert" :label="__('inventory.min_stock_alert')" />

                <div class="flex items-center gap-4">

                    <x-admin.form.button>حفظ</x-admin.form.button>

                    <x-admin.buttons.cancel click="editing = false"></x-admin.buttons.cancel>


                </div>
            </form>
        </div>
    </div>
@endsection
