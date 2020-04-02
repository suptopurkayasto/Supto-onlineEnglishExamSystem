@extends('layouts.teacher')

@section('title', 'Add Synonym Word')


@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Add Synonym Word</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('teachers.questions.synonyms.store') }}" method="post">
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
                                class="form-control @error('questionSet') is-invalid @enderror" autofocus>
                            <option disabled selected>Select Set</option>
                            @foreach($questionSets as $questionSet)
                                <option
                                    @if(old('questionSet') == $questionSet->id)
                                        selected
                                    @elseif(request()->has('set'))
                                        @if(decrypt(request()->get('set')) === $questionSet->id)
                                            selected
                                        @endif
                                    @endif
                                    value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
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
                               value="{{ old('word') }}"
                               required>
                        @error('word')
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
                               class="form-control @error('answer') is-invalid @enderror"
                               value="{{ old('answer') }}"
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
                        <button type="submit" class="btn bg-gradient-primary"><i class="fas fa-check"></i> Add
                            Synonym Word
                        </button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
