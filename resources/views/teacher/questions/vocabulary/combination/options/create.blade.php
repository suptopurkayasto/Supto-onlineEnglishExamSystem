@extends('layouts.teacher')

@section('title', 'Add Combination Option')


@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="h3 card-title">Add Combination Option</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('teachers.questions.combinations.options.store') }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}" method="post">
                @csrf

                <div class="form-group row">
                    <div class="col-12 col-md-4">
                        <label for="option">Option</label>
                    </div><!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-8">
                        <input type="text" name="option" id="option"
                               class="form-control @error('option') is-invalid @enderror"
                               value="{{ old('option') }}"
                               required autofocus>
                        @error('option')
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
                        <button type="submit" class="btn bg-gradient-primary"><i class="fas fa-check"></i> Add
                            Definition Option
                        </button>
                    </div><!-- /.col-12 col-md-8 -->
                </div><!-- /.form-group -->

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
