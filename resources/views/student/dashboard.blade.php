@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('partials.student.navigation')

    <div class="student-main-section" style="margin-top: 100px">
        <div class="container">
            <div class="shadow rounded p-4">
                <div class="row">
                    <div class="col-12 col-md-5 mb-5 mb-md-0">
                        <img class="shadow rounded" style="width: 100%"
                             src="{{ Gravatar::get(auth()->guard('student')->user()->email) }}" alt="">
                    </div><!-- /.col-12 col-md-5 mb-5 mb-md-0 -->
                    <div class="col-12 col-md-7">
                        <h2 title="{{ auth()->guard('student')->user()->name }}" class="h2 float-left">{{ Str::limit(auth()->guard('student')->user()->name, 30) }}</h2>
                        @foreach($exams as $exam)
                            @if($exam->status === 'running')
                                <a href="{{ route('student.exam.subject', $exam->slug) }}"
                                   class="btn btn-primary float-right">Start Exam {{ $exam->name }}</a>
                            @endif
                        @endforeach
                        <span class="d-block w-100 bg-primary" style="height: 2px; clear: both"></span>
                    </div><!-- /.col-12 col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.shadow rounded p-4 -->
        </div><!-- /.container -->
    </div><!-- /.student-main-section -->

@endsection
