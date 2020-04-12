@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="p-4 rounded shadow bg-white student-question-sec">
                <div class="card border-primary w-100">
                    <form action="{{ route('student.exam.vocabulary.questions.submit', $exam->id) }}"
                          id="myform"
                          class="" method="post">
                        @csrf
                        <!-- START:: Synonym Markup -->
                        <fieldset>
                            <div class="card-header border-primary">
                                <h3 class="h3 text-center font-weight-bolder">Synonym Word</h3>
                                <span class="text-muted d-block text-center font-weight-light">Select the correct word from the dropdown on the right</span>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($synonyms as $index => $synonym)
                                    <div class="form-group row">
                                        <div class="col-12 col-md-6">
                                            <label for="synonym" class="mb-md-0">
                                                <h5 class="h5">{{ $index+1 }}. {{ $synonym->word }}</h5>
                                            </label>
                                        </div><!-- /.col-12 col-md-6 -->
                                        <div class="col-12 col-md-6">
                                            <select name="synonym[][{{ $synonym->id }}]" id="synonym"
                                                    class="form-control">
                                                <option disabled selected class="h5">Choose word</option>
                                                @foreach($synonymOptions as $option)
                                                    <option value="{{ $option->options }}"
                                                            class="h5">{{ $option->options }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- /.col-12 col-md-6 -->
                                    </div><!-- /.form-group -->
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>
                         <!-- END:: Synonym Markup -->

                         <!-- START:: Definition Markup -->
                        <fieldset>
                            <div class="card-header border-primary">
                                <h3 class="h3 text-center font-weight-bolder">Definition</h3>
                                <span class="text-muted d-block text-center font-weight-light">Select the correct word from the dropdown on the right</span>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($definitions as $index => $definition)
                                    <div class="form-group row">
                                        <div class="col-12 col-md-8">
                                            <label for="synonym" class="mb-md-0">
                                                <h5 class="h5">{{ $index+1 }}. {{ $definition->sentence }}</h5>
                                            </label>
                                        </div><!-- /.col-12 col-md-8 -->
                                        <div class="col-12 col-md-4">
                                            <select name="definition[][{{ $definition->id }}]" id="synonym"
                                                    class="form-control">
                                                <option disabled selected class="h5">Choose word</option>
                                                @foreach($definitionOptions as $option)
                                                    <option value="{{ $option->options }}"
                                                            class="h5">{{ $option->options }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- /.col-12 col-md-4 -->
                                    </div><!-- /.form-group -->
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>
                         <!-- END:: Definition Markup -->
                    </form>
                    <div class="card-footer border-primary">
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
                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.p-4 rounded shadow bg-white student-question-sec -->
        </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
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
