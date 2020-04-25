@extends('layouts.teacher')

@section('title', 'Show - '.$student->name.' Answer Sheet')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="h3 float-left">{{ $exam->name }}</h3>
            <h3 class="h3 float-right"><a target="_blank"
                                          href="{{ route('teacher.students.show', $student->id) }}">{{ $student->name }}</a>
            </h3>
        </div><!-- /.card-header -->
        <div class="card-body p-0">


            <div class="grammar">
                <h4 class="bg-primary h4 shadow-sm p-3 font-weight-bolder">
                    <span class="">Grammar</span>
                    <span class="float-right">{!! $marks->grammar === NULL ? '<span class="badge badge-warning mr-1">Pending</span>' : $marks->grammar !!}/25</span>
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
                            <h6 class="h6" title="{{ $grammar->question }}">{{ $index + 1 }}
                                . {{ $grammar->question }}</h6>
                            <ul class="list-unstyled">
                                <li>
                                    <div class="custom-control custom-radio  grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input
                                            {{ isset($grammarAnswer) ? $grammarAnswer == $grammar->option_1 ? 'checked' : '': '' }} type="radio"
                                            id="{{ $id }}" name="{{ $grammar->id }}" class="custom-control-input"
                                            disabled>
                                        <label class="custom-control-label"
                                               for="{{ $id }}">{{ $grammar->option_1 }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input
                                            {{ isset($grammarAnswer) ? $grammarAnswer == $grammar->option_2 ? 'checked' : '': '' }} type="radio"
                                            name="{{ $grammar->id }}" class="custom-control-input" disabled>
                                        <label class="custom-control-label"
                                               for="{{ $id }}">{{ $grammar->option_2 }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input
                                            {{ isset($grammarAnswer) ? $grammarAnswer == $grammar->option_3 ? 'checked' : '': '' }} type="radio"
                                            id="{{ $id }}" name="{{ $grammar->id }}" class="custom-control-input"
                                            disabled>
                                        <label class="custom-control-label"
                                               for="{{ $id }}">{{ $grammar->option_3 }}</label>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- /.col col-md-6 col-lg-4 -->
                    @endforeach
                </div><!-- /.row -->
            </div><!-- /.grammar -->


            <div class="vocabulary">
                <h4 class="h4 bg-primary shadow-sm p-3 font-weight-bolder">
                    <span class="">Vocabulary</span>
                    <span class="float-right">{!! $marks->synonym === NULL ? '<span class="badge badge-warning mr-1">Pending</span>' : $marks->synonym + $marks->definition + $marks->combination + $marks->fillInTheGap !!} /</span>
                </h4>
                <div class="row p-3">
                    <!-- Start: Synonym -->
                    <div class="col-12 col-md-6">
                        <h5 class="h5 p-3 font-weight-bold mb-0">
                            Synonym {{ $marks->synonym !== NULL ? '('.$marks->synonym.')' : '' }}</h5>
                        <table class="table table-striped table-hover table-borderless shadow-sm">
                            <thead>
                            <tr class="">
                                <th>Word</th>
                                <th class="text-right">Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($synonyms as $index => $synonym)
                                <?php
                                $studentQuestion = $exam->studentSynonyms()->where(['student_id' => $student->id, 'synonym_id' => $synonym->id])->get()->first();
                                if (!empty($studentQuestion)) {
                                    $studentAnswer = $studentQuestion->answer;
                                }
                                ?>
                                <tr>
                                    <td>{{ $synonym->word }}</td>
                                    <td class="text-right">{!! isset($studentAnswer) ? $studentAnswer : $marks->synonym === NULL ? '<span class="badge badge-warning">Pending</span>' : 'No Answered' !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: Synonym -->

                    <!-- Start: definition -->
                    <div class="col-12 col-md-6">
                        <h5 class="h5 p-3 font-weight-bold mb-0">
                            Definition {{ $marks->definition !== NULL ? '('.$marks->definition.')' : '' }}</h5>
                        <table class="table table-striped table-hover table-borderless shadow-sm">
                            <thead>
                            <tr class="">
                                <th>Sentence</th>
                                <th class="text-right">Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($definitions as $index => $definition)
                                <?php
                                $studentQuestion = $exam->studentDefinitions()->where(['student_id' => $student->id, 'definition_id' => $definition->id])->get()->first();
                                if (!empty($studentQuestion)) {
                                    $studentAnswer = $studentQuestion->answer;
                                }
                                ?>
                                <tr>
                                    <td>{{ $definition->sentence }}</td>
                                    <td class="text-right">{!! isset($studentAnswer) ? $studentAnswer : $marks->definition === NULL ? '<span class="badge badge-warning">Pending</span>' : 'No Answered' !!}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: definition -->

                    <!-- Start: Fill in the gap -->
                    <div class="col-12 col-md-6">
                        <h5 class="h5 p-3 font-weight-bold mb-0">Fill in the
                            gap {{ $marks->fillInTheGap !== NULL ? '('.$marks->fillInTheGap.')' : '' }}</h5>
                        <table class="table table-striped table-hover table-borderless shadow-sm">
                            <thead>
                            <tr class="">
                                <th>Word</th>
                                <th class="text-right">Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fillInTheGaps as $index => $fillInTheGap)
                                <?php
                                $studentQuestion = $exam->studentFillInTheGaps()->where(['student_id' => $student->id, 'fillInTheGap_id' => $fillInTheGap->id])->get()->first();
                                if (!empty($studentQuestion)) {
                                    $studentAnswer = $studentQuestion->answer;
                                }
                                ?>
                                <tr>
                                    <td>{{ $fillInTheGap->sentence }}</td>
                                    <td class="text-right">{!! isset($studentAnswer) ? $studentAnswer : $marks->fillInTheGap === NULL ? '<span class="badge badge-warning">Pending</span>' : 'No Answered' !!}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: Fill in the gap -->

                    <!-- Start: combination -->
                    <div class="col-12 col-md-6">
                        <h5 class="h5 p-3 font-weight-bold mb-0">
                            Combination {{ $marks->combination !== NULL ? '('.$marks->combination.')' : '' }}</h5>
                        <table class="table table-striped table-hover table-borderless shadow-sm">
                            <thead>
                            <tr class="">
                                <th>Word</th>
                                <th class="text-right">Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($combinations as $index => $combination)
                                <?php
                                $studentQuestion = $exam->studentCombinations()->where(['student_id' => $student->id, 'combination_id' => $combination->id])->get()->first();
                                if (!empty($studentQuestion)) {
                                    $studentAnswer = $studentQuestion->answer;
                                }
                                ?>
                                <tr>
                                    <td>{{ $combination->word }}</td>
                                    <td class="text-right">{!! isset($studentAnswer) ? $studentAnswer : $marks->combination === NULL ? '<span class="badge badge-warning">Pending</span>' : 'No Answered' !!}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: combination -->
                </div><!-- /.row -->
            </div><!-- /.vocabulary -->


            <div class="reading">
                <h4 class="h4 bg-primary shadow-sm p-3 font-weight-bolder">
                    <span class="">Reading</span>
                    <span class="float-right">{!! $marks->heading === NULL ? '<span class="badge badge-warning mr-1">Pending</span>' : $marks->heading + $marks->rearrage !!} /</span>
                </h4>
                <div class="row p-3">
                    <!-- Start: heading -->
                    <div class="col-12 col-md-8">
                        <h5 class="h5 p-3 font-weight-bold mb-0">Heading
                            Matching {{ $marks->heading !== NULL ? '('.$marks->heading.')' : '' }}</h5>
                        <table class="table table-striped table-hover table-borderless shadow-sm">
                            <thead>
                            <tr class="">
                                <th>Paragraph</th>
                                <th class="text-right">Heading</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($headings as $index => $heading)
                                <?php
                                $studentQuestion = $exam->studentHeadings()->where(['student_id' => $student->id, 'heading_id' => $heading->id])->get()->first();
                                if (!empty($studentQuestion)) {
                                    $studentAnswer = $studentQuestion->headingOption->headings;
                                }
                                ?>
                                <tr>
                                    <td title="{{ $heading->paragraph }}">{{ Str::limit($heading->paragraph, 225) }}</td>
                                    <td class="text-right">{!! isset($studentAnswer) ? $studentAnswer : $marks->heading === NULL ? '<span class="badge badge-warning">Pending</span>' : 'No Answered' !!}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-8 -->
                    <!-- End: heading -->


                    <!-- Start: rearrange -->
                    <div class="col-12 col-md-4">
                        <h5 class="h5 p-3 font-weight-bold mb-0">
                            Rearrange {{ $marks->rearrange !== NULL ? '('.$marks->rearrange.')' : '' }}</h5>
                        <table class="table table-striped table-hover table-borderless shadow-sm">
                            <thead>
                            <tr class="">
                                <th>Line</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{!! $marks->rearrange !== NULL ? $rearrange->line_1 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}</td>
                            </tr>
                            <tr>
                                <td>{!! $marks->rearrange !== NULL ? $rearrange->line_2 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}</td>
                            </tr>
                            <tr>
                                <td>{!! $marks->rearrange !== NULL ? $rearrange->line_3 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}</td>
                            </tr>
                            <tr>
                                <td>{!! $marks->rearrange !== NULL ? $rearrange->line_4 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}</td>
                            </tr>
                            <tr>
                                <td>{!! $marks->rearrange !== NULL ? $rearrange->line_5 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}</td>
                            </tr>
                            <tr>
                                <td>{!! $marks->rearrange !== NULL ? $rearrange->line_6 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}</td>
                            </tr>
                            <tr>
                                <td>{!! $marks->rearrange !== NULL ? $rearrange->line_7 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-4 -->
                    <!-- End: rearrange -->
                </div><!-- /.row -->
            </div><!-- /.reading -->


        </div><!-- /.card-body -->
    </div><!-- /.card -->
@endsection
