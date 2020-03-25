@extends('layouts.teacher')

@section('title', 'All Grammar Questions')

@section('content')
    @if($grammarQuestions->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Grammar Questions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap border-0 table-hover custom-table-style" style="width: 100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Set</th>
                        <th>Question</th>
                        <th>Option 1</th>
                        <th>Option 2</th>
                        <th>Option 3</th>
                        <th>Answer</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grammarQuestions as $index => $grammarQuestion)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td title="{{ $grammarQuestion->set->name }}">{{ $grammarQuestion->set->name }}</td>
                            <td title="{{ $grammarQuestion->question }}">{{ Str::limit($grammarQuestion->question, 20) }}</td>
                            <td title="{{ $grammarQuestion->option_1 }}">{{ $grammarQuestion->option_1 }}</td>
                            <td title="{{ $grammarQuestion->option_2 }}">{{ $grammarQuestion->option_2 }}</td>
                            <td title="{{ $grammarQuestion->option_3 }}">{{ $grammarQuestion->option_3 }}</td>
                            <td title="{{ $grammarQuestion->answer }}">{{ $grammarQuestion->answer }}</td>
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

