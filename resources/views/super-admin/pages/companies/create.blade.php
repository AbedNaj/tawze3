@extends('super-admin.layout.default')

@section('content')
    <x-super-admin.heading>
        إضافة شركة جديدة
    </x-super-admin.heading>


    <section class="px-6 py-6 mt-6 bg-white shadow-sm rounded-lg max-w-2xl mx-auto border border-gray-100">
        <form method="post" class="space-y-6">
            @csrf
            @method('POST')
            <x-super-admin.form.input name="name" label="اسم الشركه" />

            <x-super-admin.form.input name="tenant_id" label="معرّف الشركة (بالإنجليزية)">
                <p class="text-sm text-gray-500 mt-1">سيُستخدم في قاعدة البيانات والدومين الفرعي (مثلاً:
                    <code>company1.tawze3.test</code>).
                </p>
            </x-super-admin.form.input>


            <div>
                <x-super-admin.form.button>
                    إنشاء الشركة
                </x-super-admin.form.button>
            </div>
        </form>
    </section>
@endsection
