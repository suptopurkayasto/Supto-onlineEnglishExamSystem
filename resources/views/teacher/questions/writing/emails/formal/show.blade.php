@extends('layouts.teacher')

@section('title', 'Show Formal Email')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Show Formal Email</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="exam">Exam</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="exam" id="exam" class="form-control @error('exam') is-invalid @enderror" disabled>
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
                                    {{ $formalEmail->set->id == $questionSet->id ? 'selected' : '' }} value="{{ $questionSet->id }}">{{ $questionSet->name }}</option>
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
                        <label for="topic">Topic</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="topic" id="topic"
                               class="form-control @error('topic') is-invalid @enderror"
                               value="{{ $formalEmail->topic }}"
                               disabled>
                        @error('topic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

            <div class="form-group row">
                <div class="col-12 col-md-4">
                    <label for="topic">Received E-mail</label>
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8">
                        <textarea type="text" rows="7" name="received_email" id="received_email"
                                  class="form-control @error('received_email') is-invalid @enderror"
                                  disabled>
                            {{ $formalEmail->received_email }}
                        </textarea>
                    @error('received_email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div><!-- /.col-12 col-md-8 -->
            </div><!-- /.form-group -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8 d-flex">
                        <a href="{{ route('teachers.questions.formal-email.edit', $formalEmail->id) }}?exam={{ request()->get('exam') }}" type="submit" class="mr-2 btn bg-gradient-primary"><i class="fas fa-edit mr-1"></i> Edit
                            formal Email
                        </a>
                        <form action="{{ route('teachers.questions.formal-email.destroy', $formalEmail->id) }}?exam={{ request()->get('exam') }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete {{ $formalEmail->topic }}')">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                                formal Email
                            </button>
                        </form>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
