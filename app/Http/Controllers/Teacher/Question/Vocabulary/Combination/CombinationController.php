<?php

namespace App\Http\Controllers\Teacher\Question\Vocabulary\Combination;

use App\Http\Controllers\Controller;
use App\Model\Vocabulary\Combination\Combination;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CombinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('teacher.questions.vocabulary.combination.index')
            ->with('authTeacher', Auth::guard('teacher')->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Combination $combination
     * @return Response
     */
    public function show(Combination $combination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Combination $combination
     * @return Response
     */
    public function edit(Combination $combination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Combination $combination
     * @return Response
     */
    public function update(Request $request, Combination $combination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Combination $combination
     * @return Response
     */
    public function destroy(Combination $combination)
    {
        //
    }
}
