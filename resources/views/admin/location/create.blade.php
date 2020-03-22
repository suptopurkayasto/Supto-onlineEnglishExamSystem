@extends('layouts.admin')

@section('title', 'Location add')

@section('content-title', 'Location Add')

@section('content')

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.locations.store') }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="name">Location name</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                               required>
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
                    <div class="col-12 col-md-8">
                        <button type="submit" class="btn bg-gradient-primary">Add Location</button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
