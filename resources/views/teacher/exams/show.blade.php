@extends('layouts.teacher')

@section('title', 'Show exam - ' . $exam->name)

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Show Exams</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <div class="form-group row">
                <div class="col-12 col-md-4">
                    <label for="name">Exam name</label>
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8">
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror" value="{{ $exam->name }}"
                           disabled>
                    @error('name')
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
                    <a href="{{ route('teacher.exams.edit', $exam->slug) }}" class="btn bg-gradient-warning">Edit Exam</a>
                    <form action="{{ route('teacher.exams.destroy', $exam->slug) }}" method="post"
                          class="ml-3">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn bg-gradient-danger"
                                onclick="return confirm('Are you sure you want to delete {{ $exam->name }} exam!')">
                            Delete Exam
                        </button>
                    </form>
                </div><!-- /.col-12 col-md-8 -->
            </div><!-- /.form-group -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
