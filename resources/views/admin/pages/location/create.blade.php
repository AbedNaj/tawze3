@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('location.add')">

        <form method="post" action="{{ route('admin.locations.store') }}" class="space-y-6">
            @csrf
            @method('POST')

            <x-input name="name" :label="__('location.name')" />

            <div>
                <x-button type="submit" :label="__('employee.add_new')" />
            </div>
        </form>

    </x-admin.form.template>
@endsection
