@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('product.add_new_product_type')">

        <form method="post" action="{{ route('admin.product-types.store') }}" class="space-y-6">
            @csrf
            @method('POST')


            <x-input name="name" :label="__('product.product_type_name')" />






            <div>
                <x-button :label="__('common.add')" type="submit">
                </x-button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
