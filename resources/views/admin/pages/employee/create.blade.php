@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('employee.add')">

        <form method="post" action="{{ route('admin.employees.store') }}" class="space-y-6">
            @csrf
            @method('POST')

            <x-input name="name" :label="__('employee.name')" />

            <div>
                <x-input name="user_name" :description="__('employee.user_name_description')" :label="__('employee.user_name')" />

            </div>

            <x-input name="phone" :label="__('employee.phone')" />

            <div>
                <x-button type="submit" :label="__('employee.add_new')" />
            </div>

        </form>

    </x-admin.form.template>
@endsection
