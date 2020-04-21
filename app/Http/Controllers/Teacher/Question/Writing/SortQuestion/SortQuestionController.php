<?php

namespace App\Http\Controllers\Teacher\Question\Writing\SortQuestion;

use App\Http\Controllers\Controller;
use App\Model\Writing\SortQuestion\SortQuestion;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

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
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.writing.sort-questions.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.writing.sort-questions.create')
            ->with('sets', Set::all())
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
        $exam = $request->exam;
        $set = $request->set;
        $authTeacher = Auth::guard('teacher')->user();

        $authTeacherSortQuestionByExamAndSet = $authTeacher->exams()->find($exam)->sortQuestions()->where(['set_id' => $set])->get();

        if ($authTeacherSortQuestionByExamAndSet->count() < 7) {
            SortQuestion::create($this->validateSortQuestionCreateRequest($request));
            session()->flash('success_audio');
            toast('Sort Question has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add sort question to this '. Set::find($set)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param SortQuestion $sortQuestion
     * @return Factory|RedirectResponse|View
     */
    public function show(SortQuestion $sortQuestion)
    {
        if ($this->validSortQuestionRequest($sortQuestion)) {
            return view('teacher.questions.writing.sort-questions.show', compact('sortQuestion'))
                ->with('sets', Set::all())
                ->with('authTeacher', Auth::guard('teacher')->user());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SortQuestion $sortQuestion
     * @return Factory|RedirectResponse|View
     */
    public function edit(SortQuestion $sortQuestion)
    {
        if ($this->validSortQuestionRequest($sortQuestion)) {
            return view('teacher.questions.writing.sort-questions.edit', compact('sortQuestion'))
                ->with('sets', Set::all())
                ->with('authTeacher', Auth::guard('teacher')->user());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SortQuestion $sortQuestion
     * @return RedirectResponse
     */
    public function update(Request $request, SortQuestion $sortQuestion)
    {
        if ($this->validSortQuestionRequest($sortQuestion)) {

            $exam = $request->exam;
            $set = $request->set;
            $authTeacher = Auth::guard('teacher')->user();

            $authTeacherSortQuestionByExamAndSet = $authTeacher->exams()->find($exam)->sortQuestions()->where(['set_id' => $set])->get();

            if ($authTeacherSortQuestionByExamAndSet->count() < 7 ) {
                $sortQuestion->update($this->validateSortQuestionUpdateRequest($request));
                session()->flash('success_audio');
                toast('Sort Question has been successfully updated','success');
                return redirect(route('teachers.questions.sort-questions.show', $sortQuestion->id).'?exam='.\request()->get('exam'));
            } else {
                session()->flash('field_audio');
                alert()->info('Fail!', 'You can no longer add sort question to this '. Set::find($set)->name .' set.');
            }
            return redirect()->back();

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SortQuestion $sortQuestion
     * @return RedirectResponse
     */
    public function destroy(SortQuestion $sortQuestion)
    {
        if ($this->validSortQuestionRequest($sortQuestion)) {
            $sortQuestion->forceDelete();
            session()->flash('success_audio');
            toast('Sort question has been successfully deleted','success');
            return redirect()->route('teachers.questions.sort-questions.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * @param $sortQuestion
     * @return bool|null
     */
    private function validSortQuestionRequest($sortQuestion) {

        $examId = Crypt::decrypt(\request()->get('exam'));

        $authTeacherSortQuestionsByExamAndSet = Auth::guard('teacher')->user()->exams()->find($examId)->sortQuestions;

        $valid = null;
        foreach ($authTeacherSortQuestionsByExamAndSet as $authTeacherSortQuestionByExamAndSet) {
            if ($authTeacherSortQuestionByExamAndSet->id === $sortQuestion->id) {
                $valid = true;
            }
        }

        return $valid;
    }


    private function validateSortQuestionCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'question' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'question' => $validateData['question'],
        ];

    }

    private function validateSortQuestionUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'question' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'question' => $validateData['question'],
        ];

    }

}
