@extends('admin.layout.default')

@section('content')
    <x-admin.form.template :title="__('location.add')">

        <form method="post" action="{{ route('admin.locations.store') }}" class="space-y-6">
            @csrf
            @method('POST')


            <x-admin.form.input name="name" :label="__('location.name')" />

            <div>
                <x-admin.form.button>
                    {{ __('employee.add_new') }}
                </x-admin.form.button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
