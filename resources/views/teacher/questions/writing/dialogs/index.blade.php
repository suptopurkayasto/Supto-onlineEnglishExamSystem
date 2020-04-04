@extends('layouts.teacher')

@section('title', 'All Dialog')

@section('content')

    @if($authTeacher->exams()->count() > 0)
        @foreach($authTeacher->exams as $exam)
            @if($exam->dialogs()->count() > 0)
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title index-card-title float-left" title="{{ $exam->name }}"><span
                                class="font-weight-bolder">{{ Str::limit($exam->name, 30) }}</span>
                            Dialog

                        </h3>
                        @if($exam->dialogs()->count() !== 4)
                            <a href="{{ route('teachers.questions.dialogs.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn btn-primary float-right btn-hover-effect"><i class="fas fa-pen-alt mr-1"></i> Add
                                Dialog</a>
                        @endif

                    </div><!-- /.card-header -->
                    @if($exam->dialogs()->count() === 4)
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated"
                                 role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    @else
                        <div class="progress" style="height: 7px">
                            <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated"
                                 role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            @foreach($exam->sets as $set)
                                @php $dialogCountBySet = $exam->dialogs()->where('question_set_id', $set->id)->get()->count() @endphp
                                <div class="col-12 col-md-6 col-lg-3 count-section">
                                    <div class="info-box bg-white border-primary border">
                                    <span class="info-box-icon text-primary"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{ $dialogCountBySet }} Dialog</span>

                                            <div class="progress">
                                                <div class="progress-bar"
                                                     style="width: {{ ($dialogCountBySet*100)/1 }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                        {{ $dialogCountBySet }} / 1 dialog
                                    </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->
                            @endforeach

                            <div class="col-12">
                                <table
                                    class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style"
                                    style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Topic</th>
                                        <th>Set</th>
                                        <th>Exam</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exam->dialogs as $index => $dialog)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td title="{{ $dialog->topic }}">{{ Str::limit($dialog->topic, 70) }}</td>
                                            <td>{{ $dialog->set->name }}</td>
                                            <td title="{{ $dialog->exam->name }}">{{ Str::limit($dialog->exam->name, 40) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('teachers.questions.dialogs.show', $dialog->id) }}?exam={{ encrypt($exam->id) }}"
                                                   class="btn btn-primary btn-sm btn-block btn-hover-effect"><i
                                                        class="fas fa-eye mr-1"></i> View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.col-12 -->
                        </div><!-- /.row -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            @else
                <div class="row">
                    <div class="col col-md-8 offset-md-2">
                        <div class="text-center pt-5 pb-5 shadow-sm mb-5 bg-white rounded shadow empty-data-section">
                            <h1 class="h1" title="{{ $exam->name }}">{{ Str::limit($exam->name, 30) }}</h1>
                            <h2 class="text-center text-warning display-4">Empty.</h2>
                            <a href="{{ route('teachers.questions.dialogs.create') }}?exam={{ encrypt($exam->id) }}"
                               class="btn btn-lg mt-4 bg-gradient-primary"><i
                                    class="fas fa-pen-alt"></i> Add Dialog</a>
                        </div><!-- /.empty-data-section -->
                    </div><!-- /.col col-md-8 offset-md-2 -->
                </div><!-- /.row -->
            @endif
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

{{--@section('data-table-css')--}}
{{--    @include('partials.data-table-css')--}}
{{--@stop--}}
{{--@section('data-table-js')--}}
{{--    @include('partials.data-table-js')--}}
{{--@stop--}}

