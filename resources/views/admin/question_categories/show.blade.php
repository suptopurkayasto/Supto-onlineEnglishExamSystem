@extends('layouts.admin')

@section('title', 'Question category show - ' . $questionCategory->name)

@section('content-title',$questionCategory->name)

@section('content')

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 col-md-4">
                    <label for="name">Question category name</label>
                </div><!-- /.col-12 col-md-4 -->
                <div class="col-12 col-md-8">
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror" value="{{ $questionCategory->name }}"
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
                <div class="col-12 col-md-8 d-flex">
                    <a href="{{ route('admin.question-categories.edit', $questionCategory->slug) }}" class="btn bg-gradient-warning">Edit</a>
                    <form action="{{ route('admin.question-categories.destroy', $questionCategory->slug) }}" method="post"
                          class="ml-3">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn bg-gradient-danger"
                                onclick="return confirm('Are you sure delete {{ $questionCategory->name }} all information!')">
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
