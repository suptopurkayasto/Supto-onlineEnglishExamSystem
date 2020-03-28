<?php

namespace App\Http\Controllers\Teacher\Question\Writing\Dialog;

use App\Http\Controllers\Controller;
use App\Model\Writing\Dialog;
use Illuminate\Http\Request;

class DialogController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        Dialog::create($this->validateDialogCreateRequest($request));

        toast('Dialog has been successfully added','success');
        session()->flash('success_audio');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Model\Writing\Dialog $dialog
     * @return \Illuminate\Http\Response
     */
    public function show(Dialog $dialog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\Writing\Dialog $dialog
     * @return \Illuminate\Http\Response
     */
    public function edit(Dialog $dialog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Writing\Dialog $dialog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dialog $dialog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Writing\Dialog $dialog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dialog $dialog)
    {
        //
    }

    private function validateDialogCreateRequest($request)
    {
        $validateData = $this->validate($request, [
            'exam' => 'required|integer',
            'questionSet' => 'required|integer',
            'writing_part' => 'required|integer',
            'topic' => 'required|string|max:255',
            'question_1' => 'required|string|max:255',
            'question_2' => 'required|string|max:255',
            'question_3' => 'required|string|max:255',
        ]);

        return [
            'exam_id' => $validateData['exam'],
            'question_set_id' => $validateData['questionSet'],
            'writing_part_id' => $validateData['writing_part'],
            'topic' => $validateData['topic'],
            'question_1' => $validateData['question_1'],
            'question_2' => $validateData['question_2'],
            'question_3' => $validateData['question_3'],
        ];

    }
}
