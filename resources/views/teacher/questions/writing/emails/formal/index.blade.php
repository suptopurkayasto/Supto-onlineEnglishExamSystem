@extends('layouts.teacher')

@section('title', 'All Formal Email')

@section('content')
    @if($formalEmailQuestions->count() > 0)

        @foreach($authTeacherExams as $authTeacherExam)
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title float-left"><span class="font-weight-bolder">({{ $authTeacherExam->name }})</span>
                        Formal Email
                        @if($authTeacherExam->formalEmails()->count() === 4)
                            <i class="fas fa-check text-success"></i>
                        @else
                            <i class="fas fa-spinner fa-pulse text-warning"></i>

                        @endif
                    </h3>
                    <a href="{{ route('teachers.questions.formal-email.create') }}?exam={{ $authTeacherExam->slug }}"
                       class="btn btn-primary float-right btn-hover-effect"><i class="fas fa-pen-alt mr-1"></i> Add
                        Formal Email</a>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="row count-section">
                        @foreach($authTeacherExam->sets as $set)
                            @php $formalEmailCountBySet = $authTeacherExam->formalEmails()->where('question_set_id', $set->id)->get()->count() @endphp
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="info-box bg-white border-primary border">
                                    <span class="info-box-icon text-primary"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                    <div class="info-box-content">
                                            <span
                                                class="info-box-number">{{ $formalEmailCountBySet }} Formal email</span>

                                        <div class="progress">
                                            <div class="progress-bar"
                                                 style="width: {{ ($formalEmailCountBySet*100)/1 }}%"></div>
                                        </div>
                                        <span class="progress-description">
                                        {{ $formalEmailCountBySet }} / 1 Formal email
                                    </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div><!-- /.col -->
                        @endforeach
                        <div class="col-12">
                            @if($authTeacherExam->formalEmails()->count() > 0)
                                <table id=""
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
                                    @foreach($authTeacherExam->formalEmails as $index => $formalEmail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td title="{{ $formalEmail->topic }}">{{ Str::limit($formalEmail->topic, 70) }}</td>
                                            <td>{{ $formalEmail->set->name }}</td>
                                            <td>{{ $formalEmail->exam->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('teachers.questions.formal-email.show', $formalEmail->id) }}"
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
                                    <a href="{{ route('teachers.questions.formal-email.create') }}?exam={{ $authTeacherExam->slug }}"
                                       class="btn btn-hover-effect mb-4 bg-gradient-primary"><i
                                            class="fas fa-pen-alt"></i> Add Formal Email</a>
                                </div><!-- /.text-center -->
                            @endif
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        @endforeach
    @else
        <div class="empty-data-section mt-5">
            <h2 class="text-center text-warning display-1 font-weight-bolder">Empty.</h2>
            <a href="{{ route('teachers.questions.formal-email.create') }}"
               class="btn btn-lg mt-4 bg-gradient-primary"><i
                    class="fas fa-pen-alt"></i> Add Formal Email</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

