@extends('layouts.teacher')

@section('title', 'Show Dialog Question')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Show Dialog Question</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="" method="post">
                @csrf

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="exam">Exam</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="exam" id="exam" class="form-control @error('exam') is-invalid @enderror" disabled>
                            <option disabled selected>Select exam</option>
                            @foreach($authTeacherExams as $authTeacherExam)
                                <option
                                    {{ $dialog->exam->id == $authTeacherExam->id ? 'selected' : '' }} value="{{ $authTeacherExam->id }}">{{ $authTeacherExam->name }}</option>
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
                                class="form-control @error('questionSet') is-invalid @enderror" disabled>
                            <option disabled selected>Select group</option>
                            @foreach($questionSets as $questionSet)
                                <option
                                    {{ $dialog->set->id == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
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
                        <label for="topic">Topic</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="topic" id="topic"
                               class="form-control @error('topic') is-invalid @enderror" value="{{ $dialog->topic }}"
                               disabled>
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
                               value="{{ $dialog->question_1 }}"
                               disabled>
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
                               value="{{ $dialog->question_2 }}"
                               disabled>
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
                               value="{{ $dialog->question_3 }}"
                               disabled>
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
                        <a href="{{ route('teachers.questions.dialogs.edit', $dialog->id) }}?exam={{ request()->get('exam') }}"
                           class="btn bg-gradient-primary"><i class="far fa-edit mr-1"></i> Edit
                            Dialog
                        </a>
                        <form action="{{ route('teachers.questions.dialogs.destroy', $dialog->id) }}?exam={{ request()->get('exam') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete: {{ $dialog->topic }}')"><i
                                    class="fas fa-trash-alt mr-1"></i> Delete Dialog
                            </button>
                        </form>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
