@extends('layouts.teacher')

@section('title', 'All Informal Email')

@section('content')

    @if($authTeacher->exams()->count())
        @foreach($authTeacher->exams as $exam)
            @if($exam->informalEmails()->count() > 0)
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title float-left"><span
                                class="font-weight-bolder">({{ $exam->name }})</span>
                            Informal Email
                            @if($exam->informalEmails()->count() === 4)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-spinner fa-pulse text-warning"></i>

                            @endif
                        </h3>
                        <a href="{{ route('teachers.questions.informal-email.create') }}?exam={{ $exam->slug }}"
                           class="btn btn-primary float-right btn-hover-effect"><i class="fas fa-pen-alt mr-1"></i> Add
                            Informal Email</a>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="row count-section">
                            @foreach($exam->sets as $set)
                                @php $formalEmailCountBySet = $exam->informalEmails()->where('question_set_id', $set->id)->get()->count() @endphp
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="info-box bg-white border-primary border">
                                    <span class="info-box-icon text-primary"
                                          style="font-weight: 900">{{ $set->name }}</span>
                                        <div class="info-box-content">
                                            <span
                                                class="info-box-number">{{ $formalEmailCountBySet }} informal email</span>

                                            <div class="progress">
                                                <div class="progress-bar"
                                                     style="width: {{ ($formalEmailCountBySet*100)/1 }}%"></div>
                                            </div>
                                            <span class="progress-description">
                                        {{ $formalEmailCountBySet }} / 1 informal email
                                    </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->
                            @endforeach
                            <div class="col-12">
                                @if($exam->informalEmails()->count() > 0)
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
                                        @foreach($exam->informalEmails as $index => $informalEmail)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td title="{{ $informalEmail->topic }}">{{ Str::limit($informalEmail->topic, 70) }}</td>
                                                <td>{{ $informalEmail->set->name }}</td>
                                                <td>{{ $informalEmail->exam->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('teachers.questions.informal-email.show', $informalEmail->id) }}"
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
                                        <a href="{{ route('teachers.questions.informal-email.create') }}?exam={{ $exam->slug }}"
                                           class="btn btn-hover-effect mb-4 bg-gradient-primary"><i
                                                class="fas fa-pen-alt"></i> Add Formal Email</a>
                                    </div><!-- /.text-center -->
                                @endif
                            </div><!-- /.col-12 -->
                        </div><!-- /.row -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            @else
                <div class="text-center pt-5 pb-5 shadow-sm mb-5 bg-white rounded">
                    <h1 class="h1">{{ $exam->name }}</h1>
                    <h2 class="text-center text-warning display-4">Empty.</h2>
                    <a href="{{ route('teachers.questions.informal-email.create') }}?exam={{ $exam->slug }}"
                       class="btn btn-lg mt-4 bg-gradient-primary"><i
                            class="fas fa-pen-alt"></i> Add Informal Email</a>
                </div><!-- /.empty-data-section -->
            @endif
        @endforeach
    @else
        <div class="empty-data-section add-exam-mini-section">
            <h1 class="h1">You need to add Exam first.</h1>
            <a href="{{ route('teacher.exams.create') }}"
               class="btn btn-lg mt-4 bg-gradient-primary"><i
                    class="fas fa-pen-alt"></i> Add Exam</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

