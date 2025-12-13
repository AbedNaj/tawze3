@extends('admin.layout.default')

@section('content')
    @livewire('admin.pages.ware-house.ware-house-show', ['wareHouse' => $wareHouse])
@endsection
