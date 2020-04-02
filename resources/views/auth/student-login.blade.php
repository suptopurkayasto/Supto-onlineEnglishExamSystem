@extends('layouts.app')

@section('title', 'Student Login')

@section('content')
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-4">
                <div class="card login-form shadow-lg">
                    <div class="icon-wrp shadow">
                        <i class="fas fa-user-graduate fa-4x text-primary"></i>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('student.login.submit') }}" class="">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-at"></i></div>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                </div>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Remember me</label>
                                </div>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                            </div><!-- /.form-group -->
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
{{--                <div class="card login-card shadow">--}}
{{--                    <div class="card-header">{{ __('Student Login') }}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        <form method="POST" action="{{ route('student.login.submit') }}">--}}
{{--                            @csrf--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                    @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                    @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <div class="col-md-6 offset-md-4">--}}
{{--                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                                        <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row mb-0">--}}
{{--                                <div class="col-md-8 offset-md-4">--}}
{{--                                    <button type="submit" class="btn btn-primary w-25">--}}
{{--                                        {{ __('Login') }}--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
