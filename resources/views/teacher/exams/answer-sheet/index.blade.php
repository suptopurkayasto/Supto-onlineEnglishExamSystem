@extends('layouts.teacher')

@section('title', 'All Students Exams Result')

@section('content')
    @if($authTeacher->exams->count() > 0)
        @foreach($authTeacher->exams()->where('status', 'complete')->orWhere('status', 'running')->orderByDesc('id')->get() as $exam)
            <div class="card index-card mb-5">
                <div class="card-header">
                    <h3 class="card-title index-card-title">{{ $exam->name }} Result</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id=""
                           class="example text-center table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Name</th>
                            <th>Section</th>
                            <th>Group</th>
                            <th>Grammar</th>
                            <th>Vocabulary</th>
                            <th>Reading</th>
                            <th>Writing</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($authTeacher->students()->orderBy('name')->get() as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-left"
                                    title="{{ $student->name }}">{{ Str::limit($student->name, 20) }}</td>
                                <td>{{ $student->section->name }}</td>
                                <td>{{ $student->group->name }}</td>
                                <td>
                                    <?php
                                    $grammarMarksBoolean = $student->marks->grammar !== NULL;
                                    $grammarMarksTotal = $student->marks->grammar;
                                    ?>
                                    @if($grammarMarksBoolean)
                                        <span class="d-block"
                                              title="{{ 'Grammar: '.$student->marks->grammar }}">
                                           {{ $grammarMarksTotal }}
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <?php
                                    $vocabularyMarksBoolean = $student->marks->synonym !== NULL && $student->marks->definition !== NULL && $student->marks->combination !== NULL && $student->marks->fillInTheGap !== NULL;
                                    $vocabularyMarksTotal = $student->marks->synonym + $student->marks->definition + $student->marks->combination + $student->marks->fillInTheGap;
                                    ?>
                                    @if($vocabularyMarksBoolean)
                                        <span class="d-block"
                                              title="{{ 'Synonym: '.$student->marks->synonym.', Definition: '.$student->marks->definition.', Combination: '.$student->marks->combination.', Fill in the gap: '.$student->marks->fillInTheGap }}">
                                           {{ $vocabularyMarksTotal }}
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <?php
                                    $readingMarksBoolean = $student->marks->heading !== NULL && $student->marks->rearrange;
                                    $readingMarksTotal = $student->marks->heading + $student->marks->rearrange;
                                    ?>
                                    @if($readingMarksBoolean)
                                        <span class="d-block"
                                              title="{{ 'Heading matching: '.$student->marks->heading.', Rearrange: '.$student->marks->rearrange }}">
                                           {{ $readingMarksTotal }}
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <?php
                                    $writingMarksBoolean = $student->marks->dialog !== NULL && $student->marks->informalEmail !== NULL && $student->marks->formalEmail !== NULL && $student->marks->sortQuestion !== NULL;
                                    $writingMarksTotal = $student->marks->dialog + $student->marks->informalEmail + $student->marks->formalEmail + $student->marks->sortQuestion;
                                    ?>
                                    @if($writingMarksBoolean)
                                        <span class="d-block"
                                              title="{{ 'Dialog: '.$student->marks->dialog.', Informal email: '.$student->marks->informalEmail.', Formal email: '.$student->marks->formalEmail.', Sort question: '.$student->marks->sortQuestion }}">
                                           {{ $writingMarksTotal }}
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('teacher.students.exams.answer-sheets.show', [encrypt($exam->id), encrypt($student->id)]) }}"
                                       class="btn btn-primary btn-hover-effect btn-block btn-sm"><i class="fas fa-eye mr-1"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col col-md-8 offset-md-2">
                <div class="empty-data-section add-exam-mini-section">
                    <h1 class="h1">You need to add Exam first.</h1>
                    <a href="{{ route('teacher.exams.create') }}" class="btn btn-lg mt-4 bg-gradient-primary"><i
                            class="fas fa-pen-alt"></i> Add Exam</a>
                </div><!-- /.empty-data-section -->
            </div><!-- /.col col-md-8 offset-md-2 -->
        </div><!-- /.row -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

