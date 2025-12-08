@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false, password: false }" class="space-y-6">


        <div x-show="!editing && !password">
            <div class="bg-white p-6 rounded-lg shadow relative">

                <h2 class="text-lg font-semibold mb-4">
                    {{ __('employee.employee_account') }} - {{ $employeeUser->employee->name }}
                </h2>

                <dl class="space-y-2">
                    <x-input :label="__('employee.user_name')" :value="$employeeUser->email" disabled />
                </dl>
                <div class="my-2">
                    <x-button @click="editing = true" :label="__('common.edit')" />
                    <x-button @click="password = true" :label="__('employee.password_change')" />
                </div>
            </div>
        </div>


        <div x-show="editing" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">{{ __('common.edit') }}</h2>

                <form action="{{ route('admin.employeeUser.update', [$employeeUser->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-input name="user_name" :label="__('employee.user_name')" :value="$employeeUser->email" />

                    <div class="flex  items-center gap-4">
                        <x-button primary type="submit" :label="__('inventory.save')" />
                        <x-button type="button" @click="editing = false" :label="__('common.cancel')" />
                    </div>
                </form>
            </div>
        </div>

        <div x-show="password" x-cloak>
            <div class="bg-white p-6 rounded-lg shadow">

                <h2 class="text-lg font-semibold mb-4">
                    {{ __('employee.password_change') }} - {{ $employeeUser->employee->name }}
                </h2>

                <form action="{{ route('admin.employeeUser.update-password', [$employeeUser->id]) }}" method="POST"
                    class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-input type="password" name="password" :label="__('employee.new_password')" />

                    <div class="flex items-center gap-4">
                        <x-button primary type="submit" :label="__('inventory.save')" />
                        <x-button type="button" @click="password = false" :label="__('common.cancel')" />
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
