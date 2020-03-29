<?php

namespace App\Http\Controllers\Teacher\Question\Writing\SortQuestion;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Writing\SortQuestion;
use App\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class SortQuestionController extends Controller
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
        return view('teacher.questions.writing.sort-questions.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('teacher.questions.writing.sort-questions.create')
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
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

        $countDialogs = SortQuestion::where(['exam_id' => $exam, 'question_set_id' => $set])->get()->count();

        if ($countDialogs < 7) {
            SortQuestion::create($this->validateSortQuestionCreateRequest($request));
            session()->flash('success_audio');
            toast('Sort Question has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add sort question to this '. QuestionSet::find($set)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Writing\SortQuestion  $sortQuestion
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(SortQuestion $sortQuestion)
    {
        return view('teacher.questions.writing.sort-questions.show', compact('sortQuestion'))
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Writing\SortQuestion  $sortQuestion
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(SortQuestion $sortQuestion)
    {
        return view('teacher.questions.writing.sort-questions.edit', compact('sortQuestion'))
            ->with('questionSets', QuestionSet::all())
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Writing\SortQuestion  $sortQuestion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SortQuestion $sortQuestion)
    {
        $sortQuestion->update($this->validateSortQuestionUpdateRequest($request));
        session()->flash('success_audio');
        toast('Sort Question has been successfully updated','success');
        return redirect()->route('teachers.questions.sort-questions.show', $sortQuestion->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Writing\SortQuestion  $sortQuestion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SortQuestion $sortQuestion)
    {
        $sortQuestion->forceDelete();
        session()->flash('success_audio');
        toast('Sort question has been successfully deleted','success');
        return redirect()->route('teachers.questions.sort-questions.index');
    }

    private function validateSortQuestionCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'question' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'question' => $validateData['question'],
        ];

    }

    private function validateSortQuestionUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'question' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'question' => $validateData['question'],
        ];

    }

}
