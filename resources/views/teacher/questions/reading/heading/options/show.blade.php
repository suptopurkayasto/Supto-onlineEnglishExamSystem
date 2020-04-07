@extends('layouts.teacher')

@section('title', 'Show Extra Heading')


@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="h3 card-title">Show Extra Heading</h3>
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
                                       value="{{ $option->headings }}"
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
                                        <a href="{{ route('teachers.questions.headings.options.edit', $option->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}"
                                           class="btn bg-gradient-primary btn-block"><i class="far fa-edit mr-1"></i> Edit
                                            Extra Heading
                                        </a>
                                    </div><!-- /.col col-md-6 -->
                                    <div class="col col-md-6">
                                        @if($option->heading()->count() < 1)
                                            <form action="{{ route('teachers.questions.headings.options.destroy', $option->id) }}?exam={{ request()->get('exam') }}&set={{ request()->get('set') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-block"
                                                        onclick="return confirm('Are you sure you want to delete: {{ $option->headings }}')"><i
                                                        class="fas fa-trash-alt mr-1"></i> Delete Extra Heading
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
