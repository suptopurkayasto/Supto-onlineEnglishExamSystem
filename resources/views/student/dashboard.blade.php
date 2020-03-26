@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('partials.student.navigation')

    <div class="student-main-section" style="margin-top: 100px">
        <div class="container">
            <div class="shadow rounded p-4">
                <div class="row">
                    <div class="col-12 col-md-5 mb-5 mb-md-0">
                        <img class="shadow rounded" style="width: 100%" src="{{ Gravatar::get(auth()->guard('student')->user()->email) }}" alt="">
                    </div><!-- /.col-12 col-md-5 mb-5 mb-md-0 -->
                    <div class="col-12 col-md-7">
                        <h1 class="h1 float-left">{{ $student->name }}</h1>
                        <a href="" class="btn btn-primary float-right">Start Exam</a>
                        <span class="d-block w-100 bg-primary" style="height: 2px; clear: both"></span>
                    </div><!-- /.col-12 col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.shadow rounded p-4 -->
        </div><!-- /.container -->
    </div><!-- /.student-main-section -->

@endsection
