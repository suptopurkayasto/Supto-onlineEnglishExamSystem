@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="h-100 d-flex justify-content-center align-items-center student-list-group-container">
            <div class="list-group w-25 shadow text-center">
                <a href="{{ route('student.exam.grammar.questions', $exam->id) }}" class="list-group-item list-group-item-action">Grammar</a>
                <a href="#" class="list-group-item list-group-item-action">Vocabulary</a>
                <a href="#" class="list-group-item list-group-item-action">Reading</a>
                <a href="#" class="list-group-item list-group-item-action">Writing</a>
            </div>
        </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
    </div><!-- /.container -->
@endsection
