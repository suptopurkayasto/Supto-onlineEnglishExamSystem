<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    public function index()
    {
        return 'Logged in';
//        return view('student.dashboard')
//            ->with('admin', Auth::guard('admin')->user());
    }
}
