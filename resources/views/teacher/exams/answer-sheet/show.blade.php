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
                            <thead
                                class="border-bottom {{ $marks->synonym === NULL ? 'border-warning' : 'border-success' }}">
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
                                    <td class="text-right"><span
                                            class="text-success font-weight-bold">{{ $synonym->answer->options }}</span>
                                    </td>
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
                            <thead
                                class="border-bottom {{ $marks->definition === NULL ? 'border-warning' : 'border-success' }}">
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
                                    <td class="text-right"><span
                                            class="text-success font-weight-bold">{{ $definition->answer->options }}</span>
                                    </td>
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
                            <thead
                                class="border-bottom {{ $marks->fillInTheGap === NULL ? 'border-warning' : 'border-success' }}">
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
                                    <td class="text-right"><span
                                            class="text-success font-weight-bold">{{ $fillInTheGap->answer->options }}</span>
                                    </td>
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
                            <thead
                                class="border-bottom {{ $marks->combination === NULL ? 'border-warning' : 'border-success' }}">
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
                                    <td class="text-right"><span
                                            class="text-success font-weight-bold">{{ $combination->answer->options }}</span>
                                    </td>
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
                <h4 class="h4 p-3 font-weight-bolder">
                    <span class="">Reading</span>
                    <span class="float-right">{!! $marks->heading === NULL ? '<span class="badge badge-warning mr-1">Pending</span>' : $marks->heading + $marks->rearrange !!} /</span>
                </h4>
                <div
                    class="answer-sheet-title-border {{ $marks->heading === NULL ? 'bg-warning' : 'bg-success' }}"></div>
                <div class="row p-3">
                    <!-- Start: heading -->
                    <div class="col-12 col-md-7">
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">Heading
                            Matching {{ $marks->heading !== NULL ? '('.$marks->heading.')' : '' }}</h5>
                        <table
                            class="table mini-answer-sheet-table table-hover table-borderless">
                            <thead
                                class="border-bottom {{ $marks->heading === NULL ? 'border-warning' : 'border-success' }}">
                            <tr class="">
                                <th style="width: 50%">Paragraph</th>
                                <th style="width: 25%" class="text-center">Student Answer</th>
                                <th style="width: 25%" class="text-right">Correct Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($headings as $index => $heading)
                                <?php
                                $studentHeading = $exam->studentHeadings()->where(['student_id' => $student->id, 'heading_id' => $heading->id])->get()->first();
                                ?>
                                <tr class="{{ isset($studentHeading->headingOption->headings) ? $studentHeading->headingOption->headings == $heading->answer->headings ? 'text-success success-row' : 'text-danger danger-row' : 'text-secondary secondary-row' }}">
                                    <td title="{{ $heading->paragraph }}">{{ Str::limit($heading->paragraph, 85) }}</td>
                                    <td class="text-center">
                                        @if($marks->heading !== NULL)
                                            @if(isset($studentHeading->headingOption))
                                                <div
                                                    title="{{ $studentHeading->headingOption->headings }}">{{ Str::limit($studentHeading->headingOption->headings, 40) }}</div>
                                            @else
                                                <span class="badge badge-secondary">Not touched</span>
                                            @endif
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-right" title="{{ $heading->answer->headings }}">
                                        <span
                                            class="text-success font-weight-bold">{{ Str::limit($heading->answer->headings, 40) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-7 -->
                    <!-- End: heading -->


                    <!-- Start: rearrange -->
                    <div class="col-12 col-md-5">
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                            Rearrange {{ $marks->rearrange !== NULL ? '('.$marks->rearrange.')' : '' }}</h5>

                        @if($marks->rearrange !== NULL)
                            <table
                                class="table mini-answer-sheet-table table-hover table-borderless">
                                <thead
                                    class="border-bottom {{ $marks->rearrange === NULL ? 'border-warning' : 'border-success' }}">
                                <tr>
                                    <th style="width: 70%">Line</th>
                                    <th style="width: 15%" title="Student Position">S.Position</th>
                                    <th style="width: 15%" title="Correct Position">C.Position</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="{{ $rearrange->line_1 == $studentRearrange->line_1 ? 'text-success success-row' : 'text-danger danger-row' }}">
                                    <td title="{{ $studentRearrange->line_1 }}">{{ Str::limit($studentRearrange->line_1, 40) }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">
                                        @for($number=1; $number <= 7; $number++)
                                            @if($rearrange['line_'.$number] == $studentRearrange->line_1)
                                                <span class="text-success font-weight-bold">{{ $number }}</span>
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr class="{{ $rearrange->line_2 == $studentRearrange->line_2 ? 'text-success success-row' : 'text-danger danger-row' }}">
                                    <td title="{{ $studentRearrange->line_2 }}">{{ Str::limit($studentRearrange->line_2, 40) }}</td>
                                    <td class="text-center">2</td>
                                    <td class="text-right">
                                        @for($number=1; $number <= 7; $number++)
                                            @if($rearrange['line_'.$number] == $studentRearrange->line_2)
                                                <span class="text-success font-weight-bold">{{ $number }}</span>
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr class="{{ $rearrange->line_3 == $studentRearrange->line_3 ? 'text-success success-row' : 'text-danger danger-row' }}">
                                    <td title="{{ $studentRearrange->line_3 }}">{{ Str::limit($studentRearrange->line_3, 40) }}</td>
                                    <td class="text-center">3</td>
                                    <td class="text-right">
                                        @for($number=1; $number <= 7; $number++)
                                            @if($rearrange['line_'.$number] == $studentRearrange->line_3)
                                                <span class="text-success font-weight-bold">{{ $number }}</span>
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr class="{{ $rearrange->line_4 == $studentRearrange->line_4 ? 'text-success success-row' : 'text-danger danger-row' }}">
                                    <td title="{{ $studentRearrange->line_4 }}">{{ Str::limit($studentRearrange->line_4, 40) }}</td>
                                    <td class="text-center">4</td>
                                    <td class="text-right">
                                        @for($number=1; $number <= 7; $number++)
                                            @if($rearrange['line_'.$number] == $studentRearrange->line_4)
                                                <span class="text-success font-weight-bold">{{ $number }}</span>
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr class="{{ $rearrange->line_5 == $studentRearrange->line_5 ? 'text-success success-row' : 'text-danger danger-row' }}">
                                    <td title="{{ $studentRearrange->line_5 }}">{{ Str::limit($studentRearrange->line_5, 40) }}</td>
                                    <td class="text-center">5</td>
                                    <td class="text-right">
                                        @for($number=1; $number <= 7; $number++)
                                            @if($rearrange['line_'.$number] == $studentRearrange->line_5)
                                                <span class="text-success font-weight-bold">{{ $number }}</span>
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr class="{{ $rearrange->line_6 == $studentRearrange->line_6 ? 'text-success success-row' : 'text-danger danger-row' }}">
                                    <td title="{{ $studentRearrange->line_6 }}">{{ Str::limit($studentRearrange->line_6, 40) }}</td>
                                    <td class="text-center">6</td>
                                    <td class="text-right">
                                        @for($number=1; $number <= 7; $number++)
                                            @if($rearrange['line_'.$number] == $studentRearrange->line_6)
                                                <span class="text-success font-weight-bold">{{ $number }}</span>
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                <tr class="{{ $rearrange->line_7 == $studentRearrange->line_7 ? 'text-success success-row' : 'text-danger danger-row' }}">
                                    <td title="{{ $studentRearrange->line_7 }}">{{ Str::limit($studentRearrange->line_7, 40) }}</td>
                                    <td class="text-center">7</td>
                                    <td class="text-right">
                                        @for($number=1; $number <= 7; $number++)
                                            @if($rearrange['line_'.$number] == $studentRearrange->line_7)
                                                <span class="text-success font-weight-bold">{{ $number }}</span>
                                            @endif
                                        @endfor
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                                <span class="badge badge-warning">Pending</span>
                            </div>
                        @endif
                    </div><!-- /.col-12 col-md-5 -->
                    <!-- End: rearrange -->
                </div><!-- /.row -->
            </div><!-- /.reading -->
            <!-- End:: reading -->


            <!-- Start:: writing -->
            <div class="writing">
                <h4 class="h4 p-3 font-weight-bolder">
                    <span class="">Writing</span>
                    <span class="float-right">{!! $marks->dialog === NULL && $marks->informalEmail === NULL && $marks->formalEmail === NULL && $marks->sortQuestion === NULL ? '<span class="badge badge-warning mr-1">Pending</span>' : $marks->dialog + $marks->informalEmail + $marks->formalEmail + $marks->sortQuestion !!} / </span>
                </h4>
                <div
                    class="answer-sheet-title-border {{ $marks->dialog === NULL && $marks->informalEmail === NULL && $marks->formalEmail === NULL && $marks->sortQuestion === NULL ? 'bg-warning' : 'bg-success' }}"></div>
                <div class="row p-3">

                    <!-- Start: dialog -->
                    <div
                        class="col-12 col-md-6" {!! $studentDialog->answer_1 !== NULL && $studentDialog->answer_2 !== NULL && $studentDialog->answer_3 !== NULL ? 'data-toggle="modal" data-target="#dialogModel" style="cursor: pointer"' : '' !!}>
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                            Dialog {{ $marks->dialog !== NULL ? '('.$marks->dialog.')' : '' }}</h5>
                        <h6 class="h6 my-3 text-center"
                            title="{{ $studentDialog->dialog->topic }}">{{ Str::limit($studentDialog->dialog->topic, 150) }}</h6>
                        <table
                            class="table mini-answer-sheet-table table-hover table-borderless">
                            <thead
                                class="border-bottom {{ $marks->dialog === NULL ? 'border-warning' : 'border-success' }}">
                            <tr>
                                <th style="width: 3%">#</th>
                                <th style="width: 30%;">Question</th>
                                <th style="width: 67%;" class="text-right">Student Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="{{ $studentDialog->answer_1 !== NULL ?'success-row dialog-success-row' : 'text-secondary secondary-row' }}">
                                <td>1</td>
                                <td title="{{ $studentDialog->dialog->question_1 }}">{{ Str::limit($studentDialog->dialog->question_1, 20) }}</td>
                                <td class="text-right">
                                    @if($studentDialog->answer_1 !== NULL)
                                        <div
                                            title="{{ $studentDialog->answer_1 }}">{{ Str::limit($studentDialog->answer_1, 50) }}</div>
                                    @else
                                        <span class="badge badge-secondary">Not touched</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="{{ $studentDialog->answer_2 !== NULL ?'success-row dialog-success-row' : 'text-secondary secondary-row' }}">
                                <td>2</td>
                                <td title="{{ $studentDialog->dialog->question_2 }}">{{ Str::limit($studentDialog->dialog->question_2, 20) }}</td>
                                <td class="text-right">
                                    @if($studentDialog->answer_2 !== NULL)
                                        <div
                                            title="{{ $studentDialog->answer_2 }}">{{ Str::limit($studentDialog->answer_2, 50) }}</div>
                                    @else
                                        <span class="badge badge-secondary">Not touched</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="{{ $studentDialog->answer_3 !== NULL ?'success-row dialog-success-row' : 'text-secondary secondary-row' }}">
                                <td>3</td>
                                <td title="{{ $studentDialog->dialog->question_3 }}">{{ Str::limit($studentDialog->dialog->question_3, 20) }}</td>
                                <td class="text-right">
                                    @if($studentDialog->answer_3 !== NULL)
                                        <div
                                            title="{{ $studentDialog->answer_3 }}">{{ Str::limit($studentDialog->answer_3, 50) }}</div>
                                    @else
                                        <span class="badge badge-secondary">Not touched</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: dialog -->


                    <!-- Start: informal email -->
                    <div
                        class="col-12 col-md-6" {!! $studentInformalEmail->subject !== NULL && $studentInformalEmail->body ? 'data-toggle="modal" data-target="#informalEmailModel" style="cursor: pointer"' : '' !!}>
                        <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                            Informal
                            Email {{ $marks->informalEmail !== NULL ? '('.$marks->informalEmail.')' : '' }}</h5>
                        <h6 class="h6 my-3 text-center"
                            title="{{ $studentInformalEmail->informalEmail->topic }}">{{ Str::limit($studentInformalEmail->informalEmail->topic, 150) }}</h6>
                        <table
                            class="table mini-answer-sheet-table table-hover table-borderless">
                            <thead
                                class="border-bottom {{ $marks->informalEmail === NULL ? 'border-warning' : 'border-success' }}">
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="{{ $studentInformalEmail->subject !== NULL ?'success-row dialog-success-row' : 'text-secondary secondary-row' }}">
                                <td>
                                    <div>
                                        <h5 class="h5 font-weight-bold d-inline">
                                            Subject
                                        </h5>
                                        @if($studentInformalEmail->subject !== NULL)
                                            <p title="{{ $studentInformalEmail->subject }}">
                                                {{ Str::limit($studentInformalEmail->subject, 60) }}
                                            </p>
                                        @else
                                            <span class="badge badge-secondary float-right">Not touched</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="{{ $studentInformalEmail->body !== NULL ?'success-row dialog-success-row' : 'text-secondary secondary-row' }}">
                                <td>
                                    <div class="">
                                        <h5 class="h5 font-weight-bold d-inline">
                                            Body
                                        </h5>
                                        @if($studentInformalEmail->body !== NULL)
                                            <p title="{{ $studentInformalEmail->body }}">
                                                {{ Str::limit($studentInformalEmail->body, 100) }}
                                            </p>
                                        @else
                                            <span class="badge badge-secondary float-right">Not touched</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.col-12 col-md-6 -->
                    <!-- End: informal email -->

                </div><!-- /.row -->
            </div><!-- /.writing -->
            <!-- End:: writing -->

        </div><!-- /.card-body -->
    </div><!-- /.card -->


    <!-- Dialog Model -->
    <div class="modal fade" id="dialogModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-success" style="border-width: 3px">
                    <h3 class="modal-title">Dialog ( {{ $student->name }} )</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="h6 text-center">{{ $studentDialog->dialog->topic }}</h6>
                    <div class="card-body body-max-width">
                        <div id="dialog-question-1"
                             class="form-group mt-2">
                            <label for="question_1"><h5 class="h5">1. {{ $studentDialog->dialog->question_1 }}</h5>
                            </label>
                            <textarea name="dialog[answer][1]" id="question_1" rows="5" class="form-control"
                                      spellcheck="false" word-limit="true" max-words="50"
                                      min-words="40"
                                      disabled>{{ $studentDialog->answer_1 }}</textarea>
                            <span class="mt-2"></span>
                            <div class="writing_error mt-2"></div>

                        </div><!-- /.form-group -->

                        <div id="dialog-question-2"
                             class="form-group mt-5">
                            <label for="question_2"><h5 class="h5">2. {{ $studentDialog->dialog->question_2 }}</h5>
                            </label>
                            <textarea name="dialog[answer][2]" id="question_2" rows="5"
                                      class="form-control" spellcheck="false" word-limit="true" max-words="50"
                                      min-words="40"
                                      disabled>{{ $studentDialog->answer_2 }}</textarea>
                            <span class="mt-2"></span>
                            <div class="writing_error mt-2"></div>
                        </div><!-- /.form-group -->

                        <div id="dialog-question-1"
                             class="form-group mt-5">
                            <label for="question_3"><h5 class="h5">3. {{ $studentDialog->dialog->question_3 }}</h5>
                            </label>
                            <textarea name="dialog[answer][3]" id="question_3" rows="5"
                                      class="form-control" spellcheck="false" word-limit="true" max-words="50"
                                      min-words="40"
                                      disabled>{{ $studentDialog->answer_3 }}</textarea>
                            <span class="mt-2"></span>
                            <div class="writing_error mt-2"></div>
                        </div><!-- /.form-group -->

                        <form
                            action="{{ route('teacher.students.exams.answer-sheets.dialog.marks.submit', [encrypt($exam->id), encrypt($student->id)]) }}"
                            method="post" class="w-25 mx-auto" id="dialogForm">
                            @csrf
                            @method('PATCH')
                            <div class="form-group mb-0 mt-3">
                                <input name="dialogMarks"
                                       type="number" placeholder="Give marks"
                                       class="form-control text-center font-weight-bolder border-success @error('dialogMarks') is-invalid @enderror"
                                       style="border-width: 2px"
                                       value="{{ $marks->dialog }}">
                                @error('dialogMarks')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.form-group -->
                        </form>

                    </div><!-- /.card-body -->
                </div>
                <div class="modal-footer d-block border-success" style="border-width: 2px">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-success btn-block"
                                            onclick="document.getElementById('dialogForm').submit()">Save
                                    </button>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.col-6 -->
                    </div><!-- /.row -->
                </div>
            </div>
        </div>
    </div>

    <!-- Informal Email Model -->
    <div class="modal fade" id="informalEmailModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-success" style="border-width: 3px">
                    <h3 class="modal-title">Informal Email ( {{ $student->name }} )</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="h6 text-center">{{ $studentInformalEmail->informalEmail->topic }}</h6>
                    <div id="informalEmail"
                         class="form-group mt-2">
                        <input type="hidden" name="informal_email_id" value="{{ $studentInformalEmail->id }}">
                        <div class="form-group">
                            <label for="informalEmail-subject">Subject</label>
                            <input type="text" id="informalEmail-subject" name="informalEmail[subject]"
                                   placeholder="Subject" class="form-control"
                                   value="{{ $studentInformalEmail->subject }}" disabled>
                        </div><!-- /.form-group -->
                        <div class="form-group">
                            <label for="informalEmail-body">Body</label>
                            <textarea name="informalEmail[body]" id="informalEmail-body" rows="6"
                                      class="form-control"
                                      spellcheck="false" word-limit="true" max-words="100"
                                      min-words="40" disabled>{{ $studentInformalEmail->body }}</textarea>
                            <span class="mt-2"></span>
                            <div class="writing_error mt-2"></div>
                        </div><!-- /.form-group -->

                        <form
                            action="{{ route('teacher.students.exams.answer-sheets.informalEmail.marks.submit', [encrypt($exam->id), encrypt($student->id)]) }}"
                            method="post" class="w-25 mx-auto" id="informalEmailForm">
                            @csrf
                            @method('PATCH')
                            <div class="form-group mb-0 mt-3">
                                <input name="informalEmailMarks"
                                       type="number" placeholder="Give marks"
                                       class="form-control text-center font-weight-bolder border-success @error('informalEmailMarks') is-invalid @enderror"
                                       style="border-width: 2px"
                                       value="{{ $marks->informalEmail }}">
                                @error('informalEmailMarks')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div><!-- /.form-group -->
                        </form>

                    </div>
                    <div class="modal-footer d-block border-success" style="border-width: 2px">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-success btn-block"
                                                onclick="document.getElementById('informalEmailForm').submit()">Save
                                        </button>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.col-6 -->
                        </div><!-- /.row -->
                    </div>
                </div>
            </div>
        </div>

@endsection
