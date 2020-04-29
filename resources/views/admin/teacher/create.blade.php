@extends('layouts.admin')

@section('title', 'Teacher add')


@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Teacher add</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.teachers.store') }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="location">Location</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
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
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="name">Name</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="name" id="name"
                                       class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                       required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="email">Email</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                       required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="password">Password</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="password" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.col-12 col-md-10 -->


                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="password_confirmation">Password confirm</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       required>
                                @error('password_confirmation')
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
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="showHide">
                                    <label class="custom-control-label" for="showHide">Show Password</label>
                                </div>
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <button type="submit" class="btn btn-block btn-primary"><i
                                                class="fas fa-check-circle mr-1"></i> Add Teacher</button>
                                    </div><!-- /.col col-md-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-sm-8 col-md-6 -->
    </div><!-- /.row justify-content-center -->
@endsection
