<?php

namespace App\Http\Controllers\Teacher\Exam;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Exam\ExamCreateRequest;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ExamController extends Controller
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
        return view('teacher.exams.index')
            ->with('exams', Auth::guard('teacher')->user()->exams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $createdExam = Auth::guard('teacher')->user()->exams()->create($this->validateExamCreateRequest($request));
        $createdExam->sets()->attach(Set::all());

        toast('Exam has been successfully added','success');
        session()->flash('success_audio');
        return redirect()->route('teacher.exams.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Exam $exam
     * @return Factory|RedirectResponse|View
     */
    public function show(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            return view('teacher.exams.show', compact('exam'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Exam $exam
     * @return Factory|RedirectResponse|View
     */
    public function edit(Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            return view('teacher.exams.edit', compact('exam'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Exam $exam
     * @return RedirectResponse
     */
    public function update(Request $request, Exam $exam)
    {
        if ($this->validExamRequest($exam)) {
            $exam->update($this->validateUpdateExamRequest($request));
            toast('Exam has been successfully updated','success');
            session()->flash('success_audio');
            return redirect()->route('teacher.exams.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    public function status(Request $request, Exam $exam)
    {
        if ($request->status === 'running') {
            $exam->update(['status' => 'running']);
            toast('Exam has been successfully running','success');
            session()->flash('success_audio');
        } elseif ($request->status === 'complete') {
            $exam->update(['status' => 'complete']);
            toast('Exam has been successfully completed','success');
            session()->flash('success_audio');
        } elseif ($request->status === 'cancel') {
            $exam->update(['status' => 'cancel']);
            toast('Exam has been successfully canceled','success');
            session()->flash('success_audio');
        } elseif ($request->status === 'complete') {
            $exam->update(['status' => 'complete']);
            toast('Exam has been successfully completed','success');
            session()->flash('success_audio');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Exam $exam
     * @return RedirectResponse
     */
    public function destroy(Exam $exam)
    {
        $exam->forceDelete();
        toast('Exam has been successfully deleted','success');
        session()->flash('success_audio');
        return redirect()->route('teacher.exams.index');
    }

    private function validExamRequest($exam) {

        $authTeacherExam = Auth::guard('teacher')->user()->exams;
        $valid = null;
        foreach ($authTeacherExam as $item) {
            if ($item->id === $exam->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    protected function validateExamCreateRequest($request) {
        $validateData = $this->validate($request, [
            'name' => 'required|max:255|string',
        ]);

        return [
            'name' => $validateData['name']
        ];
    }
    protected function validateUpdateExamRequest($request) {
        $validateData = $this->validate($request, [
            'name' => 'required|max:255|string|unique:exams',
        ]);

        return [
            'teacher_id' => Auth::guard('teacher')->user()->id,
            'name' => $validateData['name'],
        ];
    }

}
