@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-12 col-md-8 h-100">
                <div class="h-100 d-flex justify-content-center align-items-center">
                    <div class="row p-4 rounded shadow bg-white">
                        <div class="col-12">
                            <form action="{{ route('student.exam.grammar.questions.submit', $exam->id) }}" id="myform" class="" method="post">
                                @csrf
                                <?php $qn = 0; ?>
                                @foreach($grammars as $index => $grammar)
                                    <?php $qn = $index; ?>
                                    <fieldset>
                                        <ul class="list-unstyled form-group">
                                            <li class="mb-3"><h3 class="h3">{{ $index+1 }}. {{ $grammar->question }}</h3></li>
                                            <ul class="list-unstyled ml-4">
                                                <li class="mb-2">
                                                    <div class="custom-control custom-radio">
                                                        <?php $id = Str::random() ?>
                                                        <input type="radio" id="{{ $id }}" name="question{{ $index+1 }}"
                                                               class="custom-control-input" value="{{ $grammar->option_1 }}">
                                                        <label class="custom-control-label"
                                                               for="{{ $id }}">{{ $grammar->option_1 }}</label>
                                                    </div>
                                                </li>
                                                <li class="mb-2">
                                                    <div class="custom-control custom-radio">
                                                        <?php $id = Str::random() ?>
                                                        <input type="radio" id="{{ $id }}" name="question{{ $index+1 }}"
                                                               class="custom-control-input" value="{{ $grammar->option_2 }}">
                                                        <label class="custom-control-label"
                                                               for="{{ $id }}">{{ $grammar->option_2 }}</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <?php $id = Str::random() ?>
                                                        <input type="radio" id="{{ $id }}" name="question{{ $index+1 }}"
                                                               class="custom-control-input" value="{{ $grammar->option_3 }}">
                                                        <label class="custom-control-label"
                                                               for="{{ $id }}">{{ $grammar->option_3 }}</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </ul>
                                    </fieldset>
                                @endforeach
                            </form>
                        </div><!-- /. -->
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary btn-block" onclick="$('#myform').prevpage();">Previous</button>
                                </div><!-- /.col -->
                                <div class="col">
                                    <button class="btn btn-primary btn-block" onclick="$('#myform').nextpage();">Next</button>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /. -->
                    </div><!-- /.row -->
                </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
            </div><!-- /.col-12 col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection

@section('extra-scripts')
    <script src="{{ asset('js/extra/jquery.multipage.js') }}"></script>
    <script>
        $('#myform').multipage({
            generateNavigation: false,
        });


        //
        // function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); }
        // $(document).on("keydown", disableF5);

        // $(window).bind('beforeunload', function(e) {
        //     return "Unloading this page may lose data. What do you want to do...";
        //     e.preventDefault();
        // });

    </script>
@endsection
