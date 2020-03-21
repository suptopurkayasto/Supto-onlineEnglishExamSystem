<?php

namespace App\Http\Controllers\Teacher\Student;

use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Student\StudentCreateRequest;
use App\Section;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('teacher.student.index')
            ->with('students', Student::where('teacher_id', Auth::guard('teacher')->id())->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.student.create')
            ->with('groups', Group::all())
            ->with('sections', Section::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentCreateRequest $request)
    {
        $data = $request->only('name', 'email', 'password');
        $data['group_id'] = $request->group;
        $data['section_id'] = $request->section;
        $data['id_number'] = Str::upper(Str::random(1)) . now('asia/dhaka')->format('sms') . Str::upper(Str::random(1));

        Auth::guard('teacher')->user()->students()->create($data);
        toast('Student was added successfully!','success');
        session()->flash('success_audio');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Student $student)
    {
        return view('teacher.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Student $student)
    {
        return view('teacher.student.edit')
            ->with('student', $student)
            ->with('groups', Group::all())
            ->with('sections', Section::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Student $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Student $student)
    {
        $student->update($this->validateUpdateStudentRequest($request));
        toast('Student was updated successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('teacher.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Student $student)
    {
        $student->delete();
        toast('Student was deleted successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('teacher.students.index');
    }

    protected function validateUpdateStudentRequest($request) {
        $validateData = $this->validate($request, [
            'name' => 'required|max:255|string',
            'group' => 'required',
            'section' => 'required',
            'email' => 'required|max:255|email',
        ]);

        $finalData =  [
            'name' => $validateData['name'],
            'group_id' => $validateData['group'],
            'section_id' => $validateData['section'],
            'email' => $validateData['email']
        ];

        if ($request->password != null) {
            $validatePassword = $this->validate($request, [
                'password' => 'required|max:255|min:6|confirmed',
            ]);

            $finalData['password'] = $validatePassword['password'];
        }

        return $finalData;
    }
}
