@extends('admin.layout.default')

@section('content')
    @livewire('admin.pages.customer.profile', ['customer' => $customer, 'locations' => $locations])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection
