<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Location\LocationCreateRequest;
use App\Location;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.location.index')
            ->with('locations', Location::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LocationCreateRequest $request)
    {
        $location = new Location();
        $data = $request->only('name');
        $data['slug'] = Str::slug($data['name']);
        $location->create($data);

        toast('Location was added successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('admin.locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Location $location
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Location $location)
    {
        return view('admin.location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Location $location
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Location $location)
    {
        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Location $location)
    {

        $location->update($this->validateUpdateLocationRequest($request));
        toast('Location was updated successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('admin.locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Location $location)
    {
        $location->delete();
        toast('Location was deleted successfully!','success');
        session()->flash('success_audio');
        return redirect()->route('admin.locations.index');
    }

    protected function validateUpdateLocationRequest($request) {
        $validateData =  $this->validate($request, [
            'name' => 'required|max:255|string|unique:locations',
        ]);

        $validateData['slug'] = Str::slug($validateData['name']);

        return $validateData;
    }

}
