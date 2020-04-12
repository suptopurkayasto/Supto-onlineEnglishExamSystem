<?php

namespace App\Http\Controllers\Teacher\Student;

use App\Exam;
use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Student\StudentCreateRequest;
use App\Set;
use App\Section;
use App\Student;
use App\Teacher;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->middleware('teacher.profile');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.student.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.student.create')
            ->with('groups', Group::all())
            ->with('sections', Section::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Auth::guard('teacher')->user()->students()->create($this->validateStudentCreateRequest($request));
        toast('Student has been successfully added','success');
        session()->flash('success_audio');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return Factory|View
     */
    public function show(Student $student)
    {
        return view('teacher.student.show', compact('student'))
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return Factory|View
     */
    public function edit(Student $student)
    {
        return view('teacher.student.edit')
            ->with('student', $student)
            ->with('groups', Group::all())
            ->with('sections', Section::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(Request $request, Student $student)
    {
        $student->update($this->validateUpdateStudentRequest($request));
        toast('Student has been successfully updated','success');
        session()->flash('success_audio');
        return redirect()->route('teacher.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Student $student)
    {
        $student->forceDelete();
        toast('Student has been successfully deleted','success');
        session()->flash('success_audio');
        return redirect()->route('teacher.students.index');
    }


    public function result()
    {
        return view('teacher.exams.exam-result')
            ->with('exams', Exam::latest()->get())
            ->with('students', Student::all());
    }

    protected function validateStudentCreateRequest(Request $request) {
        $validateData = $this->validate($request, [
            'name' => 'required|max:255|string',
            'group' => 'required',
            'section' => 'required',
            'phone_number' => 'required',
            'email' => 'required|max:255|email',
            'password' => 'required|min:8'
        ]);

        return [
            'location_id' => Auth::guard('teacher')->user()->location->id,
            'name' => $validateData['name'],
            'group_id' => $validateData['group'],
            'section_id' => $validateData['section'],
            'set_id' => rand(1, 4),
            'phone_number' => $validateData['phone_number'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password'])
        ];
    }


    protected function validateUpdateStudentRequest($request) {
        $validateData = $this->validate($request, [
            'name' => 'required|max:255|string',
            'group' => 'required',
            'section' => 'required',
            'email' => 'required|max:255|email',
        ]);

        $finalData =  [
            'location_id' => Auth::guard('teacher')->user()->location->id,
            'name' => $validateData['name'],
            'group_id' => $validateData['group'],
            'section_id' => $validateData['section'],
            'email' => $validateData['email']
        ];

        if ($request->password != null) {
            $validatePassword = $this->validate($request, [
                'password' => 'required|max:255|min:6|confirmed',
            ]);

            $finalData['password'] = Hash::make($validatePassword['password']);
        }

        return $finalData;
    }
}
