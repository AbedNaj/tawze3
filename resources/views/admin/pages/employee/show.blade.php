@extends('admin.layout.default')

@section('content')
    @livewire('admin.pages.employee.profile', ['employee' => $employee])
@endsection
