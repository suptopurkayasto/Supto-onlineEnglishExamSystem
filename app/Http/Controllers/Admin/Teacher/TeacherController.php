<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Teacher\TeacherCreateRequest;
use App\Location;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
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
        return view('admin.teacher.index')
            ->with('teachers', Teacher::withoutTrashed()->latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.teacher.create')
            ->with('locations', Location::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeacherCreateRequest $request)
    {
        $teacher = new Teacher();
        $data = $request->only('name', 'email');
        $data['password'] = Hash::make($request->password);
        $data['location_id'] = $request->location;

        $teacher->create($data);
        toast('Teacher has been successfully added','success');
        session()->flash('success_audio');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Teacher $teacher
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teacher.show')
            ->with('teacher', $teacher)
            ->with('locations', Location::all());
    }

    public function status(Teacher $teacher)
    {
        if ($teacher->profile_status) {
            $teacher->update(['profile_status' => 0]);
            toast('Teacher has been successfully pending','success');
            session()->flash('success_audio');
            return redirect()->back();
        } else {
            $teacher->update(['profile_status' => 1]);
            toast('Teacher has been successfully approved','success');
            session()->flash('success_audio');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Teacher $teacher
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teacher.edit')
            ->with('teacher', $teacher)
            ->with('locations', Location::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Teacher $teacher
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($this->validateUpdateTeacherRequest($request));
        toast('Teacher has been successfully updated','success');
        session()->flash('success_audio');
        return redirect()->route('admin.teachers.show', $teacher->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Teacher $teacher
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->forceDelete();
        toast('Student has been successfully deleted','success');
        session()->flash('success_audio');
        return redirect()->route('admin.teachers.index');
    }

    protected function validateUpdateTeacherRequest($request) {
        $validateData = $this->validate($request, [
            'location' => 'required',
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|email',
        ]);

        $finalData = [
          'location_id' => $validateData['location'],
          'name' => $validateData['name'],
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
