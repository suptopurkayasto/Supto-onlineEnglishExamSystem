@extends('layouts.teacher')

@section('title', 'Edit Definition Sentence')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Edit Definition Sentence</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('teachers.questions.definitions.update', $definition->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="exam">Exam</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <select name="exam" id="exam" class="form-control @error('exam') is-invalid @enderror" required>
                                    <option disabled selected>Select exam</option>
                                    @foreach($authTeacher->exams as $exam)
                                        <option
                                            {{ $definition->exam->id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                                    @endforeach
                                </select>
                                @error('exam')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="questionSet">Question Set</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <select name="questionSet" id="questionSet"
                                        class="form-control @error('questionSet') is-invalid @enderror" required>
                                    <option disabled selected>Select Set</option>
                                    @foreach($questionSets as $questionSet)
                                        <option
                                            {{ $definition->set->id == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
                                    @endforeach
                                </select>
                                @error('questionSet')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="sentence">Sentence</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="sentence" id="sentence"
                                       class="form-control @error('sentence') is-invalid @enderror"
                                       value="{{ $definition->sentence }}"
                                       required>
                                @error('sentence')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="answer">Answer</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="answer" id="answer"
                                       class="form-control @error('answer') is-invalid @enderror"
                                       value="{{ $definition->answer->options }}"
                                >
                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <button type="submit" class="btn bg-gradient-primary btn-block"><i class="fas fa-check mr-1"></i> Update
                                            Definition Sentence
                                        </button>
                                    </div><!-- /.col col-md-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-md-8 -->
    </div><!-- /.row -->
@endsection
