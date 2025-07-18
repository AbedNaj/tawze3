@extends('admin.layout.default')

@section('content')
    <div x-data="{ editing: false }" class="space-y-6">

        <div x-show="!editing">
            <div class="bg-white p-6 rounded-lg shadow relative">


                <div class="absolute top-4 left-4">
                    <form action="{{ route('admin.locations.delete', ['location' => $location->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-admin.buttons.delete />
                    </form>
                </div>


                <h2 class="text-lg font-semibold mb-4">{{ __('location.location') }}</h2>

                <dl class="space-y-2">
                    <x-admin.read-only-field :label="__('location.name')" :value="$location->name" />
                </dl>

                <x-admin.buttons.edit click="editing = true" />

            </div>
        </div>




        <div x-show="editing" x-cloak>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">{{ __('location.edit_data') }}</h2>

                <form action="{{ route('admin.locations.update', [$location->id]) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <x-admin.form.input name="name" :label="__('location.name')" :value="$location->name" />

                    <div class="flex items-center gap-4">

                        <x-admin.form.button>{{ __('inventory.save') }}</x-admin.form.button>

                        <x-admin.buttons.cancel click="editing = false"></x-admin.buttons.cancel>


                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
