@extends('layouts.teacher')

@section('title', 'All Dialog')

@section('content')
    @if($dialogQuestions->count() > 0)

        @foreach($authTeacherExams as $authTeacherExam)
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title float-left"><span
                            class="font-weight-bolder">({{ $authTeacherExam->name }})</span>
                        Dialog
                        @if($authTeacherExam->dialogs()->count() === 4)
                            <i class="fas fa-check text-success"></i>
                        @else
                            <i class="fas fa-spinner fa-pulse text-warning"></i>

                        @endif
                    </h3>
                    <a href="{{ route('teachers.questions.dialogs.create') }}?exam={{ $authTeacherExam->slug }}"
                       class="btn btn-primary float-right btn-hover-effect"><i class="fas fa-pen-alt mr-1"></i> Add
                        Dialog</a>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @foreach($authTeacherExam->sets as $set)
                            @php $dialogCountBySet = $authTeacherExam->dialogs()->where('question_set_id', $set->id)->get()->count() @endphp
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
                            @if($authTeacherExam->dialogs()->count() > 0)
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
                                    @foreach($authTeacherExam->dialogs as $index => $dialog)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td title="{{ $dialog->topic }}">{{ Str::limit($dialog->topic, 70) }}</td>
                                            <td>{{ $dialog->set->name }}</td>
                                            <td>{{ $dialog->exam->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('teachers.questions.dialogs.show', $dialog->id) }}"
                                                   class="btn btn-primary btn-sm btn-block btn-hover-effect"><i
                                                        class="fas fa-eye mr-1"></i> View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center">
                                    <h2 class="text-center text-warning display-4">Empty.</h2>
                                    <a href="{{ route('teachers.questions.dialogs.create') }}?exam={{ $authTeacherExam->slug }}"
                                       class="btn btn-hover-effect mb-4 bg-gradient-primary"><i
                                            class="fas fa-pen-alt"></i> Add Dialog</a>
                                </div><!-- /.text-center -->
                            @endif
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        @endforeach
    @else
        <div class="empty-data-section mb-5">
            <h2 class="text-center text-warning display-1 mt-5 font-weight-bolder">Empty.</h2>
            <a href="{{ route('teachers.questions.dialogs.create') }}" class="btn btn-lg mt-4 bg-gradient-primary"><i
                    class="fas fa-pen-alt"></i> Add Dialog</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

{{--@section('data-table-css')--}}
{{--    @include('partials.data-table-css')--}}
{{--@stop--}}
{{--@section('data-table-js')--}}
{{--    @include('partials.data-table-js')--}}
{{--@stop--}}

