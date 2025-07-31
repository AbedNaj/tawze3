@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('sale.payment_method.add')">

        <form method="post" action="{{ route('admin.paymentMethods.store') }}" class="space-y-6">
            @csrf
            @method('POST')


            <x-admin.form.input name="name" :label="__('sale.payment_method.name')" />

            <div>
                <x-admin.form.button>
                    {{ __('employee.add_new') }}
                </x-admin.form.button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
