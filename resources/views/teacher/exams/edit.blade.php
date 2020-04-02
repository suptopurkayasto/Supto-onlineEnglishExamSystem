@extends('layouts.teacher')

@section('title', 'Edit exam - ' . $exam->name)

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Exam</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('teacher.exams.update', $exam->id) }}" method="post">
                @method('PATCH')
                @csrf

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="name">Exam name</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror" value="{{ $exam->name }}"
                               >
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
                    <div class="col-12 col-md-8">
                        <button type="submit" class="btn bg-gradient-primary"><i class="fas fa-check mr-1"></i> Update Exam</button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
