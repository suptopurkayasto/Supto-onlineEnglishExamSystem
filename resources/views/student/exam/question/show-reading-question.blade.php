@extends('layouts.app')

@section('content')
    <div class="container h-100 my-5">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="rounded shadow bg-white">
                <div class="card border-0 reading-questions-card">
                    <form action="{{ route('student.exam.reading.questions.submit', $exam->id) }}"
                          id="myform"
                          class="" method="post">
                    @csrf
                        <!-- START:: Heading Matching Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="h4 title">Heading Matching</h4>
                                <span class="subtitle">Select the correct heading from the dropdown on the top</span>
                            </div><!-- /.card-header -->
                            <div class="card-body body-max-width">
                                @foreach($headings as $index => $heading)
                                    <div class="form-group p-2 mb-5 rounded">
                                        <select name="heading[][{{ $heading->id }}]" id="heading_{{ $index+1 }}"
                                                class="select-menu mb-2 form-control">
                                            <option disabled selected>Select correct heading</option>
                                            @foreach($headingOptions as $headingOption)
                                                <option
                                                    value="{{ $headingOption->id }}">{{ $headingOption->headings }}</option>
                                            @endforeach
                                        </select>
                                        <label for="heading_{{ $index+1 }}" class="mt-2">
                                            <p class="mb-0">{{ $heading->paragraph }}</p>
                                        </label>
                                    </div><!-- /.form-group -->
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>
                        <!-- END:: Heading Matching Markup -->


                        <!-- START:: Rearrange Markup -->
                        <fieldset>
                            <div class="card-header">
                                <h4 class="h4 title">Rearrange</h4>
                                <span class="subtitle">Arrange the rearrange</span>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                @foreach($rearranges as $index => $rearrange)
                                    <ul class="list-group" id="sortable">
                                        <label
                                            class="list-group-item shadow-sm mb-3 first-rearrange-item">
                                            <i class="fas fa-arrows-alt mr-2 text-primary"></i>
                                            {{ $rearrange->line_1 }}
                                            <input type="hidden" name="1" class="" value="{{ $rearrange->line_1 }}">
                                        </label>
                                        <label class="list-group-item shadow-sm mb-3">
                                            <i class="fas fa-arrows-alt mr-2 text-primary"></i>
                                            {{ $rearrange->line_6 }}
                                            <input type="hidden" name="6" class="" value="{{ $rearrange->line_6 }}">
                                        </label>
                                        <label class="list-group-item shadow-sm mb-3">
                                            <i class="fas fa-arrows-alt mr-2 text-primary"></i>
                                            {{ $rearrange->line_3 }}
                                            <input type="hidden" name="3" class="" value="{{ $rearrange->line_3 }}">
                                        </label>
                                        <label class="list-group-item shadow-sm mb-3">
                                            <i class="fas fa-arrows-alt mr-2 text-primary"></i>
                                            {{ $rearrange->line_5 }}
                                            <input type="hidden" name="5" class="" value="{{ $rearrange->line_5 }}">
                                        </label>
                                        <label class="list-group-item shadow-sm mb-3">
                                            <i class="fas fa-arrows-alt mr-2 text-primary"></i>
                                            {{ $rearrange->line_7 }}
                                            <input type="hidden" name="7" class="" value="{{ $rearrange->line_7 }}">
                                        </label>
                                        <label class="list-group-item shadow-sm mb-3">
                                            <i class="fas fa-arrows-alt mr-2 text-primary"></i>
                                            {{ $rearrange->line_4 }}
                                            <input type="hidden" name="4" class="" value="{{ $rearrange->line_4 }}">
                                        </label>
                                        <label class="list-group-item shadow-sm mb-3">
                                            <i class="fas fa-arrows-alt mr-2 text-primary"></i>
                                            {{ $rearrange->line_2 }}
                                            <input type="hidden" name="2" class="" value="{{ $rearrange->line_2 }}">
                                        </label>
                                    </ul>
                                @endforeach
                            </div><!-- /.card-body -->
                        </fieldset>

                        <!-- END:: Rearrange Markup -->
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
        // $( ".select-menu" ).selectmenu();
        $("#sortable").sortable({
            axis: 'y',
            // cancel: '.first-rearrange-item',
            containment: "parent",
            cursorAt: {left: 5},
            cursor: "move",
            distance: 5,
            update: function (event, ui) {
                $(this).children().each(function (index) {
                    $(this).children('input').attr('name', (index + 1));
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
