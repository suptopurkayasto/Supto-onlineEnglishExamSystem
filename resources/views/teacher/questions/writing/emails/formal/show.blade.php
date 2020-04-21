@extends('layouts.teacher')

@section('title', 'Show Formal Email')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Show Formal Email</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                            <label for="exam">Exam</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <select name="exam" id="exam" class="form-control @error('exam') is-invalid @enderror"
                                    disabled>
                                <option disabled selected>Select exam</option>
                                @foreach($authTeacher->exams as $exam)
                                    <option
                                        {{ $formalEmail->exam->id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
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
                                        {{ $formalEmail->set->id == $set->id ? 'selected' : '' }} value="{{ $set->id }}">{{ $set->name }}</option>
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
                            <label for="topic">Topic</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <textarea type="text" name="topic" id="topic" rows="4"
                                      class="form-control @error('topic') is-invalid @enderror"
                                      disabled>{{ $formalEmail->topic }}</textarea>
                            @error('topic')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.col-12 col-md-10 -->
                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                            <label for="topic">Received E-mail</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                        <textarea type="text" rows="7" name="received_email" id="received_email"
                                  class="form-control @error('received_email') is-invalid @enderror"
                                  disabled>{{ $formalEmail->received_email }}</textarea>
                            @error('received_email')
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
                                    <a href="{{ route('teachers.questions.formal-email.edit', $formalEmail->id) }}?exam={{ request()->get('exam') }}"
                                       type="submit" class="mr-2 btn bg-gradient-primary btn-block"><i
                                            class="fas fa-edit mr-1"></i> Edit
                                        formal Email
                                    </a>
                                </div><!-- /.col col-md-6 -->
                                <div class="col col-md-6">
                                    <form
                                        action="{{ route('teachers.questions.formal-email.destroy', $formalEmail->id) }}?exam={{ request()->get('exam') }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return confirm('Are you sure you want to delete {{ $formalEmail->topic }}')">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                            formal Email
                                        </button>
                                    </form>
                                </div><!-- /.col col-md-6 -->
                            </div><!-- /.row -->
                        </div><!-- /.col-12 col-md-10 -->
                    </div><!-- /.form-group -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-md-8 -->
    </div><!-- /.row -->
@endsection
