@extends('layouts.teacher')

@section('title', 'Show Synonym Word')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Show Synonym Word</h3>
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
                                    {{ $synonym->exam->id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
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
                                    {{ $synonym->set->id == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
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
                        <label for="word">Word</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="word" id="word"
                               class="form-control @error('word') is-invalid @enderror"
                               value="{{ $synonym->word }}"
                               disabled>
                        @error('word')
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
                        <a href="{{ route('teachers.questions.synonyms.edit', $synonym->id) }}"
                           class="btn bg-gradient-primary"><i class="far fa-edit mr-1"></i> Edit
                            Synonym Word
                        </a>
                        <form action="{{ route('teachers.questions.synonyms.destroy', $synonym->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete: {{ $synonym->word }}')"><i
                                    class="fas fa-trash-alt mr-1"></i> Delete Synonym Word
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
