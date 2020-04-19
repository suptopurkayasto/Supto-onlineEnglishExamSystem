@extends('layouts.app')

@section('content')
    <div class="container h-100 my-5">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="p-4 rounded shadow bg-white student-question-sec">
                <div class="card border-primary" style="width: 900px">
                    <form action="{{ route('student.exam.writing.questions.submit', $exam->id) }}"
                          id="myform"
                          class="" method="post">
                    @csrf

                        <!-- START:: Dialog Markup -->
                        <fieldset>
                            <div class="card">
                                <div class="card-header border-primary">
                                    <h4 class="h4 text-center font-weight-bolder">Dialog</h4>
                                    {{--                                    <span class="text-muted d-block text-center font-weight-light">Select the correct word from the dropdown on the right</span>--}}
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <h4 class="h4">{{ $dialog->topic }}</h4>

                                    <div id="dialog-question-1"
                                         class="form-group mt-5 shadow-sm border border-primary rounded p-3">
                                        <input type="hidden" name="dialog_id" value="{{ $dialog->id }}">
                                        <label for="question_1"><h5 class="h5">1. {{ $dialog->question_1 }}</h5></label>
                                        <textarea name="dialog[answer][1]" id="question_1" rows="5" class="form-control"
                                                  spellcheck="false" word-limit="true" max-words="50"
                                                  min-words="40"></textarea>
                                        <span></span>
                                        <div class="writing_error"></div>

                                    </div><!-- /.form-group -->

                                    <div id="dialog-question-2"
                                         class="form-group mt-5 shadow-sm border border-primary rounded p-3">
                                        <label for="question_2"><h5 class="h5">2. {{ $dialog->question_2 }}</h5></label>
                                        <textarea name="dialog[answer][2]" id="question_2" rows="5"
                                                  class="form-control" spellcheck="false" word-limit="true" max-words="50"
                                                  min-words="40"></textarea>
                                        <span></span>
                                        <div class="writing_error"></div>
                                    </div><!-- /.form-group -->

                                    <div id="dialog-question-1"
                                         class="form-group mt-5 shadow-sm border border-primary rounded p-3">
                                        <label for="question_3"><h5 class="h5">3. {{ $dialog->question_3 }}</h5></label>
                                        <textarea name="dialog[answer][3]" id="question_3" rows="5"
                                                  class="form-control" spellcheck="false" word-limit="true" max-words="50"
                                        min-words="40"></textarea>
                                        <span></span>
                                        <div class="writing_error"></div>
                                    </div><!-- /.form-group -->
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </fieldset>
                        <!-- END:: Dialog Markup -->


                        <!-- START:: Informal Email Markup -->
                        <fieldset>
                            <div class="card">
                                <div class="card-header border-primary">
                                    <h4 class="h4 text-center font-weight-bolder">Informal Email</h4>
                                    {{--                                    <span class="text-muted d-block text-center font-weight-light">Select the correct word from the dropdown on the right</span>--}}
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <h4 class="h4">{{ $informalEmail->topic }}</h4>

                                    <div id="informalEmail"
                                         class="form-group mt-5 shadow-sm border border-primary rounded p-3">
                                        <input type="hidden" name="informal_email_id" value="{{ $informalEmail->id }}">
                                        <div class="form-group">
                                            <label for="informalEmail-subject">Subject</label>
                                            <input type="text" id="informalEmail-subject" name="informalEmail[subject]" placeholder="Subject" class="form-control">
                                        </div><!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="informalEmail-body">Body</label>
                                            <textarea name="informalEmail[body]" id="informalEmail-body" rows="5" class="form-control"
                                                      spellcheck="false" word-limit="true" max-words="100"
                                                      min-words="40"></textarea>
                                            <span></span>
                                            <div class="writing_error"></div>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </fieldset>
                        <!-- END:: Informal Email Markup -->
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
