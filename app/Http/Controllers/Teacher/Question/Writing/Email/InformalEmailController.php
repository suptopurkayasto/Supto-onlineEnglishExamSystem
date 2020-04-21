<?php

namespace App\Http\Controllers\Teacher\Question\Writing\Email;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Model\Writing\InformalEmail\InformalEmail;
use App\Set;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

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
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.writing.emails.informal.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('teacher.questions.writing.emails.informal.create')
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

        $countDialogs = InformalEmail::where(['exam_id' => $exam, 'set_id' => $set])->get()->count();

        if ($countDialogs < 1) {
            InformalEmail::create($this->validateInformalEmailCreateRequest($request));
            session()->flash('success_audio');
            toast('Informal email has been successfully added','success');
        } else {
            session()->flash('field_audio');
            alert()->info('Fail!', 'You can no longer add informal email to this '. Set::find($set)->name .' set.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param InformalEmail $informalEmail
     * @return Factory|RedirectResponse|View
     */
    public function show(InformalEmail $informalEmail)
    {
        if ($this->validInformalEmailRequest($informalEmail)) {
            return view('teacher.questions.writing.emails.informal.show', compact('informalEmail'))
                ->with('sets', Set::all())
                ->with('authTeacherExams', Exam::where('teacher_id', Auth::guard('teacher')->id())->get());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InformalEmail $informalEmail
     * @return Factory|RedirectResponse|View
     */
    public function edit(InformalEmail $informalEmail)
    {
        if ($this->validInformalEmailRequest($informalEmail)) {
            return view('teacher.questions.writing.emails.informal.edit', compact('informalEmail'))
                ->with('sets', Set::all())
                ->with('authTeacherExams', Exam::where('teacher_id', Auth::guard('teacher')->id())->get());
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param InformalEmail $informalEmail
     * @return RedirectResponse
     */
    public function update(Request $request, InformalEmail $informalEmail)
    {
        if ($this->validInformalEmailRequest($informalEmail)) {
            $informalEmail->update($this->validateInformalEmailUpdateRequest($request));
            session()->flash('success_audio');
            toast('Informal email has been successfully updated','success');
            return redirect(route('teachers.questions.informal-email.show', $informalEmail->id).'?exam='.\request()->get('exam'));
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InformalEmail $informalEmail
     * @return RedirectResponse
     */
    public function destroy(InformalEmail $informalEmail)
    {
        if ($this->validInformalEmailRequest($informalEmail)) {
            $informalEmail->forceDelete();
            session()->flash('success_audio');
            toast('Informal email has been successfully deleted','success');
            return redirect()->route('teachers.questions.informal-email.index');
        } else {
            alert()->error('😒', 'You can\'t do this.');
            return redirect()->back();
        }
    }

    /**
     * @param $informalEmail
     * @return bool|null
     */
    private function validInformalEmailRequest($informalEmail) {

        $examId = Crypt::decrypt(\request()->get('exam'));

        $authTeacherInformalEmailsByExam = Auth::guard('teacher')->user()->exams()->find($examId)->informalEmails()->get();

        $valid = null;
        foreach ($authTeacherInformalEmailsByExam as $authTeacherInformalEmailByExam) {
            if ($authTeacherInformalEmailByExam->id === $informalEmail->id) {
                $valid = true;
            }
        }

        return $valid;
    }

    private function validateInformalEmailCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'topic' => 'required|string'
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'topic' => $validateData['topic']
        ];

    }

    private function validateInformalEmailUpdateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'set' => 'required|integer',
            'topic' => 'required|string'
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'set_id' => $validateData['set'],
            'topic' => $validateData['topic']
        ];

    }

}
