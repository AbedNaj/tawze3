@extends('admin.layout.default')

@section('content')
    <x-admin.form.template title="إضافة نوع منتج جديد">

        <form method="post" action="{{ route('admin.product-types.store') }}" class="space-y-6">
            @csrf
            @method('POST')


            <x-admin.form.input name="name" label="إسم نوع المنتج" />






            <div>
                <x-admin.form.button>
                    إضافه </x-admin.form.button>
            </div>
        </form>
    </x-admin.form.template>
@endsection
