@extends('layouts.teacher')

@section('title', 'Edit Grammar Question - ' . $grammar->name)

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Grammar Question</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('teachers.questions.grammars.update', $grammar->id) }}?exam={{ request()->get('exam') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group ">
                            <label for="exam">Exam name</label>
                            <select name="exam" id="exam"
                                    class="form-control @error('exam') is-invalid @enderror" autofocus>
                                <option selected>Select exam</option>
                                @foreach($authTeacher->exams as $exam)
                                    <option {{ $exam->id == $grammar->exam->id ? 'selected' : ''  }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                                @endforeach
                            </select>
                            @error('exam')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.form-group row -->

                        <div class="form-group">
                            <label for="question_set">Question set</label>
                            <select name="question_set" id="question_set"
                                    class="form-control @error('question_set') is-invalid @enderror" >
                                <option disabled>Select question set</option>
                                @foreach($questionSets as $set)
                                    <option {{ $set->id == $grammar->set->id ? 'selected' : ''  }} value="{{ $set->id }}">{{ $set->name }}</option>
                                @endforeach
                            </select>
                            @error('question_set')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.form-group row -->

                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" name="question" id="question"
                                   class="form-control @error('question') is-invalid @enderror" value="{{ $grammar->question }}"
                            >
                            @error('question')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="option_1">Option 1</label>
                            <input type="text" name="option_1" id="option_1"
                                   class="form-control @error('option_1') is-invalid @enderror" value="{{ $grammar->option_1 }}"
                            >
                            @error('option_1')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="option_2">Option 2</label>
                            <input type="text" name="option_2" id="option_2"
                                   class="form-control @error('option_2') is-invalid @enderror" value="{{ $grammar->option_2 }}"
                            >
                            @error('option_2')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="option_3">Option 3</label>
                            <input type="text" name="option_3" id="option_3"
                                   class="form-control @error('option_3') is-invalid @enderror" value="{{ $grammar->option_3 }}"
                            >
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
                            >
                            @error('answer')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.form-group -->

                        <div class="form-group row justify-content-center">
                            <div class="col-12 col-md-8">
                                <button type="submit" class="btn btn-block bg-gradient-primary"><i class="fas fa-check mr-1"></i> Update Question</button>
                            </div><!-- /.col-12 col-md-8 -->
                        </div><!-- /.form-group -->
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-sm-8 col-md-7 -->
    </div><!-- /.row -->
@endsection
