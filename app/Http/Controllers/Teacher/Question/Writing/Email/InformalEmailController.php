<?php

namespace App\Http\Controllers\Teacher\Question\Writing\Email;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Writing\Dialog;
use App\Model\Writing\InformalEmail;
use App\Model\Writing\WritingPart;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformalEmailController extends Controller
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
        return view('teacher.questions.writing.emails.informal.index')
            ->with('authTeacherExams', Exam::where('teacher_id', Auth::guard('teacher')->id())->get())
            ->with('informalEmailQuestions', InformalEmail::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.questions.writing.emails.informal.create')
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacherExams', Exam::where('teacher_id', Auth::guard('teacher')->id())->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $exam = $request->exam;
        $set = $request->questionSet;

        $countDialogs = InformalEmail::where(['exam_id' => $exam, 'question_set_id' => $set])->get()->count();

        if ($countDialogs < 1) {
            InformalEmail::create($this->validateInformalEmailCreateRequest($request));
            session()->flash('success_audio');
            toast('Informal email has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add informal email to this '. QuestionSet::find($set)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Writing\InformalEmail  $informalEmail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(InformalEmail $informalEmail)
    {
        return view('teacher.questions.writing.emails.informal.show', compact('informalEmail'))
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacherExams', Exam::where('teacher_id', Auth::guard('teacher')->id())->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Writing\InformalEmail  $informalEmail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(InformalEmail $informalEmail)
    {
        return view('teacher.questions.writing.emails.informal.edit', compact('informalEmail'))
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacherExams', Exam::where('teacher_id', Auth::guard('teacher')->id())->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Writing\InformalEmail  $informalEmail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, InformalEmail $informalEmail)
    {
        $informalEmail->update($this->validateInformalEmailUpdateRequest($request));
        session()->flash('success_audio');
        toast('Informal email has been successfully updated','success');
        return redirect()->route('teachers.questions.informal-email.show', $informalEmail->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Writing\InformalEmail  $informalEmail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(InformalEmail $informalEmail)
    {
        $informalEmail->forceDelete();
        session()->flash('success_audio');
        toast('Informal email has been successfully deleted','success');
        return redirect()->route('teachers.questions.writing.index');
    }


    private function validateInformalEmailCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'topic' => 'required|string|max:255'
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'topic' => $validateData['topic']
        ];

    }
    private function validateInformalEmailUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'topic' => 'required|string|max:255'
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'topic' => $validateData['topic']
        ];

    }

}
