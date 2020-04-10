<?php

namespace App\Http\Controllers\Teacher\Question\Reading\Rearrange;

use App\Model\Reading\Rearrange\Rearrange;
use App\Http\Controllers\Controller;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class RearrangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.reading.rearrange.index')
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
        $examId = $request->input('exam');
        $setId = $request->input('set');
        $countRearrangeByExamAndSet = $authTeacher->exams()->find($examId)->rearranges()->where('set_id', $setId)->get()->count();

        if ($countRearrangeByExamAndSet < 1) {

            $authTeacher->exams()->find($examId)->rearranges()->create($this->validateRearrangeCreateRequest($request));
            session()->flash('success_audio');
            toast('Rearrange has been successfully added', 'success');
            return redirect()->route('teachers.questions.rearranges.index');

        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add rearrange to this ' . Set::find($setId)->name . ' set.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Rearrange $rearrange
     * @return Factory|RedirectResponse|View
     */
    public function show(Rearrange $rearrange)
    {
        if ($this->validRearrangeRequest($rearrange)) {
            return view('teacher.questions.reading.rearrange.show', compact('rearrange'))
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
     * @param Rearrange $rearrange
     * @return Factory|RedirectResponse|View
     */
    public function edit(Rearrange $rearrange)
    {
        if ($this->validRearrangeRequest($rearrange)) {
            return view('teacher.questions.reading.rearrange.edit', compact('rearrange'))
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
     * @param Rearrange $rearrange
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Rearrange $rearrange)
    {
        if ($this->validRearrangeRequest($rearrange)) {
            $authTeacher = Auth::guard('teacher')->user();
            $exam = $authTeacher->exams()->find(decrypt(\request()->get('exam')));
            $set = $request->get('set');

            $countRearrangeWordByExamAndSet = $exam->rearranges()->where('set_id', $set)->count();

            if ($countRearrangeWordByExamAndSet < 1 || $rearrange->exam->id == $request->input('exam') && $rearrange->set->id == $request->input('set')) {
                // Update Synonym
                $rearrange->update($this->validateRearrangeUpdateRequest($request));

                session()->flash('success_audio');
                toast('Rearrange has been successfully updated', 'success');
                return redirect(route('teachers.questions.rearranges.show', $rearrange->id) . '?exam=' . request()->get('exam'));
            } else {
                session()->flash('field_audio');
                alert()->info('Fail!', 'You can no longer add rearrange to this ' . Set::find($set)->name . ' set.');
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
     * @param Rearrange $rearrange
     * @return RedirectResponse
     */
    public function destroy(Rearrange $rearrange)
    {
        if ($this->validRearrangeRequest($rearrange)) {
            $rearrange->forceDelete();
            session()->flash('success_audio');
            toast('Rearrange has been successfully deleted', 'success');
            return redirect()->route('teachers.questions.rearranges.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    private function validRearrangeRequest(Rearrange $rearrange)
    {

        $examId = Crypt::decrypt(\request()->get('exam'));
        $authTeacherRearrangeByExam = Auth::guard('teacher')->user()->exams()->find($examId)->rearranges;

        $valid = null;
        foreach ($authTeacherRearrangeByExam as $item) {
            if ($item->id === $rearrange->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    private function validateRearrangeCreateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'line_1' => 'required|string|max:255',
            'line_2' => 'required|string|max:255',
            'line_3' => 'required|string|max:255',
            'line_4' => 'required|string|max:255',
            'line_5' => 'required|string|max:255',
            'line_6' => 'required|string|max:255',
            'line_7' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'line_1' => $validateData['line_1'],
            'line_2' => $validateData['line_2'],
            'line_3' => $validateData['line_3'],
            'line_4' => $validateData['line_4'],
            'line_5' => $validateData['line_5'],
            'line_6' => $validateData['line_6'],
            'line_7' => $validateData['line_7'],
        ];

    }

    private function validateRearrangeUpdateRequest(Request $request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'line_1' => 'required|string|max:255',
            'line_2' => 'required|string|max:255',
            'line_3' => 'required|string|max:255',
            'line_4' => 'required|string|max:255',
            'line_5' => 'required|string|max:255',
            'line_6' => 'required|string|max:255',
            'line_7' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'line_1' => $validateData['line_1'],
            'line_2' => $validateData['line_2'],
            'line_3' => $validateData['line_3'],
            'line_4' => $validateData['line_4'],
            'line_5' => $validateData['line_5'],
            'line_6' => $validateData['line_6'],
            'line_7' => $validateData['line_7'],
        ];
    }
}
