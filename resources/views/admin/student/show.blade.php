@extends('layouts.admin')

@section('title', 'Student show - ' . $student->name)

@section('content-title', $student->name)

@section('content')

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">

            <div class="form-group row">
                <div class="col-12 col-md-4">
                    <label for="name">Student name</label>
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8">
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror" value="{{ $student->name }}"
                           readonly>
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
                    <select name="group" id="group" class="form-control @error('group') is-invalid @enderror" readonly>
                        <option>{{ $student->group->name }}</option>
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
                    <select name="section" id="section" class="form-control  @error('section') is-invalid @enderror" readonly>
                        <option >{{ $student->section->name }}</option>
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
                    <input type="text" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror" value="{{ $student->email }}"
                           readonly>
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
                    <a href="{{ route('admin.students.edit', $student->id_number) }}" class="btn bg-gradient-warning">Edit</a>
                    <form action="{{ route('admin.students.destroy', $student->id_number) }}" method="post"
                          class="ml-3">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn bg-gradient-danger"
                                onclick="return confirm('Are you sure delete {{ $student->name }} all information !')">
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
