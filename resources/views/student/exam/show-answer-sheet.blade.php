@extends('layouts.app')

@section('title', 'Show - '.$student->name.' Answer Sheet')

@section('content')
    <div class="container-fluid my-3">
        <?php
        $grammarMarksBoolean = $marks->grammar !== NULL;
        $vocabularyMarksBoolean = $marks->synonym !== NULL && $marks->definition !== NULL && $marks->combination !== NULL && $marks->fillInTheGap !== NULL;
        $readingMarksBoolean = $marks->heading !== NULL && $marks->rearrange !== NULL;
        $writingMarksBoolean = $marks->dialog !== NULL && $marks->informalEmail !== NULL && $marks->formalEmail !== NULL && $marks->sortQuestion !== NULL;

        $examDone = $grammarMarksBoolean && $vocabularyMarksBoolean && $readingMarksBoolean && $writingMarksBoolean;
        ?>

        <div class="card">
            <div class="card-header shadow {{ $examDone ? 'bg-primary text-white' : 'bg-secondary' }}">
                <h3 class="h3 float-left {{ $examDone ? 'text-white' : 'text-secondary' }}"><a class="btn-link mr-3 {{ $examDone ? 'text-white' : 'text-black' }}"
                        href="{{ route('student.dashboard') }}"><i class="fas fa-arrow-left"></i> </a>{{ $exam->name }}</h3>
                <h3 class="h3 float-right">
                    <span
                       class="{{ $examDone ? 'text-white' : 'text-secondary' }}">{{ $student->name }}</span>
                </h3>
            </div><!-- /.card-header -->
            <div class="card-body p-0">

                <!-- Start:: Grammar -->
                <div class="grammar">
                    <h4 class="h4 p-3 font-weight-bolder">
                        <span class="{{ $grammarMarksBoolean ? 'text-primary' : 'text-secondary' }}">Grammar</span>
                        @if($grammarMarksBoolean)
                            <span class="float-right">{{ $marks->grammar }} / 25</span>
                        @endif
                    </h4>
                    <div
                        class="answer-sheet-title-border {{ $grammarMarksBoolean ? 'bg-primary' : 'bg-secondary' }}"></div>

                    @if($grammarMarksBoolean)
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
                                                <label
                                                    class="custom-control-label {{ $grammar->option_1 == $grammar->answer ? 'ccl-correct' : '' }}"
                                                    for="{{ $id }}">{{ $grammar->option_1 }}
                                                    @if($grammar->option_1 == $grammar->answer)
                                                        <i class="fa fa-check text-success correct-radio-icon"></i>
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
                                                <label
                                                    class="custom-control-label {{ $grammar->option_2 == $grammar->answer ? 'ccl-correct' : '' }}"
                                                    for="{{ $id }}">{{ $grammar->option_2 }}
                                                    @if($grammar->option_2 == $grammar->answer)
                                                        <i class="fa fa-check text-success correct-radio-icon"></i>
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
                                                    id="{{ $id }}" name="{{ $grammar->id }}"
                                                    class="custom-control-input"
                                                    disabled>
                                                <label
                                                    class="custom-control-label {{ $grammar->option_3 == $grammar->answer ? 'ccl-correct' : '' }}"
                                                    for="{{ $id }}">{{ $grammar->option_3 }}
                                                    @if($grammar->option_3 == $grammar->answer)
                                                        <i class="fa fa-check text-success correct-radio-icon"></i>
                                                    @endif
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- /.col col-md-6 col-lg-4 -->
                            @endforeach
                        </div><!-- /.row -->
                    @else
                        <div class="text-center my-5">
                            <h4 class="h4">Grammar</h4>
                            <span class="badge badge-secondary">Pending</span>
                        </div><!-- /. -->
                    @endif

                </div><!-- /.grammar -->
                <!-- End:: Grammar -->


                <!-- Start:: vocabulary -->
                <div class="vocabulary">
                    <h4 class="h4 p-3 font-weight-bolder">
                        <span
                            class="{{ $vocabularyMarksBoolean ? 'text-primary' : 'text-secondary' }}">Vocabulary</span>
                        <span class="float-right">
                        @if($vocabularyMarksBoolean)
                                {{ $marks->synonym + $marks->definition + $marks->combination + $marks->fillInTheGap }}
                                / 20
                            @endif
                    </span>
                    </h4>
                    <div
                        class="answer-sheet-title-border {{ $vocabularyMarksBoolean ? 'bg-primary' : 'bg-secondary' }}"></div>
                    <div class="row p-3">
                        <!-- Start: Synonym -->
                        @if($marks->synonym !== NULL)
                            <div class="col-12 col-md-6">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Synonym <span class="badge badge-success">{{ $marks->synonym }}</span></h5>
                                <table
                                    class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead
                                        class="border-bottom border-success">
                                    <tr>
                                        <th style="width: 56%;">Word</th>
                                        <th style="width: 22%;" class="text-center" title="Student Answer">S.Answer</th>
                                        <th style="width: 22%;" class="text-right" title="Correct Answer">C.Answer</th>
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
                                                @if(isset($studentSynonym->answer))
                                                    {{ $studentSynonym->answer }}
                                                @else
                                                    <span class="badge badge-secondary">Not touched</span>
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
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Synonym</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6  -->
                        @endif
                    <!-- End: Synonym -->


                        <!-- Start: definition -->
                        @if($marks->definition !== NULL)
                            <div class="col-12 col-md-6">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Definition <span class="badge badge-success">{{ $marks->definition }}</span></h5>
                                <table
                                    class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead
                                        class="border-bottom border-success">
                                    <tr>
                                        <th style="width: 56%;">Sentence</th>
                                        <th style="width: 22%;" class="text-center" title="Student Answer">S.Answer</th>
                                        <th style="width: 22%;" class="text-right" title="Correct Answer">C.Answer</th>
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
                                                @if(isset($studentDefinition->answer))
                                                    {{ $studentDefinition->answer }}
                                                @else
                                                    <span class="badge badge-secondary">Not touched</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                            <span
                                                class="text-success font-weight-bold">{{ $definition->answer->options }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.col-12 col-md-6 -->
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Definition</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6  -->
                        @endif
                    <!-- End: definition -->

                        <!-- Start: fill in the gap -->
                        @if($marks->fillInTheGap !== NULL)
                            <div class="col-12 col-md-6">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Fill in the gap <span class="badge badge-success">{{ $marks->fillInTheGap }}</span>
                                </h5>
                                <table
                                    class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead
                                        class="border-bottom border-success">
                                    <tr>
                                        <th style="width: 56%;">Sentence</th>
                                        <th style="width: 22%;" class="text-center" title="Student Answer">S.Answer</th>
                                        <th style="width: 22%;" class="text-right" title="Correct Answer">C.Answer</th>
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
                                                @if(isset($studentFillInTheGap->answer))
                                                    {{ $studentFillInTheGap->answer }}
                                                @else
                                                    <span class="badge badge-secondary">Not touched</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                            <span
                                                class="text-success font-weight-bold">{{ $fillInTheGap->answer->options }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.col-12 col-md-6 -->
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Fill in the gap</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6  -->
                        @endif
                    <!-- End: fill in the gap -->

                        <!-- Start: combination -->

                        @if($marks->combination !== NULL)
                            <div class="col-12 col-md-6">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Combination <span class="badge badge-success">{{ $marks->combination }}</span></h5>
                                <table
                                    class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead
                                        class="border-bottom border-success">
                                    <tr>
                                        <th style="width: 56%;">Word</th>
                                        <th style="width: 22%;" class="text-center" title="Student Answer">S.Answer</th>
                                        <th style="width: 22%;" class="text-right" title="Correct Answer">C.Answer</th>
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
                                                @if(isset($studentCombination->answer))
                                                    {{ $studentCombination->answer }}
                                                @else
                                                    <span class="badge badge-secondary">Not touched</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                            <span
                                                class="text-success font-weight-bold">{{ $combination->answer->options }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.col-12 col-md-6 -->
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Combination</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6  -->
                    @endif
                    <!-- End: combination -->
                    </div><!-- /.row -->

                </div><!-- /.vocabulary -->
                <!-- End:: vocabulary -->

                <!-- Start:: reading -->
                <div class="reading">
                    <h4 class="h4 p-3 font-weight-bolder">
                        <span class="{{ $readingMarksBoolean ? 'text-primary' : 'text-secondary' }}">Reading</span>
                        <span class="float-right">
                        @if($readingMarksBoolean)
                                {{ $marks->heading + $marks->rearrange }} / 00
                            @endif
                    </span>
                    </h4>
                    <div
                        class="answer-sheet-title-border {{ $readingMarksBoolean ? 'bg-primary' : 'bg-secondary' }}"></div>
                    <div class="row p-3">
                        <!-- Start: heading -->
                        @if($marks->heading !== NULL)
                            <div class="col-12 col-md-7">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">Heading
                                    Matching <span class="badge badge-success">{{ $marks->heading }}</span></h5>
                                <table
                                    class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead
                                        class="border-bottom border-success">
                                    <tr class="">
                                        <th style="width: 50%">Paragraph</th>
                                        <th style="width: 25%" class="text-center" title="Student Answer">S.Answer</th>
                                        <th style="width: 25%" class="text-right" title="Correct Answer">C.Answer</th>
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
                                                @if(isset($studentHeading->headingOption))
                                                    <div
                                                        title="{{ $studentHeading->headingOption->headings }}">{{ Str::limit($studentHeading->headingOption->headings, 40) }}</div>
                                                @else
                                                    <span class="badge badge-secondary">Not touched</span>
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
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Heading Matching</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6  -->
                        @endif
                    <!-- End: heading -->


                        <!-- Start: rearrange -->
                        @if($marks->rearrange !== NULL)
                            <div class="col-12 col-md-5">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Rearrange <span class="badge badge-success">{{ $marks->rearrange }}</span></h5>

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
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Rearrange</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6  -->
                    @endif
                    <!-- End: rearrange -->
                    </div><!-- /.row -->
                </div><!-- /.reading -->
                <!-- End:: reading -->


                <!-- Start:: writing -->
                <div class="writing">
                    <h4 class="h4 p-3 font-weight-bolder">
                        <span class="{{ $writingMarksBoolean ? 'text-primary' : 'text-secondary' }}">Writing</span>
                        <span class="float-right">
                        @if($writingMarksBoolean)
                                {{ $marks->dialog + $marks->informalEmail + $marks->formalEmail + $marks->sortQuestion }}
                                /
                                00
                            @endif
                    </span>
                    </h4>
                    <div
                        class="answer-sheet-title-border {{ $writingMarksBoolean ? 'bg-primary' : 'bg-secondary' }}"></div>
                    <div class="row p-3">

                        <!-- Start: dialog -->
                        @if($marks->dialog !== NULL)
                            <div class="col-12 col-md-6">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Dialog <span class="badge badge-success">{{ $marks->dialog }}</span>
                                    <button data-toggle="modal" data-target="#dialogModal"
                                            class="btn btn-sm btn-success float-right"><i class="fas fa-eye"></i>
                                    </button>

                                </h5>
                                <table
                                    class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead
                                        class="border-bottom border-success">
                                    <tr>
                                        <th style="width: 3%">#</th>
                                        <th style="width: 30%;">Question</th>
                                        <th style="width: 67%;" class="text-right">Student Answer</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="{{ $studentDialog->answer_1 !== NULL ?'success-row writing-success-row' : 'text-secondary secondary-row' }}">
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
                                    <tr class="{{ $studentDialog->answer_2 !== NULL ?'success-row writing-success-row' : 'text-secondary secondary-row' }}">
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
                                    <tr class="{{ $studentDialog->answer_3 !== NULL ?'success-row writing-success-row' : 'text-secondary secondary-row' }}">
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

                            <!-- Dialog Modal -->
                            <div class="modal fade" id="dialogModal" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitleId"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-primary" style="border-width: 3px">
                                            <h3 class="modal-title">Dialog</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <span class="d-block font-weight-bold">Topic: </span>
                                                {{ $studentDialog->dialog->topic }}
                                            </p>
                                            <div id="dialog-question-1"
                                                 class="form-group mt-2">
                                                <label for="question_1"><h5 class="h5">
                                                        1. {{ $studentDialog->dialog->question_1 }}</h5>
                                                </label>
                                                <textarea name="dialog[answer][1]" id="question_1" rows="5"
                                                          class="form-control"
                                                          spellcheck="false" word-limit="true" max-words="50"
                                                          min-words="40"
                                                          disabled>{{ $studentDialog->answer_1 }}</textarea>
                                                <span class="mt-2"></span>
                                                <div class="writing_error mt-2"></div>

                                            </div><!-- /.form-group -->

                                            <div id="dialog-question-2"
                                                 class="form-group mt-5">
                                                <label for="question_2"><h5 class="h5">
                                                        2. {{ $studentDialog->dialog->question_2 }}</h5>
                                                </label>
                                                <textarea name="dialog[answer][2]" id="question_2" rows="5"
                                                          class="form-control" spellcheck="false" word-limit="true"
                                                          max-words="50"
                                                          min-words="40"
                                                          disabled>{{ $studentDialog->answer_2 }}</textarea>
                                                <span class="mt-2"></span>
                                                <div class="writing_error mt-2"></div>
                                            </div><!-- /.form-group -->

                                            <div id="dialog-question-1"
                                                 class="form-group mt-5">
                                                <label for="question_3"><h5 class="h5">
                                                        3. {{ $studentDialog->dialog->question_3 }}</h5>
                                                </label>
                                                <textarea name="dialog[answer][3]" id="question_3" rows="5"
                                                          class="form-control" spellcheck="false" word-limit="true"
                                                          max-words="50"
                                                          min-words="40"
                                                          disabled>{{ $studentDialog->answer_3 }}</textarea>
                                                <span class="mt-2"></span>
                                                <div class="writing_error mt-2"></div>
                                            </div><!-- /.form-group -->
                                        </div>
                                        <div class="modal-footer d-block border-primary" style="border-width: 2px">
                                            <div class="text-center">
                                                <button type="button" class="px-5 btn btn-primary"
                                                        data-dismiss="modal">
                                                    Ok
                                                </button>
                                            </div><!-- /.text-center -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Dialog</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6 -->
                        @endif
                    <!-- End: dialog -->


                        <!-- Start: informal email -->
                        @if($marks->informalEmail !== NULL)
                            <div class="col-12 col-md-6">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Informal Email <span class="badge badge-success">{{ $marks->informalEmail }}</span>
                                    <button data-toggle="modal" data-target="#informalEmailModal"
                                            class="btn btn-sm btn-success float-right"><i class="fas fa-eye"></i>
                                    </button>
                                </h5>
                                <table style="margin-top: 27.5px"
                                       class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead
                                        class="border-bottom border-success">
                                    <tr>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="{{ $studentInformalEmail->subject !== NULL ?'success-row writing-success-row' : 'text-secondary secondary-row' }}">
                                        <td>
                                            <div title="{{ $studentInformalEmail->subject }}">
                                                <h6 class="h6 font-weight-bold d-inline">
                                                    Subject
                                                </h6>
                                                @if($studentInformalEmail->subject !== NULL)
                                                    <p class="mb-0">
                                                        {{ Str::limit($studentInformalEmail->subject, 60) }}
                                                    </p>
                                                @else
                                                    <span class="badge badge-secondary float-right">Not touched</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="{{ $studentInformalEmail->body !== NULL ?'success-row writing-success-row' : 'text-secondary secondary-row' }}">
                                        <td>
                                            <div title="{{ $studentInformalEmail->body }}">
                                                <h6 class="h6 font-weight-bold d-inline">
                                                    Body
                                                </h6>
                                                @if($studentInformalEmail->body !== NULL)
                                                    <p class="mb-0">
                                                        {{ Str::limit($studentInformalEmail->body, 150) }}
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

                            <!-- Informal Email Modal -->
                            <div class="modal fade" id="informalEmailModal" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitleId"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-primary" style="border-width: 3px">
                                            <h3 class="modal-title">Informal Email</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <span class="d-block font-weight-bold">Topic: </span>
                                                {{ $studentInformalEmail->informalEmail->topic }}
                                            </p>
                                            <div id="informalEmail"
                                                 class="form-group mt-2">
                                                <input type="hidden" name="informal_email_id"
                                                       value="{{ $studentInformalEmail->id }}">
                                                <div class="form-group">
                                                    <label for="informalEmail-subject"><h5 class="h5">Subject</h5>
                                                    </label>
                                                    <textarea type="text" id="informalEmail-subject" rows="2"
                                                              name="informalEmail[subject]"
                                                              placeholder="Subject" class="form-control"
                                                              disabled>{{ $studentInformalEmail->subject }}</textarea>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="informalEmail-body"><h5 class="h5">Body</h5></label>
                                                    <textarea name="informalEmail[body]" id="informalEmail-body"
                                                              rows="6"
                                                              class="form-control"
                                                              spellcheck="false" word-limit="true" max-words="100"
                                                              min-words="40"
                                                              disabled>{{ $studentInformalEmail->body }}</textarea>
                                                    <span class="mt-2"></span>
                                                    <div class="writing_error mt-2"></div>
                                                </div><!-- /.form-group -->

                                            </div>
                                            <div class="modal-footer d-block border-primary" style="border-width: 2px">
                                                <div class="text-center">
                                                    <button type="button" class="px-5 btn btn-primary"
                                                            data-dismiss="modal">
                                                        Ok
                                                    </button>
                                                </div><!-- /.text-center -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Informal Email</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6 -->
                        @endif



                    <!-- Start: formal email -->
                        @if($marks->formalEmail !== NULL)
                            <div class="col-12 col-md-6">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Formal Email <span class="badge badge-success">{{ $marks->formalEmail }}</span>
                                    <button data-toggle="modal" data-target="#formalEmailModal"
                                            class="btn btn-sm btn-success float-right"><i class="fas fa-eye"></i>
                                    </button>
                                </h5>
                                <table style="margin-top: 29px"
                                       class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead class="border-bottom border-success">
                                    <tr>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="received_email">
                                        <td>
                                            <div title="{{ $studentFormalEmail->formalEmail->received_email }}">
                                                <h6 class="h6 font-weight-bold d-inline">
                                                    Received Email
                                                </h6>
                                                <p class="mb-0">
                                                    {{ Str::limit($studentFormalEmail->formalEmail->received_email, 60) }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="{{ $studentFormalEmail->subject !== NULL ?'success-row writing-success-row' : 'text-secondary secondary-row' }}">
                                        <td>
                                            <div title="{{ $studentFormalEmail->subject }}">
                                                <h6 class="h6 font-weight-bold d-inline">
                                                    Subject
                                                </h6>
                                                @if($studentFormalEmail->subject !== NULL)
                                                    <p class="mb-0">
                                                        {{ Str::limit($studentFormalEmail->subject, 60) }}
                                                    </p>
                                                @else
                                                    <span class="badge badge-secondary float-right">Not touched</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="{{ $studentFormalEmail->body !== NULL ?'success-row writing-success-row' : 'text-secondary secondary-row' }}">
                                        <td>
                                            <div title="{{ $studentFormalEmail->body }}">
                                                <h6 class="h6 font-weight-bold d-inline">
                                                    Body
                                                </h6>
                                                @if($studentFormalEmail->body !== NULL)
                                                    <p class="mb-0">
                                                        {{ Str::limit($studentFormalEmail->body, 150) }}
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

                            <!-- Informal Email Modal -->
                            <div class="modal fade" id="formalEmailModal" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitleId"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-primary" style="border-width: 3px">
                                            <h3 class="modal-title">Formal Email</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <span class="d-block font-weight-bold">Topic: </span>
                                                {{ $studentFormalEmail->formalEmail->topic }}
                                            </p>
                                            <p>
                                                <span class="d-block font-weight-bold">Received Email: </span>
                                                {{ $studentFormalEmail->formalEmail->received_email }}
                                            </p>
                                            <div id="informalEmail"
                                                 class="form-group mt-2">
                                                <input type="hidden" name="informal_email_id"
                                                       value="{{ $studentFormalEmail->id }}">
                                                <div class="form-group">
                                                    <label for="informalEmail-subject"><h5 class="h5">Subject</h5>
                                                    </label>
                                                    <textarea type="text" id="informalEmail-subject" rows="2"
                                                              name="informalEmail[subject]"
                                                              placeholder="Subject" class="form-control"
                                                              disabled>{{ $studentFormalEmail->subject }}</textarea>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="informalEmail-body"><h5 class="h5">Body</h5></label>
                                                    <textarea name="informalEmail[body]" id="informalEmail-body"
                                                              rows="6"
                                                              class="form-control"
                                                              spellcheck="false" word-limit="true" max-words="100"
                                                              min-words="40"
                                                              disabled>{{ $studentFormalEmail->body }}</textarea>
                                                    <span class="mt-2"></span>
                                                    <div class="writing_error mt-2"></div>
                                                </div><!-- /.form-group -->

                                            </div>
                                            <div class="modal-footer d-block border-primary" style="border-width: 2px">
                                                <div class="text-center">
                                                    <button type="button" class="px-5 btn btn-primary"
                                                            data-dismiss="modal">
                                                        Ok
                                                    </button>
                                                </div><!-- /.text-center -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Formal Email</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6 -->
                        @endif
                    <!-- End: formal email -->

                        <!-- Start: sort question -->
                        @if($marks->sortQuestion !== NULL)
                            <div class="col-12 col-md-6">
                                <h5 class="h5 p-3 font-weight-bold mb-0 text-center shadow-sm mb-1">
                                    Sort questions <span class="badge badge-success">{{ $marks->sortQuestion }}</span>
                                    <button data-toggle="modal" data-target="#sortQuestionModal"
                                            class="btn btn-sm btn-success float-right"><i class="fas fa-eye"></i>
                                    </button>
                                </h5>
                                <table class="table mini-answer-sheet-table table-hover table-borderless">
                                    <thead class="border-bottom border-success">
                                    <tr>
                                        <th style="width: 40%">Question</th>
                                        <th class="text-right" style="width: 60%" title="Student Answer">S.Answer</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($studentSortQuestions as $index => $studentSortQuestion)
                                        <tr class="{{ $studentSortQuestion->answer !== NULL ?'success-row writing-success-row' : 'text-secondary secondary-row' }}">
                                            <td title="{{ $studentSortQuestion->sortQuestion->question }}">{{ Str::limit($studentSortQuestion->sortQuestion->question, 30) }}</td>
                                            <td class="text-right" title="{{ $studentSortQuestion->answer }}">
                                                @if($studentSortQuestion->answer !== NULL)
                                                    {{ Str::limit($studentSortQuestion->answer, 50) }}
                                                @else
                                                    <span class="badge badge-secondary float-right">Not touched</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.col-12 col-md-6 -->

                            <!-- Informal Email Modal -->
                            <div class="modal fade" id="sortQuestionModal" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitleId"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-primary" style="border-width: 3px">
                                            <h3 class="modal-title">Sort questions</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach($studentSortQuestions as $index => $studentSortQuestion)
                                                <div class="form-group mb-3">
                                                    <label for=""><h5 class="h5">{{ $index + 1 }}
                                                            . {{ $studentSortQuestion->sortQuestion->question }}</h5>
                                                    </label>
                                                    <textarea type="text" class="form-control" rows="4"
                                                              disabled>{{ $studentSortQuestion->answer }}</textarea>
                                                </div><!-- /.form-group -->
                                            @endforeach

                                        </div>
                                        <div class="modal-footer d-block border-primary" style="border-width: 2px">
                                            <div class="text-center">
                                                <button type="button" class="px-5 btn btn-primary"
                                                        data-dismiss="modal">
                                                    Ok
                                                </button>
                                            </div><!-- /.text-center -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-md-6 text-center my-5">
                                <h4 class="h4">Sort Question</h4>
                                <span class="badge badge-secondary">Pending</span>
                            </div><!-- /.col-12 col-md-6 -->
                    @endif
                    <!-- End: sort question -->

                    </div><!-- /.row -->
                </div><!-- /.writing -->
                <!-- End:: writing -->

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.container-fluid -->
@endsection
