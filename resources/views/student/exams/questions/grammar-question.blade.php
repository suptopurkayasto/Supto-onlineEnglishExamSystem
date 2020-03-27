@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center shadow rounded timerContainer px-4 my-2">
        <div class='timer' data-minutes-left="1"></div>
    </div><!-- /.d-flex justify-content-center align-items-center fixed shadow rounded -->


    <div class="container">
        <form action="{{ route('student.grammar.quiz.submit', [$exam->slug, 'grammar']) }}" method="post" id="grammarFromSubmit">
            @csrf
            @php $index = 0 @endphp

            @foreach($grammarQuestions as $grammarQuestion)
                @if($authStudentQuestionSet->id === $grammarQuestion->set->id)
                    @php $index++ @endphp

                    <div class="form-group rounded shadow-sm p-4 bg-white">
                        <h4 class="h4 mb-3">{{ $index }}. {{ $grammarQuestion->question }}</h4>
                        <input type="hidden" name="question[]" value="{{ $grammarQuestion->id }}">

                        <div class="options mt-3">
                            <div class="custom-control custom-radio mb-2">
                                @php $string = Str::random(16) @endphp
                                <input type="radio" id="{{ $string }}" name="answer_{{ $grammarQuestion->id }}"
                                       class="custom-control-input" value="{{ $grammarQuestion->option_1 }}">
                                <label class="custom-control-label"
                                       for="{{ $string }}">{{ $grammarQuestion->option_1 }}</label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                @php $string = Str::random(16) @endphp
                                <input type="radio" id="{{ $string }}" name="answer_{{ $grammarQuestion->id }}"
                                       class="custom-control-input" value="{{ $grammarQuestion->option_2 }}">
                                <label class="custom-control-label"
                                       for="{{ $string }}">{{ $grammarQuestion->option_2 }}</label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                @php $string = Str::random(16) @endphp
                                <input type="radio" id="{{ $string }}" name="answer_{{ $grammarQuestion->id }}"
                                       class="custom-control-input" value="{{ $grammarQuestion->option_3 }}">
                                <label class="custom-control-label"
                                       for="{{ $string }}">{{ $grammarQuestion->option_3 }}</label>
                            </div>
                        </div><!-- /.options -->
                    </div><!-- /.form-group -->
                @endif
            @endforeach
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-lg">Finish Exam</button>
            </div><!-- /.form-group -->
        </form>

    </div><!-- /.container -->
@endsection

@section('extra-scripts')
    <script src="{{ asset('js/extra/jquery.simple.timer.js') }}"></script>
    <script>

        // $(document).on("keydown", function (e) {
        //     if (e.key == "F5" || e.key == "F11" ||
        //         (e.ctrlKey == true && (e.key == 'r' || e.key == 'R')) ||
        //         e.keyCode == 116 || e.keyCode == 82) {
        //         e.preventDefault();
        //     }
        // });
        //
        // window.onbeforeunload = function() {
        //     return "Leave this page ?";
        //     $('#grammarFromSubmit').submit();
        // };
        //



        $(function () {
            $('.timer').startTimer({
                elementContainer: "span",
                onComplete: function (element) {
                    $('#grammarFromSubmit').submit();
                },
            });
            $('.jst-hours').hide();
            if ($('.jst-minutes').html() === '01:') {
                $('.timer').addClass('text-danger');
            }
        });
    </script>
@endsection
