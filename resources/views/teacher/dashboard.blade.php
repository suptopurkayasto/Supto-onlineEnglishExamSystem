@extends('layouts.teacher')

@section('title', 'Dashboard')


@section('content')

    @auth('teacher')
        @if(!auth()->guard('teacher')->user()->profile_status)
            <div class="card w-50 mx-auto mt-5">
                <div class="card-body">
                    <div class="profile_pending_section text-center">
                        <h2>Sorry, Your profile is pending...</h2>
                        <small class="text-gray">Wait for approve profile</small>
                    </div><!-- /. -->
                </div>
            </div><!-- /.card -->
        @endif
    @endauth

@endsection

