@extends('layouts.teacher')

@section('title', 'Add Question')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Add Grammar question
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('teachers.questions.grammars.store') }}" method="post">
                @csrf

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="exam_name">Exam name</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="exam" id="exam"
                                class="form-control @error('exam') is-invalid @enderror">
                            <option selected disabled>Select exam</option>
                            @foreach($authTeacher->exams as $exam)
                                <option {{ old('exam') == $exam->id || decrypt(request()->get('exam')) === $exam->id ? 'selected' : ''  }} value="{{ $exam->id }}">{{ $exam->name }}</option>
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
                        <label for="question_set">Question set</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="question_set" id="question_set"
                                class="form-control @error('question_set') is-invalid @enderror">
                            <option selected disabled>Select question set</option>
                            @foreach($questionSets as $questionSet)
                                <option {{ old('question_set') == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
                            @endforeach
                        </select>
                        @error('question_set')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group row -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="question">Question</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="question" id="question"
                               class="form-control @error('question') is-invalid @enderror" value="{{ old('question') }}"
                               required>
                        @error('question')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="option_1">Option 1</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="option_1" id="option_1"
                               class="form-control @error('option_1') is-invalid @enderror" value="{{ old('option_1') }}"
                               required>
                        @error('option_1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="option_2">Option 2</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="option_2" id="option_2"
                               class="form-control @error('option_2') is-invalid @enderror" value="{{ old('option_2') }}"
                               required>
                        @error('option_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="option_3">Option 3</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="option_3" id="option_3"
                               class="form-control @error('option_3') is-invalid @enderror" value="{{ old('option_3') }}"
                               required>
                        @error('option_3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="answer">Answer</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="answer" id="answer"
                               class="form-control @error('answer') is-invalid @enderror" value="{{ old('answer') }}"
                               required>
                        @error('answer')
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
                        <button type="submit" class="btn bg-gradient-primary"><i class="fas fa-check mr-1"></i> Add Question</button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
