@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('sale.payment_method.add')">

        <form method="post" action="{{ route('admin.paymentMethods.store') }}" class="space-y-6">
            @csrf
            @method('POST')


            <x-input name="name" :label="__('sale.payment_method.name')" />

            <div>
                <x-button type="submit" :label="__('employee.add_new')">

                </x-button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
