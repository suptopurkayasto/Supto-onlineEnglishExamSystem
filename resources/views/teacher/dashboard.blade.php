@extends('layouts.teacher')

@section('title', 'Dashboard')


@section('content')

    @auth('teacher')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4">
                    <div class="dashboard-profile-section">
                        <div class="img-wrap">
                            @if(Gravatar::exists($authTeacher->email))
                                <div class="bg-primary rounded w-100 h-100 rounded-circle">
                                    <img title="{{ $authTeacher->name }}" class="img-thumbnail rounded-circle"
                                         style="width: 100%; border-width: 2px !important;"
                                         src="{{ Gravatar::get($authTeacher->email, ['size' => 1024]) }}"
                                         alt="">
                                </div><!-- /. -->
                            @else
                                <a target="_blank" href="https://en.gravatar.com/site/signup"
                                   title="Create Gravatar account for set your profile photo">
                                    <img
                                        src="https://www.gravatar.com/avatar/42875a70a57aed53585c58e7b60ed26e.jpg?s=1024&d=mm&r=g"
                                        class="img-thumbnail rounded-circle" alt="">
                                </a>
                            @endif
                        </div><!-- /.img-wrap -->
                        <div class="profile_status mt-3">
                            @if($authTeacher->profile_status)
                                <div class="text-center">
                                    <span class="badge badge-success">Active</span>
                                </div>
                            @else
                                <div class="text-center">
                                    <span class="badge badge-danger">Pending</span>
                                </div>
                            @endif
                        </div><!-- /.profile_status -->
                        <div class="mini-info-section text-center mt-3">
                            <h2 class="h2">{{ $authTeacher->name }}</h2>
                        </div><!-- /.mini-info-section -->
                    </div><!-- /.dashboard-profile-section -->
                </div><!-- /.col-12 col-md-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    @endauth

@endsection

