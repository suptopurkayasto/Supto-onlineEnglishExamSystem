<?php

namespace App\Http\Controllers\Teacher\Question\Writing\Email;

use App\Exam;
use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        InformalEmail::create($this->validateInformalEmailCreateRequest($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Writing\InformalEmail  $informalEmail
     * @return \Illuminate\Http\Response
     */
    public function show(InformalEmail $informalEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Writing\InformalEmail  $informalEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(InformalEmail $informalEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Writing\InformalEmail  $informalEmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformalEmail $informalEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Writing\InformalEmail  $informalEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformalEmail $informalEmail)
    {
        //
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

}
