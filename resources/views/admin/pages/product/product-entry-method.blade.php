@extends('admin.layout.default')

@section('content')
    <div x-data="{ withQR: false, QrScan: false }">

        <div x-show="!withQR && !QrScan">

            <x-admin.form.template :title="__('product.select_enter_type')">
                <section class="space-y-6 justify-center items-center flex flex-col">
                    <x-admin.button href="{{ route('admin.products.create') }}">
                        {{ __('product.without_qr') }}
                    </x-admin.button>

                    <x-admin.buttons.default click="withQR = true">
                        {{ __('product.with_qr') }}</x-admin.buttons.default>
                </section>
            </x-admin.form.template>
        </div>
        <div x-show="withQR" x-cloak>
            <x-admin.form.template :title="__('product.choose_qr_method')">
                <section class="space-y-6 justify-center items-center flex flex-col">
                    <x-admin.button href="">
                        {{ __('product.scan_with_camera') }}
                    </x-admin.button>

                    <x-admin.buttons.default click="QrScan = true , withQR = false ">
                        {{ __('product.scan_with_external') }}
                    </x-admin.buttons.default>

                    <x-admin.buttons.default click="withQR = false">
                        {{ __('product.go_back') }}</x-admin.buttons.default>
                </section>
            </x-admin.form.template>
        </div>


        <div x-show="QrScan" x-cloak>

            <x-admin.form.template :title="__('product.scan_with_external')">


                <section class="space-y-6 justify-center items-center flex flex-col">
                    <form method = "get" action="{{ route('admin.products.create') }}" class="space-y-6">
                        <x-admin.form.input name="qr_code" label="{{ __('product.scan_please') }}"></x-admin.form.input>
                    </form>
                    <x-admin.buttons.default click="QrScan = false ,  withQR = true">
                        {{ __('product.go_back') }}</x-admin.buttons.default>
                </section>

            </x-admin.form.template>
        </div>
    </div>
@endsection
