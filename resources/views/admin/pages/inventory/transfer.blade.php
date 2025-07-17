@extends('admin.layout.default')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ __('inventory.transfer_to_employee') }}
            </h2>

        </div>

        @livewire('admin.pages.inventory.transfer-pick', [
            'employees' => $employees,
            'productTypes' => $productTypes,
        ])

    </div>
@endsection
