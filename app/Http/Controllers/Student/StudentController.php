<?php

namespace App\Http\Controllers\Student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Grammar\StudentGrammarQuestionExamGotMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    public function index()
    {
        $authStudent = Auth::guard('student')->user();
        return view('student.dashboard')
            ->with('authStudent', $authStudent)
            ->with('exams', Exam::where('teacher_id', $authStudent->teacher->id)->get());
    }
}
