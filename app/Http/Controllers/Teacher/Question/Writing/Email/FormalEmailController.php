<?php

namespace App\Http\Controllers\Teacher\Question\Writing\Email;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Writing\FormalEmail;
use App\Model\Writing\InformalEmail;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class FormalEmailController extends Controller
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
        return view('teacher.questions.writing.emails.formal.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.writing.emails.formal.create')
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
        $set = $request->questionSet;

        $authTeacher = Auth::guard('teacher')->user();
        $authTeacherFormalEmailsByExamAndSet = $authTeacher->exams()->find($exam)->formalEmails()->where(['set_id'=> $set])->get();

        if ($authTeacherFormalEmailsByExamAndSet->count() < 1) {
            FormalEmail::create($this->validateFormalEmailCreateRequest($request));
            session()->flash('success_audio');
            toast('Formal email has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add formal email to this '. Set::find($set)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param FormalEmail $formalEmail
     * @return Factory|RedirectResponse|View
     */
    public function show(FormalEmail $formalEmail)
    {
        if ($this->validFormalEmailRequest($formalEmail)) {
            return view('teacher.questions.writing.emails.formal.show', compact('formalEmail'))
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
     * @param FormalEmail $formalEmail
     * @return Factory|RedirectResponse|View
     */
    public function edit(FormalEmail $formalEmail)
    {
        if ($this->validFormalEmailRequest($formalEmail)) {
            return view('teacher.questions.writing.emails.formal.edit', compact('formalEmail'))
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
     * @param FormalEmail $formalEmail
     * @return RedirectResponse
     */
    public function update(Request $request, FormalEmail $formalEmail)
    {
        if ($this->validFormalEmailRequest($formalEmail)) {
            $formalEmail->update($this->validateFormalEmailUpdateRequest($request));
            session()->flash('success_audio');
            toast('Formal email has been successfully updated','success');
            return redirect(route('teachers.questions.formal-email.show', $formalEmail->id).'?exam='.\request()->get('exam'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FormalEmail $formalEmail
     * @return RedirectResponse
     */
    public function destroy(FormalEmail $formalEmail)
    {
        if ($this->validFormalEmailRequest($formalEmail)) {
            $formalEmail->forceDelete();
            session()->flash('success_audio');
            toast('Formal email has been successfully deleted','success');
            return redirect()->route('teachers.questions.formal-email.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * @param $formalEmail
     * @return bool|null
     */
    private function validFormalEmailRequest($formalEmail) {

        $examId = Crypt::decrypt(\request()->get('exam'));

        $authTeacherFormalEmailsByExam = Auth::guard('teacher')->user()->exams()->find($examId)->formalEmails()->get();

        $valid = null;
        foreach ($authTeacherFormalEmailsByExam as $authTeacherFormalEmailByExam) {
            if ($authTeacherFormalEmailByExam->id === $formalEmail->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    private function validateFormalEmailCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'topic' => 'required|string|max:255',
            'received_email' => 'required|string'
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'topic' => $validateData['topic'],
            'received_email' => $validateData['received_email'],
        ];

    }

    private function validateFormalEmailUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'topic' => 'required|string|max:255',
            'received_email' => 'required|string'
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'topic' => $validateData['topic'],
            'received_email' => $validateData['received_email'],
        ];

    }

}
