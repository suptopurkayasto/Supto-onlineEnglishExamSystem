@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="h-100 d-flex justify-content-center align-items-center student-list-group-container">
            <div class="list-group w-25 shadow text-center">
                @if($authStudent->marks()->where('exam_id', $exam->id)->get()->first()->grammar === null)
                    <a href="{{ route('student.exam.grammar.questions', $exam->id) }}"
                       class="list-group-item list-group-item-action">Grammar</a>
                @endif
                @if($authStudent->marks()->where('exam_id', $exam->id)->get()->first()->synonym === null && $authStudent->marks()->where('exam_id', $exam->id)->get()->first()->definition === null)
                        <a href="{{ route('student.exam.vocabulary.questions', $exam->id) }}"
                           class="list-group-item list-group-item-action">Vocabulary</a>
                @endif
                <a href="{{ route('student.exam.reading.questions', $exam->id) }}" class="list-group-item list-group-item-action">Reading</a>
                <a href="#" class="list-group-item list-group-item-action">Writing</a>
            </div>
        </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
    </div><!-- /.container -->
@endsection
