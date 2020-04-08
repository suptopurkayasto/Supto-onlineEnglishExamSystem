<?php

namespace App\Http\Controllers\Teacher\Question\Reading\Heading;

use App\Model\Reading\Heading\Heading;
use App\Http\Controllers\Controller;
use App\Model\Reading\Heading\HeadingOption;
use App\QuestionSet;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class HeadingController extends Controller
{
    private $headingOption;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.reading.heading.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.reading.rearrange.create')
            ->with('questionSets', QuestionSet::all())
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
        $authTeacher = Auth::guard('teacher')->user();
        $examId = $request->exam;
        $setId = $request->questionSet;
        $countHeadingByExamAndSet = $authTeacher->exams()->find($examId)->headings()->where('question_set_id', $setId)->get()->count();
        if ($countHeadingByExamAndSet < 5) {

            $headingOption = HeadingOption::create($this->validateHeadingOptionsCreateRequest($request));
            $this->headingOption = $headingOption;

            $authTeacher->exams()->find($examId)->headings()->create($this->validateHeadingCreateRequest($request));

            session()->flash('success_audio');
            toast('Heading has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add heading to this '. QuestionSet::find($setId)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Heading $heading
     * @return Factory|RedirectResponse|View
     */
    public function show(Heading $heading)
    {
        if ($this->validHeadingRequest($heading)) {
            return view('teacher.questions.reading.heading.show', compact('heading'))
                ->with('questionSets', QuestionSet::all())
                ->with('authTeacher', Auth::guard('teacher')->user());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Heading $heading
     * @return Factory|RedirectResponse|View
     */
    public function edit(Heading $heading)
    {
        if ($this->validHeadingRequest($heading)) {
            return view('teacher.questions.reading.heading.edit', compact('heading'))
                ->with('questionSets', QuestionSet::all())
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
     * @param Heading $heading
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Heading $heading)
    {
        if ($this->validHeadingRequest($heading)) {

            $authTeacher = Auth::guard('teacher')->user();
            $exam = $authTeacher->exams()->find($request->exam);
            $set = $exam->sets()->find($request->questionSet);

            $countHeadingByExamAndSet = $exam->headings()->where(['question_set_id' => $set->id])->get()->count();

            if ($countHeadingByExamAndSet < 5 || $heading->exam->id == $request->exam && $heading->set->id == $request->questionSet) {
                // Update Definition
                $heading->update($this->validateHeadingUpdateRequest($request));

                // Update Definition Option
                $heading->answer()->update($this->validateHeadingOptionUpdateRequest($request));
                session()->flash('success_audio');
                toast('Heading has been successfully updated','success');
                return redirect(route('teachers.questions.headings.show', $heading->id).'?exam='.request()->get('exam').'&set='.request()->get('set'));
            } else {
                session()->flash('field_audio');
                alert()->info('Fail!', 'You can no longer add definition sentence to this '. QuestionSet::find($set->id)->name .' set.');
                return redirect()->back();
            }

        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Heading $heading
     * @return RedirectResponse
     */
    public function destroy(Heading $heading)
    {
        if ($this->validHeadingRequest($heading)) {
            $heading->answer()->forceDelete();

            $heading->forceDelete();
            session()->flash('success_audio');
            toast('Heading has been successfully deleted','success');
            return redirect()->route('teachers.questions.headings.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    private function validateHeadingOptionsCreateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'heading' => 'required|string|max:255',
            'paragraph' => 'required|string',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'headings' => $validateData['heading']
        ];
    }

    private function validateHeadingCreateRequest(Request $request)
    {
        return [
            'question_set_id' => $request->input('questionSet'),
            'heading_option_id' => $this->headingOption['id'],
            'paragraph' => $request->input('paragraph'),
        ];
    }

    private function validHeadingRequest(Heading $heading)
    {
        $examId = Crypt::decrypt(\request()->get('exam'));
        $authTeacherHeadingsByExam = Auth::guard('teacher')->user()->exams()->find($examId)->headings;

        $valid = null;
        foreach ($authTeacherHeadingsByExam as $authTeacherHeadingByExam) {
            if ($authTeacherHeadingByExam->id === $heading->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    private function validateHeadingUpdateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'heading' => 'required|string|max:255',
            'paragraph' => 'required|string',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'paragraph' => $validateData['paragraph']
        ];
    }

    private function validateHeadingOptionUpdateRequest(Request $request)
    {
        return [
            'exam_id' => $request->input('exam'),
            'question_set_id' => $request->input('questionSet'),
            'headings' => $request->input('heading')
        ];
    }
}
