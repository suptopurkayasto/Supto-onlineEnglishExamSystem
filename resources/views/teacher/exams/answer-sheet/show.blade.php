@extends('layouts.teacher')

@section('title', 'Show - '.$student->name.' Answer Sheet')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 float-left">{{ $exam->name }}</h3>
            <h3 class="h3 float-right"><a target="_blank" href="{{ route('teacher.students.show', $student->id) }}">{{ $student->name }}</a></h3>
        </div><!-- /.card-header -->
        <div class="card-body p-0">
            <div class="grammar shadow">
                <h4 class="h4 shadow-sm p-3">
                    <span class="">Grammar</span>
                    <span class="float-right font-weight-bolder">{{ $marks->grammar }}/25</span>
                </h4>
                <div class="row p-3">
                    @foreach($grammars as $index => $grammar)
                        <?php
                        $grammarQ = $exam->studentGrammars()->where(['student_id' => $student->id, 'grammar_id' => $grammar->id])->get()->first();
                        if (!empty($grammarQ)) {
                            $grammarAnswer = $grammarQ->answer;
                        }
                        ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <h6 class="h6" title="{{ $grammar->question }}">{{ $index + 1 }}. {{ $grammar->question }}</h6>
                            <ul class="list-unstyled">
                                <li>
                                    <div class="custom-control custom-radio  grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input {{ isset($grammarAnswer) ? $grammarAnswer == $grammar->option_1 ? 'checked' : '': '' }} type="radio" id="{{ $id }}" name="{{ $grammar->id }}" class="custom-control-input" disabled>
                                        <label class="custom-control-label" for="{{ $id }}">{{ $grammar->option_1 }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input {{ isset($grammarAnswer) ? $grammarAnswer == $grammar->option_2 ? 'checked' : '': '' }} type="radio" name="{{ $grammar->id }}" class="custom-control-input" disabled>
                                        <label class="custom-control-label" for="{{ $id }}">{{ $grammar->option_2 }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input {{ isset($grammarAnswer) ? $grammarAnswer == $grammar->option_3 ? 'checked' : '': '' }} type="radio" id="{{ $id }}" name="{{ $grammar->id }}" class="custom-control-input" disabled>
                                        <label class="custom-control-label" for="{{ $id }}">{{ $grammar->option_3 }}</label>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- /.col col-md-6 col-lg-4 -->
                    @endforeach
                </div><!-- /.row -->
            </div><!-- /.grammar -->
        </div><!-- /.card-body -->
    </div><!-- /.card -->
@endsection
