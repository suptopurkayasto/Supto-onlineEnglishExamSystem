@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="p-4 rounded shadow bg-white student-question-sec">
                <div class="card border-primary" style="width: 900px">
                    <form action="{{ route('student.exam.reading.questions.submit', $exam->id) }}"
                          id="myform"
                          class="" method="post">
                    @csrf
                    <!-- START:: Rearrange Markup -->
                        <fieldset>
                            <div class="card-header border-primary">
                                <h3 class="h3 text-center font-weight-bolder">Rearrange</h3>
                                <span class="text-muted d-block text-center font-weight-light">Select the correct word from the dropdown on the right</span>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($rearranges as $index => $rearrange)
                                    <div class="list-group shadow-sm" id="sortable">
                                        <label>
                                            {{ $rearrange->line_1 }}
                                            <input type="hidden" name="1" class="list-group-item border-primary" value="{{ $rearrange->line_1 }}">
                                        </label>
                                        <label>
                                            {{ $rearrange->line_6 }}
                                            <input type="hidden" name="6" class="list-group-item border-primary" value="{{ $rearrange->line_6 }}">
                                        </label>
                                        <label>
                                            {{ $rearrange->line_3 }}
                                            <input type="hidden" name="3" class="list-group-item border-primary" value="{{ $rearrange->line_3 }}">
                                        </label>
                                        <label>
                                            {{ $rearrange->line_5 }}
                                            <input type="hidden" name="5" class="list-group-item border-primary" value="{{ $rearrange->line_5 }}">
                                        </label>
                                        <label>
                                            {{ $rearrange->line_7 }}
                                            <input type="hidden" name="7" class="list-group-item border-primary" value="{{ $rearrange->line_7 }}">
                                        </label>
                                        <label>
                                            {{ $rearrange->line_4 }}
                                            <input type="hidden" name="4" class="list-group-item border-primary" value="{{ $rearrange->line_4 }}">
                                        </label>
                                        <label>
                                            {{ $rearrange->line_2 }}
                                            <input type="hidden" name="2" class="list-group-item border-primary" value="{{ $rearrange->line_2 }}">
                                        </label>
                                    </div>
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>

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
    <script>
        $("#sortable").sortable({
            update: function (event, ui) {
                $(this).children().each(function (index) {
                    $(this).children('input').attr('name', (index+1));
                })
            }
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
