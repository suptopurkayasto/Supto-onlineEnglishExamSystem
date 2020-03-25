@extends('layouts.teacher')

@section('title', 'Edit Grammar Question - ' . $grammarQuestion->name)

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Grammar Quesiton</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('teachers.grammar-questions.update', $grammarQuestion->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="exam_name">Exam name</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="exam_name" id="exam_name"
                                class="form-control @error('exam_name') is-invalid @enderror">
                            <option selected>Select exam</option>
                            @foreach($exams as $exam)
                                <option {{ $exam->id == $grammarQuestion->exam->id ? 'selected' : ''  }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                        </select>
                        @error('exam_name')
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
                                class="form-control @error('question_set') is-invalid @enderror" >
                            <option disabled>Select question set</option>
                            @foreach($questionSets as $questionSet)
                                <option {{ $questionSet->id == $grammarQuestion->exam->id ? 'selected' : ''  }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
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
                               class="form-control @error('question') is-invalid @enderror" value="{{ $grammarQuestion->question }}"
                               >
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
                               class="form-control @error('option_1') is-invalid @enderror" value="{{ $grammarQuestion->option_1 }}"
                               >
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
                               class="form-control @error('option_2') is-invalid @enderror" value="{{ $grammarQuestion->option_2 }}"
                               >
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
                               class="form-control @error('option_3') is-invalid @enderror" value="{{ $grammarQuestion->option_3 }}"
                               >
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
                               class="form-control @error('answer') is-invalid @enderror" value="{{ $grammarQuestion->answer }}"
                               >
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
                        <button type="submit" class="btn bg-gradient-primary">Update Question</button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
