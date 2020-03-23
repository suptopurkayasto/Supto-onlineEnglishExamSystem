<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Location\LocationCreateRequest;
use App\Location;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
            ->with('locations', Location::withoutTrashed()->latest()->get());
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

        toast('Location has been successfully created','success');
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
     * @throws \Illuminate\Validation\ValidationException
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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
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

    public function trash()
    {
        return view('admin.location.trash')
            ->with('locations', Location::onlyTrashed()->get());
    }
    public function restore($slug)
    {
        $location = Location::onlyTrashed()->where('slug', $slug);
        $location_id = Location::onlyTrashed()->where('slug', $slug)->get()->first()->id;


        // Restore Teacher, That belongs to Location
        $teachers = Teacher::onlyTrashed()->get()->toArray();
        foreach ($teachers as $teacher) {
            if ($teacher['location_id'] === $location_id) {
                Teacher::onlyTrashed()->where('id', $teacher['id'])->restore();
            }
        }
        // Restore Students, That belongs to Location
        $students = Student::onlyTrashed()->get()->toArray();
        foreach ($students as $student) {
            if ($student['location_id'] === $location_id) {
                Student::onlyTrashed()->where('id', $student['id'])->restore();
            }
        }

        $location->restore();
        toast('Location has been successfully restored','success');
        session()->flash('success_audio');
        return redirect()->route('admin.location.trash');
    }
    public function trashDelete($slug)
    {
        $location = Location::onlyTrashed()->where('slug', $slug)->get()->first();


        // Delete Teacher, that belongs to location
        $teachers = Teacher::onlyTrashed()->get();
        foreach ($teachers as $teacher) {
            if ($teacher->location_id == $location->id) {
                $teacher->forceDelete();
            }
        }


        // Delete Students, that belongs to location
        $students = Student::onlyTrashed()->get();
        foreach ($students as $student) {
            if ($student->location_id === $location->id) {
                $student->forceDelete();
            }
        }


        $location->forceDelete();
        toast('Location has been successfully deleted','success');
        session()->flash('success_audio');
        return redirect()->route('admin.location.trash');
    }


    /**
     * @param $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateUpdateLocationRequest($request) {
        $validateData =  $this->validate($request, [
            'name' => 'required|max:255|string|unique:locations',
        ]);

        $validateData['slug'] = Str::slug($validateData['name']);

        return $validateData;
    }

}
