@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-12 col-md-8 h-100">
                <div class="h-100 d-flex justify-content-center align-items-center">
                    <div class="p-4 rounded shadow bg-white student-question-sec">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('student.exam.vocabulary.questions.submit', $exam->id) }}"
                                      id="myform"
                                      class="" method="post">
                                    @csrf
                                    <span class="text-black-50 mb-4 d-block text-center font-weight-light">Select the correct word from the dropdown on the right</span>
                                    @foreach($synonyms as $index => $synonym)
                                        <fieldset>
                                            <div class="form-group row">
                                                <div class="col-12 col-md-6">
                                                    <label for="synonym" class="h2">{{ $index+1 }}
                                                        . {{ $synonym->word }}</label>
                                                </div><!-- /.col-12 col-md-6 -->
                                                <div class="col-12 col-md-6">
                                                    <select name="synonym[][{{ $synonym->id }}]" id="synonym" class="form-control">
                                                        <option disabled selected class="h3">Choose word</option>
                                                        @foreach($synonymOptions as $option)
                                                            <option value="{{ $option->options }}" class="h3">{{ $option->options }}</option>
                                                        @endforeach
                                                    </select>
                                                </div><!-- /.col-12 col-md-6 -->
                                            </div><!-- /.form-group -->
                                        </fieldset>
                                    @endforeach
                                </form>
                            </div><!-- /. -->
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-outline-primary btn-block"
                                                onclick="$('#myform').prevpage();">
                                            Previous
                                        </button>
                                    </div><!-- /.col -->
                                    <div class="col">
                                        <button class="btn btn-outline-primary btn-block"
                                                onclick="$('#myform').nextpage();">Next
                                        </button>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /. -->
                        </div><!-- /.row -->
                    </div><!-- /.p-4 rounded shadow bg-white student-question-sec -->
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
