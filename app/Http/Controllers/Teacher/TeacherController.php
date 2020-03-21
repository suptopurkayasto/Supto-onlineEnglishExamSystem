<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->middleware('teacher.profile')->except('index');
    }
    public function index()
    {
        return view('teacher.dashboard')
            ->with('teacher', Auth::guard('teacher')->user());
    }
}
