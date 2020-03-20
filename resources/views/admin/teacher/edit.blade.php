@extends('layouts.admin')

@section('title', 'Teacher Edit - ' . $teacher->name)

@section('content-title', 'Edit teacher - ' . $teacher->name)

@section('content')

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="name">Teacher name</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror" value="{{ $teacher->name }}"
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
                        <label for="email">Teacher email</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror" value="{{ $teacher->email }}"
                               >
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
                    <div class="col-12 col-md-8">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="updatePassword">
                            <label class="custom-control-label" for="updatePassword">Update password</label>
                        </div>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->


                <div id="updatePasswordSec" class="d-none">
                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                            <label for="password"> password</label>
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                            >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div><!-- /.col-12 col-md-8 -->


                    </div><!-- /.form-group -->

                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                            <label for="password_confirmation"> password confirm</label>
                        </div><!-- /.col-12 col-md-4 -->
                        <div class="col-12 col-md-8">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                            >
                            @error('password_confirmation')
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
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="showHide">
                                <label class="custom-control-label" for="showHide">Show Password</label>
                            </div>
                        </div><!-- /.col-12 col-md-8 -->
                    </div><!-- /.form-group -->
                </div><!-- /.updatePasswordSec -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <button type="submit" class="btn bg-gradient-primary">Update </button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
