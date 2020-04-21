@extends('layouts.teacher')

@section('title', 'Show Heading')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Show Heading</h3>
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
                                            {{ $heading->exam->id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
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
                                            {{ $heading->set->id == $set->id ? 'selected' : '' }} value="{{ $set->id }}">{{ $set->name }}</option>
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
                                <label for="heading">Heading</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="heading" id="heading"
                                       class="form-control @error('heading') is-invalid @enderror"
                                       value="{{ $heading->answer->headings }}"
                                       disabled>
                                @error('heading')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="paragraph">Paragraph</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <textarea rows="7" type="text" name="paragraph" id="paragraph"
                                       class="form-control @error('paragraph') is-invalid @enderror"
                                       disabled>{{ $heading->paragraph }}</textarea>
                                @error('paragraph')
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
                                        <a href="{{ route('teachers.questions.headings.edit', $heading->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}"
                                           class="btn bg-gradient-primary btn-block"><i class="far fa-edit mr-1"></i> Edit
                                            Heading
                                        </a>
                                    </div><!-- /.col col-md-6 -->
                                    <div class="col col-md-6">
                                        <form action="{{ route('teachers.questions.headings.destroy', $heading->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block"
                                                    onclick="return confirm('Are you sure you want to delete this heading')"><i
                                                    class="fas fa-trash-alt mr-1"></i> Delete Heading
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
