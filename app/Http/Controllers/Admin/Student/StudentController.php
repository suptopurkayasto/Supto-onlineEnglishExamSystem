<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\StudentCreateRequest;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.student.index')
            ->with('students', Student::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.student.create');
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
        $student = new Student();

        $data = $request->only('name', 'email', 'password');
        $data['id_number'] = now('asia/dhaka')->format('msms');

        $student->create($data);
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
        return view('admin.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        toast('Student was added successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('admin.students.index');

    }
}
