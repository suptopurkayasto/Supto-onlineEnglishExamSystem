@extends('layouts.admin')

@section('title', 'Edit Teacher - ' . $teacher->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <div class="card shadow">
                <img class="card-img-top img-thumbnail border-0" src="{{ Gravatar::get($teacher->email, ['size' => 1080]) }}" alt="{{ $teacher->name }}" title="{{ $teacher->name }}">
                <div class="card-header text-center">
                    <h3 class="h3 font-weight-bolder mb-0">{{ $teacher->name }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="post">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="location">Location</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <select name="location" id="location"
                                        class="form-control @error('location') is-invalid @enderror">
                                    <option disabled>Select location</option>
                                    @foreach($locations as $location)
                                        <option
                                            @if($location->id === $teacher->location->id)
                                            selected
                                            @endif
                                            value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                                @error('teacher')
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
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ $teacher->name }}"
                                >
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
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ $teacher->email }}"
                                       autocomplete="false">
                                @error('email')
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
                                    <input type="checkbox" checked class="custom-control-input" id="updatePassword">
                                    <label class="custom-control-label" for="updatePassword">Update password</label>
                                </div>
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                        <div id="updatePasswordSec" class="">
                            <div class="form-group row">
                                <div class="col-12 col-md-2">
                                    <label for="password">Password</label>
                                </div><!-- /.col-12 col-md-2 -->
                                <div class="col-12 col-md-10">
                                    <input type="password" name="password" id="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           autocomplete="nope"
                                    >
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
                                    >
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
                        </div><!-- /.updatePasswordSec -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check-circle mr-1"></i> Update Teacher</button>
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
