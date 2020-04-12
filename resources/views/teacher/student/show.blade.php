@extends('layouts.teacher')

@section('title', 'Show student - ' . $student->name)

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Show Student</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                            <label for="location">Location</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <select name="location" id="location" class="form-control @error('location') is-invalid @enderror"
                                    readonly>
                                <option selected
                                        value="{{ $authTeacher->location->id }}">{{ $authTeacher->location->name }}</option>
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
                            <label for="group">Group</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <select name="group" id="group" class="form-control @error('group') is-invalid @enderror" readonly>
                                <option>{{ $student->group->name }}</option>
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
                            <select name="section" id="section" class="form-control  @error('section') is-invalid @enderror"
                                    readonly>
                                <option>{{ $student->section->name }}</option>
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
                                   disabled>
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
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror" value="{{ $student->email }}"
                                   disabled>
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
                            <div class="row">
                                <div class="col col-md-6">
                                    <a href="{{ route('teacher.students.edit', $student->id) }}"
                                       class="btn bg-gradient-primary btn-block"><i class="fas fa-edit mr-1"></i> Edit Student</a>
                                </div><!-- /.col col-md-6 -->
                                <div class="col col-md-6">
                                    <form action="{{ route('teacher.students.destroy', $student->id) }}" method="post"
                                          class="ml-3">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn bg-gradient-danger btn-block"
                                                onclick="return confirm('Are you sure you want to delete: {{ $student->name }}')">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete Student
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
