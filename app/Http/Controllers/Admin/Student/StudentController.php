<?php

namespace App\Http\Controllers\Admin\Student;

use App\Admin;
use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\StudentCreateRequest;
use App\Location;
use App\Section;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.student.index')
            ->with('students', Student::withoutTrashed()->latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.student.create')
            ->with('groups', Group::all())
            ->with('sections', Section::all())
            ->with('locations', Location::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentCreateRequest $request
     * @param Student $student
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(StudentCreateRequest $request)
    {
        $data = $request->only('name', 'email', 'password');

        $data['location_id'] = $request->location;
        $data['group_id'] = $request->group;
        $data['section_id'] = $request->section;

        $data['id_number'] = Str::upper(Str::random(1)) . now('asia/dhaka')->format('sms') . Str::upper(Str::random(1));

        Auth::guard('admin')->user()->students()->create($data);
        toast('Student has been successfully added','success');
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
        return view('admin.student.show')
            ->with('student', $student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Student $student)
    {
        return view('admin.student.edit')
            ->with('student', $student)
            ->with('groups', Group::all())
            ->with('sections', Section::all())
            ->with('locations', Location::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Student $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Student $student)
    {
//        dd($this->validateUpdateStudentRequest($request));

        $student->update($this->validateUpdateStudentRequest($request));
        toast('Student has been successfully updated','success');
        session()->flash('success_audio');
        return redirect()->route('admin.students.index');
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
        $student->forceDelete();
        toast('Student has been successfully deleted','success');
        session()->flash('success_audio');
        return redirect()->route('admin.students.index');

    }

    protected function validateUpdateStudentRequest($request) {
        $validateData = $this->validate($request, [
            'location' => 'required',
            'name' => 'required|max:255|string',
            'group' => 'required',
            'section' => 'required',
            'email' => 'required|max:255|email',
        ]);

        $finalData =  [
            'location_id' => $validateData['location'],
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
