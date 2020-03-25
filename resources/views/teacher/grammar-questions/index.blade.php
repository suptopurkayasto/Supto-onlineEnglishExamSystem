@extends('layouts.teacher')

@section('title', 'All Grammar Questions')

@section('content')
    @if($grammarQuestions->count() > 0)
        <div class="card">
            <div class="card-header ">
                <h3 class="card-title float-left">All Grammar Questions</h3>
                <a href="{{ route('teachers.grammar-questions.create') }}" class="btn bg-gradient-indigo float-right">Add Grammar Questions</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style" style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Set</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Exam Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grammarQuestions as $index => $grammarQuestion)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ $grammarQuestion->set->name }}" class="text-bold">{{ $grammarQuestion->set->name }}</td>
                            <td title="{{ $grammarQuestion->question }}">{{ Str::limit($grammarQuestion->question, 50) }}</td>
                            <td title="{{ $grammarQuestion->answer }}">{{ $grammarQuestion->answer }}</td>
                            <td title="{{ $grammarQuestion->exam->name }}">{{ $grammarQuestion->exam->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('teachers.grammar-questions.show', $grammarQuestion->id) }}"
                                   class="btn btn-primary btn-sm btn-block btn-hover-effect">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    @else
        <div class="empty-data-section">
            <h2 class="text-center text-warning mt-5 display-1 font-weight">Empty.</h2>
            <a href="{{ route('teacher.exams.index') }}" class="btn btn-lg mt-4 bg-gradient-primary">View Exam</a>
        </div><!-- /.empty-data-section -->
    @endif
@endsection

@section('data-table-css')
    @include('partials.data-table-css')
@stop
@section('data-table-js')
    @include('partials.data-table-js')
@stop

