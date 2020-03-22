@extends('layouts.admin')

@section('title', 'Location show - ' . $location->name)

@section('content-title', $location->name)

@section('content')

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">

            <div class="form-group row">
                <div class="col-12 col-md-4">
                    <label for="name">Location name</label>
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8">
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror" value="{{ $location->name }}"
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
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8 d-flex justify-content-between">
                    <a href="{{ route('admin.locations.edit', $location->slug) }}" class="btn bg-gradient-warning">Edit</a>

                    <form action="{{ route('admin.locations.destroy', $location->slug) }}" method="post"
                          class="ml-3">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn bg-gradient-danger"
                                onclick="return confirm('Are you sure delete location')">
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
