@extends('layouts.teacher')

@section('title', 'Show grammar question - ' . $grammar->question)

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Show Grammar Question</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="exam_name">Exam name</label>
                        <select name="exam_name" id="exam_name"
                                class="form-control @error('exam_name') is-invalid @enderror" disabled>
                            <option selected>Select exam</option>
                            <option selected value="{{ $grammar->exam->id }}">{{ $grammar->exam->name }}</option>
                        </select>
                        @error('exam_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label for="question_set">Question set</label>
                        <select name="question_set" id="question_set"
                                class="form-control @error('question_set') is-invalid @enderror" disabled>
                            <option disabled>Select question set</option>
                            @foreach($questionSets as $set)
                                <option
                                    {{ $set->id == $grammar->set->id ? 'selected' : ''  }} value="{{ $set->id }}">{{ $set->name }}</option>
                            @endforeach
                        </select>
                        @error('question_set')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" id="question"
                               class="form-control @error('question') is-invalid @enderror"
                               value="{{ $grammar->question }}"
                               disabled>
                        @error('question')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label for="option_1">Option 1</label>
                        <input type="text" name="option_1" id="option_1"
                               class="form-control @error('option_1') is-invalid @enderror"
                               value="{{ $grammar->option_1 }}"
                               disabled>
                        @error('option_1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label for="option_2">Option 2</label>
                        <input type="text" name="option_2" id="option_2"
                               class="form-control @error('option_2') is-invalid @enderror"
                               value="{{ $grammar->option_2 }}"
                               disabled>
                        @error('option_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <label for="option_3">Option 3</label>
                        <input type="text" name="option_3" id="option_3"
                               class="form-control @error('option_3') is-invalid @enderror"
                               value="{{ $grammar->option_3 }}"
                               disabled>
                        @error('option_3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <input type="text" name="answer" id="answer"
                               class="form-control @error('answer') is-invalid @enderror" value="{{ $grammar->answer }}"
                               disabled>
                        @error('answer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <div class="col-12 col-md-8 mx-auto">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('teachers.questions.grammars.edit', $grammar->id) }}?exam={{ request()->get('exam') }}"
                                       class="btn bg-gradient-primary btn-block"><i class="fas fa-edit mr-1"></i> Edit Question</a>
                                </div><!-- /.col -->
                                <div class="col">
                                    <form
                                        action="{{ route('teachers.questions.grammars.destroy', $grammar->id) }}?exam={{ request()->get('exam') }}"
                                        method="post"
                                        class="ml-3">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-block bg-gradient-danger"
                                                onclick="return confirm('Are you sure you want to delete: {{ $grammar->question }}')">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete Question
                                        </button>
                                    </form>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.form-group -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div><!-- /.col-12 col-sm-8 col-md-7 -->
        </div><!-- /.row -->
@endsection
