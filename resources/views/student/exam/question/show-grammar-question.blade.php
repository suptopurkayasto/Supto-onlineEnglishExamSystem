@extends('layouts.app')

@section('title', 'Exam - Grammar  ( '.$authStudent->name.' )')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-12 col-md-8 h-100">
                <div class="h-100 d-flex justify-content-center align-items-center">
                    <div class="rounded shadow">
                        <div class="card border-0 grammar-questions-card">
                            <div class="card-header">
                                <h4 class="h4 title">Grammar Questions</h4>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('student.exam.grammar.questions.submit', encrypt($exam->id)) }}"
                                      id="myform" class="" method="post">
                                    @csrf
                                    <?php $qn = 0; ?>
                                    @foreach($grammars as $index => $grammar)
                                        <?php $qn = $index; ?>
                                        <fieldset>
                                            <ul class="list-unstyled form-group">
                                                <li class="mb-3">
                                                    <input type="hidden" autofocus>
                                                    <h5 class="h5">{{ $index+1 }}. {{ $grammar->question }}</h5>
                                                </li>
                                                <ul class="list-unstyled ml-4">
                                                    <li class="mb-2">
                                                        <div class="custom-control custom-radio">
                                                            <?php $id = Str::random() ?>
                                                            <input type="radio" id="{{ $id }}" name="grammar[{{ $grammar->id }}]"
                                                                   class="custom-control-input"
                                                                   value="{{ $grammar->option_1 }}">
                                                            <label class="custom-control-label"
                                                                   for="{{ $id }}">{{ $grammar->option_1 }}</label>
                                                        </div>
                                                    </li>
                                                    <li class="mb-2">
                                                        <div class="custom-control custom-radio">
                                                            <?php $id = Str::random() ?>
                                                            <input type="radio" id="{{ $id }}" name="grammar[{{ $grammar->id }}]"
                                                                   class="custom-control-input"
                                                                   value="{{ $grammar->option_2 }}">
                                                            <label class="custom-control-label"
                                                                   for="{{ $id }}">{{ $grammar->option_2 }}</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="custom-control custom-radio">
                                                            <?php $id = Str::random() ?>
                                                            <input type="radio" id="{{ $id }}" name="grammar[{{ $grammar->id }}]"
                                                                   class="custom-control-input"
                                                                   value="{{ $grammar->option_3 }}">
                                                            <label class="custom-control-label"
                                                                   for="{{ $id }}">{{ $grammar->option_3 }}</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </ul>
                                        </fieldset>
                                    @endforeach
                                </form>
                            </div><!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row justify-content-center">
                                    <div class="col col-md-4">
                                        <button class="btn btn-light btn-block"
                                                onclick="$('#myform').prevpage();">Previous
                                        </button>
                                    </div><!-- /.col -->
                                    <div class="col col-md-4">
                                        <button class="btn btn-light btn-block"
                                                onclick="$('#myform').nextpage();">Next
                                        </button>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.card-footer -->
                        </div><!-- /.card -->
                    </div><!-- /.p-4 rounded shadow student-question-sec -->
                </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
            </div><!-- /.col-12 col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection


@section('extra-script')
    <script>
        var height = $(window).innerHeight();
        $('body').css({'height': height});

        // alert('Check the correct answer');
        // function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); }
        // $(document).on("keydown", disableF5);

        // $(window).bind('beforeunload', function(e) {
        //     return "Unloading this page may lose data. What do you want to do...";
        //     e.preventDefault();
        // });
    </script>
@endsection
