<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $courseTypes = CourseType::orderBy('name')->paginate(20);
        return view('admin.course_types.index', compact('courseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.course_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:course_types,name|max:255',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        CourseType::create($validated);
        return redirect()->route('admin.course-types.index');
            // ->with('success', 'Course Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseType $courseType): View
    {
        return view('admin.course_types.edit', compact('courseType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseType $courseType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:course_types,name,'.$courseType->id.'|max:255',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        $courseType->update($validated);
        return redirect()->route('admin.course-types.index');
            // ->with('success', 'Course Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseType $courseType): RedirectResponse
    {
        // Consider checking if type is used by courses before deleting
        // if ($courseType->courses()->exists()) { ... }
        $courseType->delete();
        return redirect()->route('admin.course-types.index');
            // ->with('success', 'Course Type deleted successfully.');
    }
}
