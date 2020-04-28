@extends('layouts.app')

@section('title', 'Show Topic')

@section('content')
    <div class="container h-100">
        <div class="h-100 d-flex justify-content-center align-items-center student-list-group-container">
            <div class="list-group w-25 shadow text-center" id="show-topic-container">
                <?php
                $marks = $authStudent->marks()->where('exam_id', $exam->id)->get()->first();
                ?>
                @if($marks->grammar === null)
                    <a href="{{ route('student.exam.grammar.questions', encrypt($exam->id)) }}"
                       class="list-group-item border-primary list-group-item-action">Grammar</a>
                @endif
                @if($marks->synonym === null)
                    <a href="{{ route('student.exam.vocabulary.questions', encrypt($exam->id)) }}"
                       class="list-group-item border-primary list-group-item-action">Vocabulary</a>
                @endif
                @if($marks->heading === null)
                    <a href="{{ route('student.exam.reading.questions', encrypt($exam->id)) }}"
                       class="list-group-item border-primary list-group-item-action">Reading</a>
                @endif
                @if($marks->dialog === null)
                    <a href="{{ route('student.exam.writing.questions', encrypt($exam->id)) }}"
                       class="list-group-item border-primary list-group-item-action">Writing</a>
                @endif
            </div>
        </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
    </div><!-- /.container -->
@endsection

@section('extra-script')
    <script>

        var height = $(window).innerHeight();
        $('body').css({'height': height});
        $(document).ready(function () {
            function isEmpty( el ){
                return !$.trim(el.html())
            }
            if (isEmpty($('#show-topic-container'))) {
                window.location.replace("{{ route('student.dashboard') }}");
            }
        });
    </script>
@endsection
