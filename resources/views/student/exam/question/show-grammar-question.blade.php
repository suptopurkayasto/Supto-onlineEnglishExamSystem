@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form action="{{ route('student.exam.grammar.questions.submit', $exam->id) }}" class="" method="post">
                    @csrf


                    @foreach($grammars as $index => $grammar)
                        <ul class="list-unstyled form-group">
                            <li class="mb-1">{{ $index+1 }}. {{ $grammar->question }}</li>
                            <ul class="list-unstyled ml-4">
                                <li>
                                    <div class="custom-control custom-radio">
                                        <?php $id = Str::random() ?>
                                        <input type="radio" id="{{ $id }}" name="question{{ $index+1 }}"
                                               class="custom-control-input" value="{{ $grammar->option_1 }}">
                                        <label class="custom-control-label" for="{{ $id }}">{{ $grammar->option_1 }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <?php $id = Str::random() ?>
                                        <input type="radio" id="{{ $id }}" name="question{{ $index+1 }}"
                                               class="custom-control-input" value="{{ $grammar->option_2 }}">
                                        <label class="custom-control-label" for="{{ $id }}">{{ $grammar->option_2 }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <?php $id = Str::random() ?>
                                        <input type="radio" id="{{ $id }}" name="question{{ $index+1 }}"
                                               class="custom-control-input" value="{{ $grammar->option_3 }}">
                                        <label class="custom-control-label" for="{{ $id }}">{{ $grammar->option_3 }}</label>
                                    </div>
                                </li>
                            </ul>
                        </ul>
                    @endforeach


                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Finish Grammar</button>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.col-12 col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->

    <section>
        <div id="pagination-data-container"></div>
        <div id="pagination-bar"></div>
    </section>
@endsection
