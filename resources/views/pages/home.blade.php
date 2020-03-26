@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <a class="btn btn-lg btn-primary animated pulse infinite" href="{{ route('student.login') }}">Student Login</a>
    </div><!-- /.d-flex justify-content-center align-items-center -->
@endsection
