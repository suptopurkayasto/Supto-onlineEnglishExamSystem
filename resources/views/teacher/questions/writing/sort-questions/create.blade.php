@extends('layouts.teacher')

@section('title', 'Add Sort Question')


@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Add Sort Question</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('teachers.questions.sort-questions.store') }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="exam">Exam</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="exam" id="exam" class="form-control @error('exam') is-invalid @enderror">
                            <option disabled selected>Select exam</option>
                            @foreach($authTeacher->exams as $exam)
                                <option
                                    {{ old('exam') == $exam->id || decrypt(request()->get('exam')) === $exam->id ? 'selected' : '' }}
                                    value="{{ $exam->id }}">
                                    {{ $exam->name }}
                                </option>
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
                            <option disabled selected>Select Set</option>
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
                        <label for="question">Question</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="question" id="question"
                               class="form-control @error('question') is-invalid @enderror"
                               value="{{ old('question') }}"
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
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <button type="submit" class="btn bg-gradient-primary"><i class="fas fa-check"></i> Add
                            Sort Question
                        </button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
