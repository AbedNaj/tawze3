@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false, restock: false }" class="space-y-6 max-w-3xl mx-auto">

        <div x-show="!editing && !restock" class="bg-white p-6 rounded-lg shadow-md border border-gray-100">


            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('inventory.employee') }}: {{ $employeeInventory->employee->name }}
                </h2>
                <div class="flex space-x-2">

                </div>

            </div>

            <dl class="divide-y divide-gray-200 text-gray-700">
                <div class="py-2 flex justify-between">
                    <dt class="font-medium">{{ __('inventory.product') }}</dt>
                    <dd>{{ $employeeInventory->product->name }}</dd>
                </div>

                <div class="py-2 flex justify-between">
                    <dt class="font-medium">{{ __('inventory.quantity') }}</dt>
                    <dd>{{ $employeeInventory->quantity }}</dd>
                </div>


            </dl>

            <div class="mt-6 flex gap-4">

                @php
                    $query = http_build_query([
                        'product' => $employeeInventory->product_id,
                        'product-type' => $employeeInventory->product->product_type_id,
                        'employee' => $employeeInventory->employee_id,
                    ]);
                @endphp
                <x-admin.button href="{!! route('admin.inventory.transfer') . '?' . $query !!}">
                    {{ __('inventory.restock') }}
                </x-admin.button>


            </div>

        </div>


    </div>
@endsection
