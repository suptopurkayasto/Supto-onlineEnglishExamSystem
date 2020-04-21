@extends('layouts.teacher')

@section('title', 'Show Fill In The Gap Sentence')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Show Fill In The Gap Sentence</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" method="post">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="exam">Exam</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <select name="exam" id="exam" class="form-control @error('exam') is-invalid @enderror" disabled>
                                    <option disabled selected>Select exam</option>
                                    @foreach($authTeacher->exams as $exam)
                                        <option
                                            {{ $fillInTheGap->exam->id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
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
                                <label for="set">Set</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <select name="set" id="set"
                                        class="form-control @error('set') is-invalid @enderror" disabled>
                                    <option disabled selected>Select group</option>
                                    @foreach($sets as $set)
                                        <option
                                            {{ $fillInTheGap->set->id == $set->id ? 'selected' : '' }} value="{{ $set->id }}">{{ $set->name }}</option>
                                    @endforeach
                                </select>
                                @error('set')
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
                                       value="{{ $fillInTheGap->sentence }}"
                                       disabled>
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
                                       value="{{ $fillInTheGap->answer->options }}"
                                       disabled>
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
                                        <a href="{{ route('teachers.questions.fill-in-the-gaps.edit', $fillInTheGap->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}"
                                           class="btn bg-gradient-primary btn-block"><i class="far fa-edit mr-1"></i> Edit
                                            Fill In The Gap Sentence
                                        </a>
                                    </div><!-- /.col col-md-6 -->
                                    <div class="col col-md-6">
                                        <form action="{{ route('teachers.questions.fill-in-the-gaps.destroy', $fillInTheGap->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block"
                                                    onclick="return confirm('Are you sure you want to delete: {{ $fillInTheGap->sentence }}')"><i
                                                    class="fas fa-trash-alt mr-1"></i> Delete Fill In The Gap Sentence
                                            </button>
                                        </form>
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
