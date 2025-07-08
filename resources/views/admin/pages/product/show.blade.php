@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6">

        <div x-show="!editing">
            <div class="bg-white p-6 rounded-lg shadow relative">


                <div class="absolute flex space-x-2 top-4 left-4">
                    <form action="{{ route('admin.products.delete', ['product' => $product->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-admin.buttons.delete />
                    </form>


                    <a wire:navigate href="{{ route('admin.inventory.show', ['inventory' => $product->inventory->id]) }}"
                        class=" inline-flex items-center px-4 py-2 hover:cursor-pointer bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                        {{ __('product.show_inventory') }}
                    </a>
                </div>


                <h2 class="text-lg font-semibold mb-4">{{ $product->name }}</h2>

                <dl class="space-y-2">
                    <x-admin.read-only-field :label="__('product.name')" :value="$product->name" />
                    <x-admin.read-only-field :label="__('product.product_type')" :value="$product->productType->name" />
                    <x-admin.read-only-field :label="__('product.price')" :value="$product->price" />
                    <x-admin.read-only-field :label="__('product.qr_code')" :value="$product->qr_code ?? __('product.no_qr_code')" />
                </dl>

                <x-admin.buttons.edit click="editing = true" />

            </div>
        </div>




        <div x-show="editing" x-cloak>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">تعديل البيانات</h2>

                <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.input name="name" :label="__('product.name')" :value="$product->name" />
                    <x-admin.form.select name="product_type_id" :label="__('product.product_type')" :options="$productTypes" :value="$product->productType->id" />
                    <x-admin.form.input name="price" :label="__('product.price')" :value="$product->price" />

                    <div class="flex items-center gap-4">

                        <x-admin.form.button>{{ __('product.save') }}</x-admin.form.button>

                        <x-admin.buttons.cancel click="editing = false"></x-admin.buttons.cancel>


                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
