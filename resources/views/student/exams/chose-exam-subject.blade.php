@extends('layouts.app')

@section('title', 'Chose Exam Subject')

@section('content')
    @include('partials.student.navigation')

    <div class="container">
        <div class="middle-section" style="margin-top: 100px">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3">
                    <ul class="list-group shadow-sm">
                        @if($showGrammarQuestionLink)
                            <li class="list-group-item">
                                <a href="{{ route('student.show.grammar.quiz', [$exam->slug, 'grammar']) }}">Grammar</a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <a href="">Demo</a>
                        </li>
                        <li class="list-group-item">
                            <a href="">Demo</a>
                        </li>
                        <li class="list-group-item">
                            <a href="">Demo</a>
                        </li>
                        <li class="list-group-item">
                            <a href="">Demo</a>
                        </li>
                    </ul>
                </div><!-- /.col-12 col-md-6 offset-md-3 -->
            </div><!-- /.row -->
        </div><!-- /.middle-section -->
    </div><!-- /.container -->

@endsection
