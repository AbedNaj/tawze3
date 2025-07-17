@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6">
        @php
            $query = http_build_query([
                'employee' => $employee->id,
            ]);
        @endphp
        <div x-show="!editing">
            <div class="bg-white p-6 rounded-lg shadow relative">


                <div class="absolute top-4 left-4">

                    <div class="flex space-x-2">
                        <form action="{{ route('admin.product-types.delete', ['id' => $employee->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <x-admin.buttons.delete />
                        </form>
                        <x-admin.buttons.href
                            href="{{ route('admin.inventory.transfer') . '?' . $query }}">{{ __('inventory.transfer') }}</x-admin.buttons.href>
                        <x-admin.buttons.href
                            href="{{ route('admin.employeeUser.show', ['employeeUser' => $employee->employee_user_id]) }}">{{ __('employee.employee_account') }}</x-admin.buttons.href>



                    </div>

                </div>


                <h2 class="text-lg font-semibold mb-4">{{ __('employee.employee') }} - {{ $employee->name }}</h2>

                <dl class="space-y-2">
                    <x-admin.read-only-field :label="__('employee.name')" :value="$employee->name" />
                    <x-admin.read-only-field :label="__('employee.phone')" :value="$employee->phone" />
                </dl>

                <x-admin.buttons.edit click="editing = true" />

            </div>
        </div>




        <div x-show="editing" x-cloak>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">تعديل البيانات</h2>

                <form action="{{ route('admin.employees.update', [$employee->id]) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.input name="name" :label="__('employee.name')" :value="$employee->name" />
                    <x-admin.form.input name="phone" :label="__('employee.phone')" :value="$employee->phone" />
                    <div class="flex items-center gap-4">

                        <x-admin.form.button>{{ __('inventory.save') }}</x-admin.form.button>

                        <x-admin.buttons.cancel click="editing = false"></x-admin.buttons.cancel>


                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
