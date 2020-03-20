@extends('layouts.admin')

@section('title', 'Teacher show - ' . $teacher->name)

@section('content-title', 'Teacher - ' . $teacher->name)

@section('content')

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 col-md-4">
                    <label for="name">Teacher name</label>
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8">
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror" value="{{ $teacher->name }}"
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
                    <label for="email">Teacher email</label>
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8">
                    <input type="text" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror" value="{{ $teacher->email }}"
                           disabled>
                    @error('email')
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
                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn bg-gradient-warning">Edit</a>
                    <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="post"
                          class="ml-3">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn bg-gradient-danger"
                                onclick="return confirm('Are you sure delete {{ $teacher->name }} all information !')">
                            Delete
                        </button>
                    </form>
                </div><!-- /.col-12 col-md-8 -->
            </div><!-- /.form-group -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
