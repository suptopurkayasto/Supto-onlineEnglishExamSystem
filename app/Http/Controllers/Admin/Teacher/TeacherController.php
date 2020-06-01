<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Teacher\TeacherCreateRequest;
use App\Location;
use App\Teacher;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

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
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.teacher.index')
            ->with('teachers', Teacher::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.teacher.create')
            ->with('locations', Location::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherCreateRequest $request
     * @return RedirectResponse
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
     * @return Factory|View
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
     * @return Factory|View
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
     * @param Request $request
     * @param Teacher $teacher
     * @return RedirectResponse
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($this->validateUpdateTeacherRequest($request, $teacher));
        toast('Teacher has been successfully updated','success');
        session()->flash('success_audio');
        return redirect()->route('admin.teachers.show', $teacher->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Teacher $teacher
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Teacher $teacher)
    {
        foreach ($teacher->exams as $exam) {
            // Grammar question delete
            $exam->grammars()->delete();

            // Writing questions delete
            $exam->dialogs()->delete();
            $exam->informalEmails()->delete();
            $exam->formalEmails()->delete();
            $exam->sortQuestions()->delete();

            // Vocabulary questions delete
            $exam->synonyms()->delete();
            $exam->synonymOptions()->delete();
            $exam->definitions()->delete();
            $exam->definitionOptions()->delete();
            $exam->combinations()->delete();
            $exam->combinationOptions()->delete();
            $exam->fillInTheGaps()->delete();
            $exam->fillInTheGapOptions()->delete();

            // Reading questions delete
            $exam->rearranges()->delete();
            $exam->headings()->delete();
            $exam->headingOptions()->delete();


            /**
             * Delete Student Data
             */
            $exam->marks()->delete();

            // Grammar
            $exam->studentGrammars()->delete();

            // Vocabulary
            $exam->studentSynonyms()->delete();
            $exam->studentDefinitions()->delete();
            $exam->studentCombinations()->delete();
            $exam->studentFillInTheGaps()->delete();

            // Reading
            $exam->studentRearranges()->delete();
            $exam->studentHeadings()->delete();

            // Writing
            $exam->studentDialogs()->delete();
            $exam->studentInformalEmails()->delete();
            $exam->studentFormalEmails()->delete();
            $exam->studentSortQuestions()->delete();
        }
        $teacher->students()->delete();
        $teacher->forceDelete();
        toast('Student has been successfully deleted','success');
        session()->flash('success_audio');
        return redirect()->route('admin.teachers.index');
    }

    protected function validateUpdateTeacherRequest($request, Teacher $teacher) {
        $validateData = $this->validate($request, [
            'location' => 'required',
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|unique:teachers,email,'. $teacher->id,
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

            $finalData['password'] = Hash::make($validatePassword['password']);
        }

        return $finalData;
    }
}
