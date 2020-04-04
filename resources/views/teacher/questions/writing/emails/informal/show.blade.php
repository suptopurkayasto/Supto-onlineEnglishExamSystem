@extends('layouts.teacher')

@section('title', 'Show Informal Email')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Show Informal Email</h3>
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
                                @foreach($authTeacherExams as $authTeacherExam)
                                    <option
                                        {{ $informalEmail->exam->id == $authTeacherExam->id ? 'selected' : '' }} value="{{ $authTeacherExam->id }}">{{ $authTeacherExam->name }}</option>
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
                                    class="form-control @error('questionSet') is-invalid @enderror" disabled>
                                <option disabled selected>Select group</option>
                                @foreach($questionSets as $questionSet)
                                    <option
                                        {{ $informalEmail->set->id == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
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
                            <label for="topic">Topic</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <input type="text" name="topic" id="topic"
                                   class="form-control @error('topic') is-invalid @enderror"
                                   value="{{ $informalEmail->topic }}"
                                   disabled>
                            @error('topic')
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
                                    <a href="{{ route('teachers.questions.informal-email.edit', $informalEmail->id) }}?exam={{ request()->get('exam') }}"
                                       type="submit" class=" btn btn-block bg-gradient-primary"><i class="fas fa-edit mr-1"></i>
                                        Edit
                                        Informal Email
                                    </a>
                                </div><!-- /.col col-md-6 -->
                                <div class="col col-md-6">
                                    <form
                                        action="{{ route('teachers.questions.informal-email.destroy', $informalEmail->id) }}?exam={{ request()->get('exam') }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn  btn-block btn-danger"
                                                onclick="return confirm('Are you sure you want to delete {{ $informalEmail->topic }}')">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                            Informal Email
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
