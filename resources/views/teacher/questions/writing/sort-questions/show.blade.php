@extends('layouts.teacher')

@section('title', 'Show Sort Question')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Show Sort Question</h3>
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
                            @foreach($authTeacher->exams as $exam)
                                <option
                                    {{ $sortQuestion->exam->id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
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
                                    {{ $sortQuestion->set->id == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
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
                               value="{{ $sortQuestion->question }}"
                               disabled>
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
                        <a href="{{ route('teachers.questions.sort-questions.edit', $sortQuestion->id) }}?exam={{ request()->get('exam') }}"
                           class="btn bg-gradient-primary"><i class="far fa-edit mr-1"></i> Edit
                            Dialog
                        </a>
                        <form action="{{ route('teachers.questions.sort-questions.destroy', $sortQuestion->id) }}?exam={{ request()->get('exam') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete: {{ $sortQuestion->question }}')"><i
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
