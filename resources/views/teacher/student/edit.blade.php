@extends('layouts.teacher')

@section('title', 'Edit student - ' . $student->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Edit Student</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('teacher.students.update', $student->id) }}" method="post">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="location">Location</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                                    <option selected value="{{ $authTeacher->location->id }}">{{ $authTeacher->location->name }}</option>
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
                                       class="form-control @error('name') is-invalid @enderror" value="{{ $student->name }}"
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
                                <label for="group">Group</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
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
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="section">Section</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
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
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="phone_number">Phone Number</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="phone_number" id="phone_number"
                                       class="form-control @error('phone_number') is-invalid @enderror" value="{{ $student->phone_number }}"
                                       required>
                                @error('phone_number')
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
                                       class="form-control @error('email') is-invalid @enderror" value="{{ $student->email }}"
                                >
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
                        </div>


                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <button type="submit" class="btn bg-gradient-primary btn-block"><i class="fas fa-check mr-1"></i> Update Student</button>
                                    </div><!-- /.col col-md-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-md-8 -->
    </div><!-- /.row -->
@endsection
