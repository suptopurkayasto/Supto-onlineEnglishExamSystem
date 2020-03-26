@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center shadow rounded timerContainer">
        <div class='timer' data-minutes-left="4"></div>
    </div><!-- /.d-flex justify-content-center align-items-center fixed shadow rounded -->


    <div class="container">
        <form action="" method="post">
            @php $index = 0 @endphp

            @foreach($grammarQuestions as $grammarQuestion)
                @if($questionSet->id === $grammarQuestion->set->id)
                    @php $index++ @endphp
                    <div class="form-group rounded shadow-sm p-4 bg-white">
                        <h4 class="h4 mb-3">{{ $index }}. {{ $grammarQuestion->question }}</h4>
                        <input type="hidden" name="question" value="{{ $grammarQuestion->question }}">

                        <div class="questions mt-5">
                            <div class="custom-control custom-radio">
                                @php $string = Str::random(16) @endphp
                                <input type="radio" id="{{ $string }}" name="answer_{{ $grammarQuestion->id }}"
                                       class="custom-control-input">
                                <label class="custom-control-label"
                                       for="{{ $string }}">{{ $grammarQuestion->option_1 }}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                @php $string = Str::random(16) @endphp
                                <input type="radio" id="{{ $string }}" name="answer_{{ $grammarQuestion->id }}"
                                       class="custom-control-input">
                                <label class="custom-control-label"
                                       for="{{ $string }}">{{ $grammarQuestion->option_2 }}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                @php $string = Str::random(16) @endphp
                                <input type="radio" id="{{ $string }}" name="answer_{{ $grammarQuestion->id }}"
                                       class="custom-control-input">
                                <label class="custom-control-label"
                                       for="{{ $string }}">{{ $grammarQuestion->option_3 }}</label>
                            </div>
                        </div><!-- /.questions -->

                    </div><!-- /.form-group -->
                @endif
            @endforeach
        </form>

    </div><!-- /.container --
@endsection

@section('extra-scripts')
    <script src="{{ asset('js/extra/jquery.simple.timer.js') }}"></script>
    <script>
        $(function () {
            $('.timer').startTimer({
                elementContainer: "span",
                onComplete: function (element) {
                    element.addClass('text-danger');
                },
            });
            $('.jst-hours').hide();
            if ($('.jst-minutes').html() === '04:') {
                console.log('ok');
            }
        });
    </script>
@endsection
