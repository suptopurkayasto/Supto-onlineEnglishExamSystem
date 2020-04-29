<?php

namespace App\Http\Controllers\Admin\Student;

use App\Admin;
use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\StudentCreateRequest;
use App\Location;
use App\Set;
use App\Section;
use App\Student;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('location.test')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.student.index')
            ->with('students', Student::latest()->get());
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return Factory|View
     */
    public function show(Student $student)
    {
        return view('admin.student.show')
            ->with('student', $student);
    }
}
