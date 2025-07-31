@extends('admin.layout.default')
@section('content')
    @livewire('admin.sale.sale-create', ['employees' => $employees, 'customers' => $customers, 'productTypes' => $productTypes])
@endsection
