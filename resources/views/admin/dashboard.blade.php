@extends('layouts.admin')

@section('navigation')
    <x-navigation :admin="$admin"></x-navigation>
@endsection
@section('sidebar')
    <x-sidebar :admin="$admin"></x-sidebar>
@endsection
