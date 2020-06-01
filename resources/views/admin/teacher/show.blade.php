@extends('layouts.admin')

@section('title', 'Show Teacher - ' . $teacher->name)

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
                    <div class="form-group row">
                        <div class="col-12 col-md-2">
                            <label for="location">Location</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <select name="location" id="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    readonly="">
                                <option>{{ $teacher->location->name }}</option>

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
                                   class="form-control @error('name') is-invalid @enderror" value="{{ $teacher->name }}"
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
                            <label for="email">Email</label>
                        </div><!-- /.col-12 col-md-2 -->
                        <div class="col-12 col-md-10">
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ $teacher->email }}"
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
                            <div class="form-row">
                                <div class="col col-md-4">
                                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                       class="btn btn-primary btn-block"><i class="fas fa-edit mr-1"></i> Edit</a>
                                </div><!-- /.col col-md-4 -->
                                <div class="col col-md-4">
                                    <form action="{{ route('admin.teachers.status', $teacher->id) }}" method="post"
                                          class="">
                                        @method('PATCH')
                                        @csrf
                                        @if($teacher->profile_status)
                                            <button type="submit" class="btn btn-warning btn-block"
                                                    onclick="return confirm('Are you sure you want pending this teacher profile')">
                                                <i class="fas fa-spinner mr-1"></i> Pending
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success btn-block"
                                                    onclick="return confirm('Are you sure you want to approve this teacher profile')">
                                                <i class="fas fa-check-circle mr-1"></i> Approve
                                            </button>
                                        @endif
                                    </form>
                                </div><!-- /.col col-md-4 -->
                                <div class="col col-md-4">
                                    <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="post"
                                          class="">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return confirm('Are you sure you want to delete?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div><!-- /.col col-md-4 -->
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
