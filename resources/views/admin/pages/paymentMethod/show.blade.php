@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6">

        <div x-show="!editing">
            <div class="bg-white p-6 rounded-lg shadow relative">

                <div class="absolute top-4 left-4">


                    <x-common.delete-modal :route="route('admin.paymentMethods.delete', [$PaymentMethod->id])"></x-common.delete-modal>
                </div>

                <h2 class="text-lg font-semibold mb-4">{{ __('sale.payment_method.name') }}</h2>

                <dl class="space-y-2">

                    <x-input name="name" :label="__('sale.payment_method.name')" :value="$PaymentMethod->name" disabled />
                </dl>

                <x-button class="mt-2" :label="__('common.edit')" @click="editing = true" />

            </div>
        </div>

        <div x-show="editing" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">{{ __('location.edit_data') }}</h2>

                <form action="{{ route('admin.paymentMethods.update', [$PaymentMethod->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-input name="name" :label="__('sale.payment_method.name')" :value="$PaymentMethod->name" />

                    <div class="flex items-center gap-4">
                        <x-button primary type="submit" :label="__('inventory.save')" />

                        <x-button type="button" @click="editing = false" :label="__('common.cancel')" />
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
