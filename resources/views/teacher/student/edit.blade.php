@extends('layouts.teacher')

@section('title', 'Edit student - ' . $student->name)

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Student</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('teacher.students.update', $student->id_number) }}" method="post">
                @method('PATCH')
                @csrf

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="location">Student location</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                            <option selected value="{{ auth()->guard('teacher')->user()->location->id }}">{{ auth()->guard('teacher')->user()->location->name }}</option>
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
                        <label for="name">Student name</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror" value="{{ $student->name }}"
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
                        <label for="group">Student group</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="group" id="group" class="form-control @error('group') is-invalid @enderror">
                            <option disabled>Select group</option>
                            @foreach($groups as $group)
                                <option
                                    @if($group->id === $student->group->id)
                                    selected
                                    @endif
                                    value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('group')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group row -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="section">Student section</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <select name="section" id="section"
                                class="form-control  @error('section') is-invalid @enderror">
                            <option disabled>Select section</option>
                            @foreach($sections as $section)
                                <option
                                    @if($section->id === $student->section->id)
                                    selected
                                    @endif
                                    value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @error('section')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group row -->

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="email">Student email</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror" value="{{ $student->email }}"
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
                            <input type="checkbox" checked class="custom-control-input" id="updatePassword">
                            <label class="custom-control-label" for="updatePassword">Update password</label>
                        </div>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

                <div id="updatePasswordSec" class="">
                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                            <label for="password">Student password</label>
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
                            <label for="password_confirmation">Student password confirm</label>
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
                </div>


                <div class="form-group row">
                    <div class="col-12 col-md-4">
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <button type="submit" class="btn bg-gradient-primary">Update Student</button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
