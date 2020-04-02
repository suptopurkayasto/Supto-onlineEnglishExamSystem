<?php

namespace App\Http\Controllers\Teacher\Question\Writing\Dialog;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Writing\Dialog;
use App\Model\Writing\WritingPart;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DialogController extends Controller
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
        return view('teacher.questions.writing.dialogs.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.questions.writing.dialogs.create')
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $exam = $request->exam;
        $set = $request->questionSet;

        $countDialogs = Dialog::where(['exam_id' => $exam, 'question_set_id' => $set])->get()->count();

        if ($countDialogs < 1) {
            Dialog::create($this->validateDialogCreateRequest($request));
            session()->flash('success_audio');
            toast('Dialog has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add dialog to this set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Model\Writing\Dialog $dialog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Dialog $dialog)
    {
        if ($this->validSynonymRequest($dialog)) {
            return view('teacher.questions.writing.dialogs.show', compact('dialog'))
                ->with('authTeacherExams', Auth::guard('teacher')->user()->exams)
                ->with('questionSets', QuestionSet::all());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\Writing\Dialog $dialog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Dialog $dialog)
    {
        return view('teacher.questions.writing.dialogs.edit', compact('dialog'))
            ->with('authTeacherExams', Auth::guard('teacher')->user()->exams()->latest()->get())
            ->with('questionSets', QuestionSet::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Writing\Dialog $dialog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Dialog $dialog)
    {
        $dialog->update($this->validateDialogUpdateRequest($request));
        session()->flash('success_audio');
        toast('Dialog has been successfully updated','success');
        return redirect()->route('teachers.questions.dialogs.show', $dialog->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Writing\Dialog $dialog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Dialog $dialog)
    {
        $dialog->forceDelete();

        session()->flash('success_audio');
        toast('Dialog has been successfully deleted','success');
        return redirect()->route('teachers.questions.dialogs.index');
    }

    private function validDialogRequest($dialog) {

        $authTeacherDialogs = Auth::guard('teacher')->user()->dialogs;
        $valid = null;
        foreach ($authTeacherDialogs as $authTeacherDialog) {
            if ($authTeacherDialog->id === $dialog->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    private function validateDialogCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'topic' => 'required|string|max:255',
            'question_1' => 'required|string|max:255',
            'question_2' => 'required|string|max:255',
            'question_3' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'writing_part_id' => WritingPart::where('slug', 'dialog')->get()->first()->id,
            'topic' => $validateData['topic'],
            'question_1' => $validateData['question_1'],
            'question_2' => $validateData['question_2'],
            'question_3' => $validateData['question_3'],
        ];

    }
    private function validateDialogUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'topic' => 'required|string|max:255',
            'question_1' => 'required|string|max:255',
            'question_2' => 'required|string|max:255',
            'question_3' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'topic' => $validateData['topic'],
            'question_1' => $validateData['question_1'],
            'question_2' => $validateData['question_2'],
            'question_3' => $validateData['question_3'],
        ];

    }
}
