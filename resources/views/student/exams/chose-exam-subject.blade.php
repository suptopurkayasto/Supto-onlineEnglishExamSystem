@extends('layouts.app')

@section('title', 'Chose Exam Subject')

@section('content')
    @include('partials.student.navigation')

    <div class="container">
        <div class="middle-section" style="margin-top: 100px">
            <ul>
                <li><a href="{{ route('student.show.grammar.quiz', [$exam->slug, 'grammar']) }}">Grammar</a></li>
            </ul>
        </div><!-- /.middle-section -->
    </div><!-- /.container -->

@endsection
