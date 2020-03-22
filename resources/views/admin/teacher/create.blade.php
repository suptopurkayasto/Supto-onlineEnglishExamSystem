@extends('layouts.admin')

@section('title', 'Teacher add')

@section('content-title', 'Teacher Add')

@section('content')

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.teachers.store') }}" method="post">
                @csrf

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="location">Teacher location</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                            <option disabled selected>Select location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group row -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="name">Teacher name</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                               required>
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
                               class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                               required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="password">Teacher password</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->


                </div><!-- /.form-group -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="password_confirmation">Teacher password confirm</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               required>
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

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <button type="submit" class="btn bg-gradient-primary">Add Teacher</button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
