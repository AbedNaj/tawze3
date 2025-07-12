@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('employee.add')">

        <form method="post" action="{{ route('admin.employees.store') }}" class="space-y-6">
            @csrf
            @method('POST')


            <x-admin.form.input name="name" :label="__('employee.name')" />


            <x-admin.form.input name="user_name" :label="__('employee.user_name')">
                <p class="text-sm text-gray-500 mt-1">

                    {{ __('employee.user_name_description') }}
                </p>
            </x-admin.form.input>

            <x-admin.form.input name="phone" :label="__('employee.phone')" />

            <div>
                <x-admin.form.button>
                    {{ __('employee.add_new') }}
                </x-admin.form.button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
