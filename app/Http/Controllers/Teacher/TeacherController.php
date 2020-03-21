<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('auth:teacher');
    }
    public function index()
    {
        return view('teacher.dashboard')
            ->with('t', Auth::guard('teacher')->user());
    }
}
