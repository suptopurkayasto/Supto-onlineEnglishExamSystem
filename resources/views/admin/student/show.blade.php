@extends('layouts.admin')

@section('title', 'Show Student - ' . $student->name)

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Show Students</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                            <label for="location">Location</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <select name="location" id="location" class="form-control" disabled>
                                <option>{{ $student->location->name }}</option>
                            </select>
                        </div><!-- /.col-12 col-md-10 -->
                    </div><!-- /.form-group row -->
                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                            <label for="creator">Creator</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <select name="creator" id="creator" class="form-control" disabled>
                                <option>{{ $student->teacher->name }}</option>
                            </select>
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
                            <select name="group" id="group" class="form-control @error('group') is-invalid @enderror" disabled>
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
                            <select name="section" id="section" class="form-control  @error('section') is-invalid @enderror" disabled>
                                <option >{{ $student->section->name }}</option>
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
                                    <a href="{{ route('admin.students.index') }}" class="btn btn-primary btn-block"><i class="fas fa-arrow-alt-circle-left mr-1"></i> Go back</a>
                                </div><!-- /.col col-md-6 -->
                            </div><!-- /.row -->
                        </div><!-- /.col-12 col-md-10 -->
                    </div><!-- /.form-group -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.col-12 col-sm-8 col-md-6 -->
    </div><!-- /.row justify-content-center -->
@endsection
