@extends('layouts.teacher')

@section('title', 'Add Exam')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title" style="text-align: center !important;">Add Exam</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('teacher.exams.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Exam name</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                   required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.form-group -->

                        <div class="form-group text-center">
                            <button type="submit" class="btn bg-gradient-primary w-75">
                                <i class="fas fa-check mr-1"></i>
                                Add Exam
                            </button>
                        </div><!-- /.form-group -->
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-sm-8 col-md-6 -->
    </div><!-- /.row -->
@endsection
