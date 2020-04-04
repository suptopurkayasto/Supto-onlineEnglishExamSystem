@extends('layouts.teacher')

@section('title', 'Show exam - ' . $exam->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Show Exam</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                            <label for="name">Exam name</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror" value="{{ $exam->name }}"
                                   disabled>
                            @error('name')
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
                                    <a href="{{ route('teacher.exams.edit', $exam->id) }}" class="btn bg-gradient-primary btn-block"><i
                                            class="fas fa-edit mr-1"></i> Edit Exam</a>
                                </div><!-- /.col col-md-6 -->
                                <div class="col col-md-6">
                                    <form action="{{ route('teacher.exams.destroy', $exam->id) }}" method="post"
                                          class="ml-3">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn bg-gradient-danger btn-block"
                                                onclick="return confirm('Are you sure you want to delete exam!')">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete Exam
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
