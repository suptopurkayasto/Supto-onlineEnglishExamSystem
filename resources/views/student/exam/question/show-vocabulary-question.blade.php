@extends('layouts.app')
@section('title', 'Exam - Vocabulary ( '.$authStudent->name.' )')
@section('content')
    <div class="container h-100">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="rounded shadow bg-white">
                <div class="card border-0 vocabulary-questions-card">
                    <form action="{{ route('student.exam.vocabulary.questions.submit', encrypt($exam->id)) }}"
                          id="myform"
                          class="" method="post">
                        @csrf
                        <!-- START:: Synonym Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="h4 title">Synonym Word</h4>
{{--                                <span class="subtitle">Select the correct word from the dropdown on the right</span>--}}
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($synonyms as $index => $synonym)
                                    <div class="form-group row">
                                        <div class="col-12 col-md-6">
                                            <label for="synonym_{{ $synonym->id }}" class="custom-select-label mb-md-0">{{ $index+1 }}. {{ $synonym->word }}</label>
                                        </div><!-- /.col-12 col-md-6 -->
                                        <div class="col-12 col-md-6">
                                            <select name="synonym[{{ $synonym->id }}]" id="synonym_{{ $synonym->id }}"
                                                    class="form-control form-control-lg custom-select-dropdown">
                                                <option disabled selected>Choose word</option>
                                                @foreach($synonymOptions as $option)
                                                    <option value="{{ $option->options }}">{{ $option->options }}</option>
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
                            <div class="card-header">
                                <h4 class="h4 title">Word Definition</h4>
{{--                                <span class="subtitle">Select the correct word from the dropdown on the right</span>--}}
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($definitions as $index => $definition)
                                    <div class="form-group row">
                                        <div class="col-12 col-md-8">
                                            <label for="definition_{{ $definition->id }}" class="mb-md-0 custom-select-label">{{ $index+1 }}. {{ $definition->sentence }}</label>
                                        </div><!-- /.col-12 col-md-8 -->
                                        <div class="col-12 col-md-4">
                                            <select name="definition[][{{ $definition->id }}]" id="definition_{{ $definition->id }}"
                                                    class="form-control form-control-lg custom-select-dropdown">
                                                <option disabled selected class="h5">Choose word</option>
                                                @foreach($definitionOptions as $option)
                                                    <option value="{{ $option->options }}">{{ $option->options }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- /.col-12 col-md-4 -->
                                    </div><!-- /.form-group -->
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>
                        <!-- END:: Definition Markup -->


                        <!-- START:: Combination Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="title">Word Combination</h4>
{{--                                <span class="subtitle">Select the correct word from the dropdown on the right</span>--}}
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($combinations as $index => $combination)
                                    <div class="form-group row">
                                        <div class="col-12 col-md-6">
                                            <label for="definition_{{ $combination->id }}" class="mb-md-0 custom-select-label">
                                                {{ $index+1 }}. {{ $combination->word }}
                                            </label>
                                        </div><!-- /.col-12 col-md-6 -->
                                        <div class="col-12 col-md-6">
                                            <select name="combination[][{{ $combination->id }}]"
                                                    id="definition_{{ $combination->id }}"
                                                    class="form-control form-control-lg custom-select-dropdown">
                                                <option disabled selected>Choose word</option>
                                                @foreach($combinationOptions as $option)
                                                    <option value="{{ $option->options }}">{{ $option->options }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- /.col-12 col-md-6 -->
                                    </div><!-- /.form-group -->
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>
                        <!-- END:: Combination Markup -->

                        <!-- START:: Fill in the gap Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="title">Fill in the gap</h4>
{{--                                <span class="subtitle">Select the correct word from the dropdown on the right</span>--}}
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($fillInTheGaps as $index => $fillInTheGap)
                                    <div class="form-group row">
                                        <div class="col-12 col-md-8">
                                            <label for="fillInTheGap_{{ $fillInTheGap->id }}" class="mb-md-0 custom-select-label">{{ $index+1 }}. {{ $fillInTheGap->sentence }}</label>
                                        </div><!-- /.col-12 col-md-8 -->
                                        <div class="col-12 col-md-4">
                                            <select name="fillInTheGap[][{{ $fillInTheGap->id }}]"
                                                    id="fillInTheGap_{{ $fillInTheGap->id }}"
                                                    class="form-control form-control-lg custom-select-dropdown">
                                                <option disabled selected class="h5">Choose word</option>
                                                @foreach($fillInTheGapOptions as $option)
                                                    <option value="{{ $option->options }}">{{ $option->options }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- /.col-12 col-md-4 -->
                                    </div><!-- /.form-group -->
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>
                        <!-- END:: Fill in the gap Markup -->


                    </form>
                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col col-md-4">
                                <button class="btn btn-light btn-block"
                                        onclick="$('#myform').prevpage();">
                                    Previous
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
            </div><!-- /.p-4 rounded shadow bg-white student-question-sec -->
        </div><!-- /.h-100 d-flex justify-content-center align-items-center -->
    </div><!-- /.container -->
@endsection

@section('extra-script')
    <script>
        var height = $(window).innerHeight();
        $('body').css({'height': height});

        // function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); }
        // $(document).on("keydown", disableF5);

        // $(window).bind('beforeunload', function(e) {
        //     return "Unloading this page may lose data. What do you want to do...";
        //     e.preventDefault();
        // });
    </script>
@endsection
