@extends('layouts.teacher')

@section('title', 'Show - '.$student->name.' Answer Sheet')

@section('content')
    <div class="card">
        <div class="card-header bg-primary border-0">
            <h3 class="h3 float-left">{{ $exam->name }}</h3>
            <h3 class="h3 float-right">
                <a target="_blank"
                   class="text-white"
                   href="{{ route('teacher.students.show', $student->id) }}">{{ $student->name }}</a>
            </h3>
        </div><!-- /.card-header -->
        <div class="card-body p-0">

            <!-- Start:: Grammar -->
            <div class="grammar">
                <h4 class="h4 p-3 font-weight-bolder">
                    <span class="">Grammar</span>
                    <span class="float-right">{!! $marks->grammar === NULL ? '<span class="badge badge-warning mr-1">Pending</span>' : $marks->grammar !!} / 25</span>
                </h4>
                <div
                    class="answer-sheet-title-border {{ $marks->grammar === NULL ? 'bg-warning' : 'bg-success' }}"></div>
                <div class="row p-3">
                    @foreach($grammars as $index => $grammar)
                        <?php
                        $studentGrammar = $exam->studentGrammars()->where(['student_id' => $student->id, 'grammar_id' => $grammar->id])->get()->first();
                        ?>
                        <div
                            class="col-12 col-md-6 col-lg-4 {{ isset($studentGrammar->answer) ? $studentGrammar->answer == $grammar->answer ? 'correct-grammar-answer': 'wrong-grammar-answer' : 'not-answer' }}"
                            title="{{ $grammar->question }}">

                            <h6 class="h6 grammar-questions-title">{{ $index + 1 }}
                                . {{ $grammar->question }}</h6>
                            <ul class="list-unstyled">
                                <li>
                                    <div class="custom-control custom-radio grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input
                                            {{ isset($studentGrammar->answer) ? $studentGrammar->answer == $grammar->option_1 ? 'checked' : '': '' }}
                                            type="radio"
                                            id="{{ $id }}" name="{{ $grammar->id }}"
                                            class="custom-control-input"
                                            disabled>
                                        <label class="custom-control-label"
                                               for="{{ $id }}">{{ $grammar->option_1 }}
                                            @if($grammar->option_1 == $grammar->answer)
                                                <i class="far fa-check-circle text-success correct-radio-icon"></i>
                                            @endif
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input
                                            {{ isset($studentGrammar->answer) ? $studentGrammar->answer == $grammar->option_2 ? 'checked' : '': '' }}
                                            type="radio"
                                            name="{{ $grammar->id }}" class="custom-control-input" disabled>
                                        <label class="custom-control-label"
                                               for="{{ $id }}">{{ $grammar->option_2 }}
                                            @if($grammar->option_2 == $grammar->answer)
                                                <i class="far fa-check-circle text-success correct-radio-icon"></i>
                                            @endif
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio grammar-answer-sheet-radio">
                                        @php($id = Str::random())
                                        <input
                                            {{ isset($studentGrammar->answer) ? $studentGrammar->answer == $grammar->option_3 ? 'checked' : '': '' }}
                                            type="radio"
                                            id="{{ $id }}" name="{{ $grammar->id }}" class="custom-control-input"
                                            disabled>
                                        <label class="custom-control-label"
                                               for="{{ $id }}">{{ $grammar->option_3 }}
                                            @if($grammar->option_3 == $grammar->answer)
                                                <i class="far fa-check-circle text-success correct-radio-icon"></i>
                                            @endif
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- /.col col-md-6 col-lg-4 -->
                    @endforeach
                </div><!-- /.row -->
            </div><!-- /.grammar -->
            <!-- End:: Grammar -->


            <!-- Start:: vocabulary -->
            <div class="vocabulary">
                <h4 class="h4 p-3 font-weight-bolder">
                    <span class="">Vocabulary</span>
                    <span class="float-right">{!! $marks->synonym === NULL ? '<span class="badge badge-warning mr-1">Pending</span>' : $marks->synonym + $marks->definition + $marks->combination + $marks->fillInTheGap !!} / 20</span>
                </h4>
                <div
                    class="answer-sheet-title-border {{ $marks->synonym === NULL ? 'bg-warning' : 'bg-success' }}"></div>
                <div class="row p-3">
                    <!-- Start: Synonym -->
                    <div class="col-12 col-md-6">
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                            Synonym {{ $marks->synonym !== NULL ? '('.$marks->synonym.')' : '' }}</h5>
                        <table
                            class="table mini-answer-sheet-table table-hover table-borderless">
                            <thead class="border-bottom {{ $marks->synonym === NULL ? 'border-warning' : 'border-success' }}">
                            <tr>
                                <th style="width: 56%;">Word</th>
                                <th style="width: 22%;" class="text-center">Student Answer</th>
                                <th style="width: 22%;" class="text-right">Correct Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($synonyms as $index => $synonym)
                                <?php
                                $studentSynonym = $exam->studentSynonyms()->where(['student_id' => $student->id, 'synonym_id' => $synonym->id])->get()->first();
                                ?>
                                <tr class="{{ isset($studentSynonym->answer) ? $studentSynonym->answer == $synonym->answer->options ? 'text-success success-row' : 'text-danger danger-row' : 'text-secondary secondary-row' }}">
                                    <td>{{ $synonym->word }}</td>
                                    <td class="text-center">
                                        @if($marks->synonym !== NULL)
                                            @if(isset($studentSynonym->answer))
                                                {{ $studentSynonym->answer }}
                                            @else
                                                <span class="badge badge-secondary">Not touched</span>
                                            @endif
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                    @endif
                                    </td>
                                    <td class="text-right"><span class="text-success font-weight-bold">{{ $synonym->answer->options }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: Synonym -->


                    <!-- Start: definition -->
                    <div class="col-12 col-md-6">
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                            Definition {{ $marks->definition !== NULL ? '('.$marks->definition.')' : '' }}</h5>
                        <table
                            class="table mini-answer-sheet-table table-hover table-borderless">
                            <thead class="border-bottom {{ $marks->definition === NULL ? 'border-warning' : 'border-success' }}">
                            <tr>
                                <th style="width: 56%;">Sentence</th>
                                <th style="width: 22%;" class="text-center">Student Answer</th>
                                <th style="width: 22%;" class="text-right">Correct Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($definitions as $index => $definition)
                                <?php
                                $studentDefinition = $exam->studentDefinitions()->where(['student_id' => $student->id, 'definition_id' => $definition->id])->get()->first();
                                ?>
                                <tr class="{{ isset($studentDefinition->answer) ? $studentDefinition->answer == $definition->answer->options ? 'text-success success-row' : 'text-danger danger-row' : 'text-secondary secondary-row' }}">
                                    <td title="{{ $definition->sentence }}">{{ Str::limit($definition->sentence, 40) }}</td>
                                    <td class="text-center">
                                        @if($marks->definition !== NULL)
                                            @if(isset($studentDefinition->answer))
                                                {{ $studentDefinition->answer }}
                                            @else
                                                <span class="badge badge-secondary">Not touched</span>
                                            @endif
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                    @endif
                                    </td>
                                    <td class="text-right"><span class="text-success font-weight-bold">{{ $definition->answer->options }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: definition -->

                    <!-- Start: fill in the gap -->
                    <div class="col-12 col-md-6">
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                            Fill in the gap {{ $marks->fillInTheGap !== NULL ? '('.$marks->fillInTheGap.')' : '' }}</h5>
                        <table
                            class="table mini-answer-sheet-table table-hover table-borderless">
                            <thead class="border-bottom {{ $marks->fillInTheGap === NULL ? 'border-warning' : 'border-success' }}">
                            <tr>
                                <th style="width: 56%;">Sentence</th>
                                <th style="width: 22%;" class="text-center">Student Answer</th>
                                <th style="width: 22%;" class="text-right">Correct Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fillInTheGaps as $index => $fillInTheGap)
                                <?php
                                $studentFillInTheGap = $exam->studentFillInTheGaps()->where(['student_id' => $student->id, 'fillInTheGap_id' => $fillInTheGap->id])->get()->first();
                                ?>
                                <tr class="{{ isset($studentFillInTheGap->answer) ? $studentFillInTheGap->answer == $fillInTheGap->answer->options ? 'text-success success-row' : 'text-danger danger-row' : 'text-secondary secondary-row' }}">
                                    <td title="{{ $fillInTheGap->sentence }}">{{ Str::limit($fillInTheGap->sentence, 40) }}</td>
                                    <td class="text-center">
                                        @if($marks->fillInTheGap !== NULL)
                                            @if(isset($studentFillInTheGap->answer))
                                                {{ $studentFillInTheGap->answer }}
                                            @else
                                                <span class="badge badge-secondary">Not touched</span>
                                            @endif
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                    @endif
                                    </td>
                                    <td class="text-right"><span class="text-success font-weight-bold">{{ $fillInTheGap->answer->options }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: fill in the gap -->

                    <!-- Start: combination -->
                    <div class="col-12 col-md-6">
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                            Combination {{ $marks->combination !== NULL ? '('.$marks->combination.')' : '' }}</h5>
                        <table
                            class="table mini-answer-sheet-table table-hover table-borderless">
                            <thead class="border-bottom {{ $marks->combination === NULL ? 'border-warning' : 'border-success' }}">
                            <tr>
                                <th style="width: 56%;">Word</th>
                                <th style="width: 22%;" class="text-center">Student Answer</th>
                                <th style="width: 22%;" class="text-right">Correct Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($combinations as $index => $combination)
                                <?php
                                $studentCombination = $exam->studentCombinations()->where(['student_id' => $student->id, 'combination_id' => $combination->id])->get()->first();
                                ?>
                                <tr class="{{ isset($studentCombination->answer) ? $studentCombination->answer == $combination->answer->options ? 'text-success success-row' : 'text-danger danger-row' : 'text-secondary secondary-row' }}">
                                    <td>{{ $combination->word }}</td>
                                    <td class="text-center">
                                        @if($marks->combination !== NULL)
                                            @if(isset($studentCombination->answer))
                                                {{ $studentCombination->answer }}
                                            @else
                                                <span class="badge badge-secondary">Not touched</span>
                                            @endif
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                    @endif
                                    </td>
                                    <td class="text-right"><span class="text-success font-weight-bold">{{ $combination->answer->options }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: combination -->
                </div><!-- /.row -->
            </div><!-- /.vocabulary -->
            <!-- End:: vocabulary -->

            <!-- Start:: reading -->
            <div class="reading">
                <h4 class="h4 bg-primary shadow-sm p-3 font-weight-bolder">
                    <span class="">Reading</span>
                    <span class="float-right">{!! $marks->heading === NULL ? '<span class="badge badge-warning mr-1">Pending</span>' : $marks->heading + $marks->rearrage !!} /</span>
                </h4>
                <div class="row p-3">
                    <!-- Start: heading -->
                    <div class="col-12 col-md-8">
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">Heading
                            Matching {{ $marks->heading !== NULL ? '('.$marks->heading.')' : '' }}</h5>
                        <table
                            class="table mini-answer-sheet-table table-striped table-hover table-borderless shadow-sm">
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
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                            Rearrange {{ $marks->rearrange !== NULL ? '('.$marks->rearrange.')' : '' }}</h5>
                        <table
                            class="table mini-answer-sheet-table table-striped table-hover table-borderless shadow-sm">
                            <thead>
                            <tr class="text-right">
                                <th>Line</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <span>1.</span>
                                    {!! $marks->rearrange !== NULL ? $rearrange->line_1 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>2.</span>
                                    {!! $marks->rearrange !== NULL ? $rearrange->line_2 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>3.</span>
                                    {!! $marks->rearrange !== NULL ? $rearrange->line_3 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>4.</span>
                                    {!! $marks->rearrange !== NULL ? $rearrange->line_4 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>5.</span>
                                    {!! $marks->rearrange !== NULL ? $rearrange->line_5 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>6.</span>
                                    {!! $marks->rearrange !== NULL ? $rearrange->line_6 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>7.</span>
                                    {!! $marks->rearrange !== NULL ? $rearrange->line_7 : '<span class="badge badge-warning" style="margin: 9.80px 0;">Pending</span>' !!}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-4 -->
                    <!-- End: rearrange -->
                </div><!-- /.row -->
            </div><!-- /.reading -->
            <!-- End:: reading -->

        </div><!-- /.card-body -->
    </div><!-- /.card -->
@endsection
