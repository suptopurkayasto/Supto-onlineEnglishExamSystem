@extends('layouts.app')

@section('content')
    <div class="container h-100 my-5">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="rounded shadow bg-white">
                <div class="card border-0 writing-questions-card">
                    <form action="{{ route('student.exam.writing.questions.submit', $exam->id) }}"
                          id="myform"
                          class="" method="post">
                    @csrf

                    <!-- START:: Dialog Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="h4 title">Dialog</h4>
                                <span class="subtitle">Select the correct word from the dropdown on the right</span>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <h5 class="h5">{{ $dialog->topic }}</h5>

                                <div id="dialog-question-1"
                                     class="form-group mt-5">
                                    <input type="hidden" name="dialog_id" value="{{ $dialog->id }}">
                                    <label for="question_1"><h6 class="h6">1. {{ $dialog->question_1 }}</h6></label>
                                    <textarea name="dialog[answer][1]" id="question_1" rows="5" class="form-control"
                                              spellcheck="false" word-limit="true" max-words="50"
                                              min-words="40"></textarea>
                                    <span class="mt-2"></span>
                                    <div class="writing_error mt-2"></div>

                                </div><!-- /.form-group -->

                                <div id="dialog-question-2"
                                     class="form-group mt-5">
                                    <label for="question_2"><h5 class="h5">2. {{ $dialog->question_2 }}</h5></label>
                                    <textarea name="dialog[answer][2]" id="question_2" rows="5"
                                              class="form-control" spellcheck="false" word-limit="true" max-words="50"
                                              min-words="40"></textarea>
                                    <span class="mt-2"></span>
                                    <div class="writing_error mt-2"></div>
                                </div><!-- /.form-group -->

                                <div id="dialog-question-1"
                                     class="form-group mt-5">
                                    <label for="question_3"><h5 class="h5">3. {{ $dialog->question_3 }}</h5></label>
                                    <textarea name="dialog[answer][3]" id="question_3" rows="5"
                                              class="form-control" spellcheck="false" word-limit="true" max-words="50"
                                              min-words="40"></textarea>
                                    <span class="mt-2"></span>
                                    <div class="writing_error mt-2"></div>
                                </div><!-- /.form-group -->
                            </div><!-- /.card-body -->
                        </fieldset>
                        <!-- END:: Dialog Markup -->


                        <!-- START:: Informal Email Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="h4 title">Informal Email</h4>
                                {{--                                    <span class="subtitle">Select the correct word from the dropdown on the right</span>--}}
                            </div><!-- /.card-header -->
                            <div class="card-body body-max-width">
                                <h5 class="h5">{{ $informalEmail->topic }}</h5>

                                <div id="informalEmail"
                                     class="form-group mt-5">
                                    <input type="hidden" name="informal_email_id" value="{{ $informalEmail->id }}">
                                    <div class="form-group">
                                        <label for="informalEmail-subject">Subject</label>
                                        <input type="text" id="informalEmail-subject" name="informalEmail[subject]"
                                               placeholder="Subject" class="form-control">
                                    </div><!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="informalEmail-body">Body</label>
                                        <textarea name="informalEmail[body]" id="informalEmail-body" rows="10"
                                                  class="form-control"
                                                  spellcheck="false" word-limit="true" max-words="100"
                                                  min-words="40"></textarea>
                                        <span class="mt-2"></span>
                                        <div class="writing_error mt-2"></div>
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                            </div><!-- /.card-body -->
                        </fieldset>
                        <!-- END:: Informal Email Markup -->


                        <!-- START:: Formal Email Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="h4 title">Formal Email</h4>
                                {{--                                    <span class="subtitle">Select the correct word from the dropdown on the right</span>--}}
                            </div><!-- /.card-header -->
                            <div class="card-body body-max-width">
                                <h5 class="h5 mb-3">{{ $formalEmail->topic }}</h5>
                                <h6 class="h6">{{ $formalEmail->received_email }}</h6>
                                <div id="formalEmail"
                                     class="form-group mt-5">
                                    <input type="hidden" name="formal_email_id" value="{{ $formalEmail->id }}">
                                    <div class="form-group">
                                        <label for="formalEmail-subject">Subject</label>
                                        <input type="text" id="informalEmail-subject" name="formalEmail[subject]"
                                               placeholder="Subject" class="form-control">
                                    </div><!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="formalEmail-body">Body</label>
                                        <textarea name="formalEmail[body]" id="formalEmail-body" rows="10"
                                                  class="form-control"
                                                  spellcheck="false" word-limit="true" max-words="100"
                                                  min-words="40"></textarea>
                                        <span class="mt-2"></span>
                                        <div class="writing_error mt-2"></div>
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                            </div><!-- /.card-body -->
                        </fieldset>
                        <!-- END:: Formal Email Markup -->


                        <!-- START:: Sort question Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="h4 title">Sort Questions</h4>
                                {{--                                    <span class="subtitle">Select the correct word from the dropdown on the right</span>--}}
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($sortQuestions as $index => $sortQuestion)
                                    <div class="form-group mb-5">
                                        <label for="">{{ $index }}. {{ $sortQuestion->question }}</label>
                                        <input type="hidden" name="sortQuestion[question][{{ $sortQuestion->id }}]"
                                               value="{{ $sortQuestion->id }}">
                                        <textarea type="text" name="sortQuestion[answer][{{ $sortQuestion->id }}]"
                                                  class="form-control" id=""></textarea>
                                    </div><!-- /.form-group -->
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>
                        <!-- END:: Sort question Markup -->

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
    <script src="{{ asset('js/extra/custom.js') }}"></script>
    <script>


        //
        // function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); }
        // $(document).on("keydown", disableF5);

        // $(window).bind('beforeunload', function(e) {
        //     return "Unloading this page may lose data. What do you want to do...";
        //     e.preventDefault();
        // });

    </script>
@endsection
