@extends('layouts.teacher')

@section('title', 'Add Writing Question')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Add Writing Question</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="" method="post" id="writingPartForm">
                @csrf

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="exam">Exam</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="exam" id="exam" class="form-control @error('exam') is-invalid @enderror">
                            <option disabled selected>Select exam</option>
                            @foreach($authTeacherExams as $authTeacherExam)
                                <option
                                    {{ old('exam') == $authTeacherExam->id ? 'selected' : '' }} value="{{ $authTeacherExam->id }}">{{ $authTeacherExam->name }}</option>
                            @endforeach
                        </select>
                        @error('exam')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group row -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="questionSet">Question Set</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="questionSet" id="questionSet"
                                class="form-control @error('questionSet') is-invalid @enderror">
                            <option disabled selected>Select group</option>
                            @foreach($questionSets as $questionSet)
                                <option
                                    {{ old('questionSet') == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
                            @endforeach
                        </select>
                        @error('questionSet')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group row -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="writing_part">Writing Part</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="writing_part" id="writing_part"
                                class="form-control @error('writing_part') is-invalid @enderror">
                            <option disabled selected>Select group</option>
                            @foreach($writingParts as $writingPart)
                                <option
                                    {{ old('writing_part') == $writingPart->id ? 'selected' : '' }} value="{{ $writingPart->id }}">{{ $writingPart->name }}</option>
                            @endforeach
                        </select>
                        @error('writing_part')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group row -->

                <!-- Start::Dialog Section -->
                <div id="dialogSection" class="">
                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                            <label for="topic">Topic</label>
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <input type="text" name="topic" id="topic"
                                   class="form-control @error('topic') is-invalid @enderror" value="{{ old('topic') }}"
                                   required>
                            @error('topic')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.col-12 col-md-8 -->
                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                            <label for="question_1">Question 1</label>
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <input type="text" name="question_1" id="question_1"
                                   class="form-control @error('question_1') is-invalid @enderror"
                                   value="{{ old('question_1') }}"
                                   required>
                            @error('question_1')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.col-12 col-md-8 -->
                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                            <label for="question_2">Question 2</label>
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <input type="text" name="question_2" id="question_2"
                                   class="form-control @error('question_2') is-invalid @enderror"
                                   value="{{ old('question_2') }}"
                                   required>
                            @error('question_2')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.col-12 col-md-8 -->
                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                            <label for="question_3">Question 3</label>
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <input type="text" name="question_3" id="question_3"
                                   class="form-control @error('question_3') is-invalid @enderror"
                                   value="{{ old('question_3') }}"
                                   required>
                            @error('question_3')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.col-12 col-md-8 -->
                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <button type="submit" class="btn bg-gradient-primary"><i class="fas fa-check"></i> Add
                                Dialog
                            </button>
                        </div><!-- /.col-12 col-md-8 -->
                    </div><!-- /.form-group -->
                </div><!-- /.dialogSection -->
                <!-- End::Dialog Section -->

                <!-- Start::InformalEmail Section -->
                <div id="informalEmail" class="">
                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                            <label for="topic">Topic</label>
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <input type="text" name="topic" id="topic"
                                   class="form-control @error('topic') is-invalid @enderror" value="{{ old('topic') }}"
                                   required>
                            @error('topic')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.col-12 col-md-8 -->
                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <button type="submit" class="btn bg-gradient-primary"><i class="fas fa-check"></i> Add
                                Informal Email
                            </button>
                        </div><!-- /.col-12 col-md-8 -->
                    </div><!-- /.form-group -->
                </div><!-- /.informalEmail -->
                <!-- End::InformalEmail Section -->

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@section('extra-scripts')
    <script>
        $(document).ready(function () {
            showWritingSection();

            function showWritingSection() {

                var action = '';
                $('#dialogSection').hide();

                if ($('#writing_part').val() === '2') {
                    action = "{{ route('teachers.questions.dialogs.store') }}";
                    $('#writingPartForm').attr('action', action);
                    $('#dialogSection').show();
                } else {
                    $('#dialogSection').hide();
                    $('#writingPartForm').attr('action', '');
                }

                $('#writing_part').change(function () {
                    var selectedItem = $(this).val();
                    if (selectedItem === '2') {
                        action = "{{ route('teachers.questions.dialogs.store') }}";
                        $('#writingPartForm').attr('action', action);
                        $('#dialogSection').show();
                    }
                    else if (selectedItem === '4') {
                        action = "{{ route('teachers.questions.dialogs.store') }}";
                        $('#writingPartForm').attr('action', action);
                        $('#informalEmail').show();
                    } else {
                        $('#dialogSection').hide();
                        $('#writingPartForm').attr('action', '');
                    }
                });
            }
        })
        ;
    </script>
@stop
