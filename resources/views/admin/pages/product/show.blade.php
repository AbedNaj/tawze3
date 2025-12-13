@extends('admin.layout.default')


@section('content')
    @livewire('admin.pages.product.product-show', ['product' => $product])
@endsection
