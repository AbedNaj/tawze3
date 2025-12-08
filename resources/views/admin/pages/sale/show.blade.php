@extends('admin.layout.default')
@section('content')
    @livewire('admin.sale.sale-show', ['employees' => $employees, 'customers' => $customers, 'sale' => $sale])
@endsection
