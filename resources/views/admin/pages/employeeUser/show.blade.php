@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false, password: false }" class="space-y-6">

        <div x-show="!editing && !password">
            <div class="bg-white p-6 rounded-lg shadow relative">


                <div class="absolute top-4 left-4">

                </div>


                <h2 class="text-lg font-semibold mb-4">{{ __('employee.employee_account') }} -
                    {{ $employeeUser->employee->name }}</h2>

                <dl class="space-y-2">
                    <x-admin.read-only-field :label="__('employee.user_name')" :value="$employeeUser->email" />

                </dl>

                <x-admin.buttons.edit click="editing = true" />
                <x-admin.buttons.edit click="password = true" :text="__('employee.password_change')" />
            </div>
        </div>




        <div x-show="editing" x-cloak>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">تعديل البيانات</h2>

                <form action="{{ route('admin.employeeUser.update', [$employeeUser->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.input name="user_name" :label="__('employee.user_name')" :value="$employeeUser->email" />

                    <div class="flex items-center gap-4">

                        <x-admin.form.button>{{ __('inventory.save') }}</x-admin.form.button>

                        <x-admin.buttons.cancel click="editing = false"></x-admin.buttons.cancel>


                    </div>
                </form>

            </div>
        </div>
        <div x-show="password" x-cloak>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">{{ __('employee.password_change') }} -
                    {{ $employeeUser->employee->name }}</h2>

                <form action="{{ route('admin.employeeUser.update-password', [$employeeUser->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.input type="password" name="password" :label="__('employee.new_password')" />

                    <div class="flex items-center gap-4">

                        <x-admin.form.button>{{ __('inventory.save') }}</x-admin.form.button>

                        <x-admin.buttons.cancel click="password = false"></x-admin.buttons.cancel>


                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
