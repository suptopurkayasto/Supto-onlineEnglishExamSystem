@extends('layouts.teacher')

@section('title', 'Show Definition Options')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Show Definition Options</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" method="post">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 col-md-2">
                                <label for="option">Option</label>
                            </div><!-- /.col-12 col-md-2 -->
                            <div class="col-12 col-md-10">
                                <input type="text" name="option" id="option"
                                       class="form-control @error('option') is-invalid @enderror"
                                       value="{{ $option->options }}"
                                       disabled>
                                @error('option')
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
                                        <a href="{{ route('teachers.questions.definitions.options.edit', $option->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}"
                                           class="btn bg-gradient-primary btn-block"><i class="far fa-edit mr-1"></i> Edit
                                            Definition Options
                                        </a>
                                    </div><!-- /.col col-md-6 -->
                                    <div class="col col-md-6">
                                        @if($option->definition()->count() < 1)
                                            <form action="{{ route('teachers.questions.definitions.options.destroy', 1) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-block"
                                                        onclick="return confirm('Are you sure you want to delete: {{ $option->options }}')"><i
                                                        class="fas fa-trash-alt mr-1"></i> Delete Definition Options
                                                </button>
                                            </form>
                                        @endif
                                    </div><!-- /.col col-md-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.col-12 col-md-10 -->
                        </div><!-- /.form-group -->

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
