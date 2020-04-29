<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Location\LocationCreateRequest;
use App\Location;
use App\Student;
use App\Teacher;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LocationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.location.index')
            ->with('locations', Location::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LocationCreateRequest $request
     * @return RedirectResponse
     */
    public function store(LocationCreateRequest $request)
    {
        $location = new Location();
        $data = $request->only('name');
        $data['slug'] = Str::slug($data['name']);
        $location->create($data);

        toast('Location has been successfully created','success');
        session()->flash('success_audio');
        return redirect()->route('admin.locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Location $location
     * @return Factory|View
     */
    public function show(Location $location)
    {
        return view('admin.location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Location $location
     * @return Factory|View
     */
    public function edit(Location $location)
    {
        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Location $location
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Location $location)
    {

        $location->update($this->validateUpdateLocationRequest($request));
        toast('Location has been successfully updated','success');
        session()->flash('success_audio');
        return redirect()->route('admin.locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Location $location
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Location $location)
    {
        // Trash Teacher, That belongs to location
        foreach (Teacher::all() as $teacher) {
            if ($location->id === $teacher->location->id) {
                $teacher->delete();
            }
        }
        // Trash Students, That belongs to location
        foreach (Student::all() as $student) {
            if ($location->id === $student->location->id) {
                $student->delete();
            }
        }

        $location->delete();
        toast('Location has been successfully trashed','success');
        session()->flash('success_audio');
        return redirect()->route('admin.locations.index');
    }

    /**
     * @param $request
     * @return array
     * @throws ValidationException
     */
    protected function validateUpdateLocationRequest($request) {
        $validateData =  $this->validate($request, [
            'name' => 'required|max:255|string|unique:locations',
        ]);

        $validateData['slug'] = Str::slug($validateData['name']);

        return $validateData;
    }

}
