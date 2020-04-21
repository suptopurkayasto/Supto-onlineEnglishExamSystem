<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\FillInTheGap;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\FillInTheGap\FillInTheGap;
use App\Model\Vocabulary\FillInTheGap\FillInTheGapOption;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class FillInTheGapController extends Controller
{
    private $fillInTheGapOption;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.vocabulary.fill-in-the-gap.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.vocabulary.fill-in-the-gap.create')
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
        $authTeacher = Auth::guard('teacher')->user();
        $examId = $request->exam;
        $setId = $request->set;
        $countFillINTheGapsByExamAndSet = $authTeacher->exams()->find($examId)->fillInTheGaps()->where('set_id', $setId)->get()->count();

        if ($countFillINTheGapsByExamAndSet < 5) {

            $fillInTheGapOption = FillInTheGapOption::create($this->validateFillInTheGapOptionsCreateRequest($request));
            $this->fillInTheGapOption = $fillInTheGapOption;

            $authTeacher->exams()->find($examId)->fillInTheGaps()->create($this->validateFillInTheGapCreateRequest($request));

            session()->flash('success_audio');
            toast('Fill in the gap sentence has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add fill in the gap sentence to this '. Set::find($setId)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param FillInTheGap $fillInTheGap
     * @return Factory|RedirectResponse|View
     */
    public function show(FillInTheGap $fillInTheGap)
    {
        if ($this->validFillInTheGapRequest($fillInTheGap)) {
            return view('teacher.questions.vocabulary.fill-in-the-gap.show', compact('fillInTheGap'))
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
     * @param FillInTheGap $fillInTheGap
     * @return Factory|RedirectResponse|View
     */
    public function edit(FillInTheGap $fillInTheGap)
    {
        if ($this->validFillInTheGapRequest($fillInTheGap)) {
            return view('teacher.questions.vocabulary.fill-in-the-gap.edit', compact('fillInTheGap'))
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
     * @param FillInTheGap $fillInTheGap
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, FillInTheGap $fillInTheGap)
    {
        if ($this->validFillInTheGapRequest($fillInTheGap)) {

            $authTeacher = Auth::guard('teacher')->user();
            $exam = $authTeacher->exams()->find($request->exam);
            $set = $exam->sets()->find($request->set);

            $countSynonymWordByExamAndSet = $exam->fillInTheGaps()->where(['set_id' => $set->id])->get()->count();

            if ($countSynonymWordByExamAndSet < 5 || $fillInTheGap->exam->id == $request->exam && $fillInTheGap->set->id == $request->set) {

                // Update fill in the gap
                $fillInTheGap->update($this->validateFillInTheGapUpdateRequest($request));

                // Update fill in the gap option
                $fillInTheGap->answer()->update($this->validateFillInTheGapOptionUpdateRequest($request));
                session()->flash('success_audio');
                toast('Fill in the gap sentence has been successfully updated','success');
                return redirect(route('teachers.questions.fill-in-the-gaps.show', $fillInTheGap->id).'?exam='.request()->get('exam').'&set='.request()->get('set'));
            } else {
                session()->flash('field_audio');
                alert()->info('Fail!', 'You can no longer add fill in the gap sentence to this '. Set::find($set->id)->name .' set.');
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
     * @param FillInTheGap $fillInTheGap
     * @return RedirectResponse
     */
    public function destroy(FillInTheGap $fillInTheGap)
    {
        if ($this->validFillInTheGapRequest($fillInTheGap)) {
            $fillInTheGap->answer()->forceDelete();

            $fillInTheGap->forceDelete();
            session()->flash('success_audio');
            toast('Fill in the gap sentence has been successfully deleted','success');
            return redirect()->route('teachers.questions.fill-in-the-gaps.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }




    private function validateFillInTheGapOptionsCreateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'sentence' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'options' => $validateData['answer']
        ];
    }

    private function validateFillInTheGapCreateRequest(Request $request)
    {
        return [
            'exam_id' => $request->exam,
            'set_id' => $request->set,
            'sentence' => $request->sentence,
            'fill_in_the_gap_option_id' => $this->fillInTheGapOption['id']
        ];
    }

    private function validFillInTheGapRequest(FillInTheGap $fillInTheGap)
    {
        $examId = Crypt::decrypt(\request()->get('exam'));
        $authTeacherFillInTheGapsByExam = Auth::guard('teacher')->user()->exams()->find($examId)->fillInTheGaps;

        $valid = null;
        foreach ($authTeacherFillInTheGapsByExam as $authTeacherFillInTheGapByExam) {
            if ($authTeacherFillInTheGapByExam->id === $fillInTheGap->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    private function validateFillInTheGapUpdateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'sentence' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'sentence' => $validateData['sentence'],
        ];
    }

    private function validateFillInTheGapOptionUpdateRequest(Request $request)
    {
        return [
            'options' => $request->answer,
        ];
    }
}
