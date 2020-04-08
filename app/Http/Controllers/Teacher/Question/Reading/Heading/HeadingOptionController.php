<?php

namespace App\Http\Controllers\Teacher\Question\Reading\Heading;

use App\Model\Reading\Heading\HeadingOption;
use App\Http\Controllers\Controller;
use App\QuestionSet;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class HeadingOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $authTeacher = Auth::guard('teacher')->user();
        $examId = Crypt::decrypt(\request()->get('exam'));
        $setId = Crypt::decrypt(\request()->get('set'));
        $options = $authTeacher->exams()->find($examId)->headingOptions()->where(['question_set_id' => $setId])->get();

        return view('teacher.questions.reading.heading.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('teacher.questions.reading.heading.options.create');
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
        $examId = Crypt::decrypt($request->exam);
        $setId = Crypt::decrypt($request->set);

        $authTeacherHeadingOptionsCountByExamAndSet =  $authTeacher->exams()->find($examId)->headingOptions()->where(['question_set_id' => $setId])->get()->count();

        if ($authTeacherHeadingOptionsCountByExamAndSet < 10) {

            HeadingOption::create($this->validateHeadingOptionsCreateRequest($request));
            session()->flash('success_audio');
            toast('Extra heading has been successfully created','success');
            return redirect()->back();
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add extra heading to this '. QuestionSet::find($setId)->name .' set.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param HeadingOption $option
     * @return RedirectResponse|view
     */
    public function show(HeadingOption $option)
    {
        if ($this->validOptionRequest($option)) {
            return view('teacher.questions.reading.heading.options.show', compact('option'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HeadingOption $option
     * @return RedirectResponse|view
     */
    public function edit(HeadingOption $option)
    {
        if ($this->validOptionRequest($option)) {
            return view('teacher.questions.reading.heading.options.edit', compact('option'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param HeadingOption $option
     * @return RedirectResponse
     */
    public function update(Request $request, HeadingOption $option)
    {
        if ($this->validOptionRequest($option)) {
            $option->update($this->validateHeadingOptionsUpdateRequest($request));
            session()->flash('success_audio');
            toast('Heading has been successfully updated','success');
            return redirect(route('teachers.questions.headings.options.show', $option->id).'?exam='.\request()->get('exam').'&set='.\request()->get('set'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HeadingOption $option
     * @return RedirectResponse|Redirector
     */
    public function destroy(HeadingOption $option)
    {
        if ($this->validOptionRequest($option)) {
            $option->forceDelete();
            session()->flash('success_audio');
            toast('Extra heading has been successfully deleted','success');
            return redirect(route('teachers.questions.headings.options.index').'?exam='.\request()->get('exam').'&set='. \request()->get('set'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    private function validateHeadingOptionsCreateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'heading' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => Crypt::decrypt(\request()->get('exam')),
            'question_set_id' => Crypt::decrypt(\request()->get('set')),
            'headings' => $validateData['heading']
        ];
    }

    private function validOptionRequest(HeadingOption $option)
    {
        $examId = Crypt::decrypt(\request()->get('exam'));
        $setId = Crypt::decrypt(\request()->get('set'));
        $authTeacher = Auth::guard('teacher')->user();

        $authTeacherOptionsByExamAndSet = $authTeacher->exams()->find($examId)->headingOptions()->where('question_set_id', $setId)->get();

        $valid = null;
        foreach ($authTeacherOptionsByExamAndSet as $item) {
            if ($item->id === $option->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    private function validateHeadingOptionsUpdateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'heading' => 'required|string|max:255',
        ]);

        return [
            'headings' => $validateData['heading']
        ];
    }
}
