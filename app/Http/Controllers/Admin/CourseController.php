<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\School;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $courses = Course::with(['school', 'courseType'])->orderBy('name')->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $schools = School::where('active', true)->orderBy('name')->pluck('name', 'id');
        $courseTypes = CourseType::where('active', true)->orderBy('name')->pluck('name', 'id');
        $pricingTypes = ['per_week' => 'Per Week', 'fixed_schedule' => 'Fixed Schedule'];
        return view('admin.courses.create', compact('schools', 'courseTypes', 'pricingTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'course_type_id' => 'required|exists:course_types,id',
            'pricing_type' => ['required', Rule::in(['per_week', 'fixed_schedule'])],
            'lessons_per_week' => 'nullable|integer|min:0',
            'hours_per_week' => 'nullable|numeric|min:0',
            'study_mode' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        Course::create($validated);
        return redirect()->route('admin.courses.index');
            // ->with('success', 'Course created successfully.');
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
    public function edit(Course $course): View
    {
        $schools = School::where('active', true)->orderBy('name')->pluck('name', 'id');
        $courseTypes = CourseType::where('active', true)->orderBy('name')->pluck('name', 'id');
        $pricingTypes = ['per_week' => 'Per Week', 'fixed_schedule' => 'Fixed Schedule'];
        // Eager load prices and schedules for the edit view
        $course->load(['coursePrices', 'courseSchedules']);
        return view('admin.courses.edit', compact('course', 'schools', 'courseTypes', 'pricingTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'course_type_id' => 'required|exists:course_types,id',
            'pricing_type' => ['required', Rule::in(['per_week', 'fixed_schedule'])],
            'lessons_per_week' => 'nullable|integer|min:0',
            'hours_per_week' => 'nullable|numeric|min:0',
            'study_mode' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        $course->update($validated);
        return redirect()->route('admin.courses.index');
            // ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete(); // Cascading deletes should handle prices/schedules
        return redirect()->route('admin.courses.index');
            // ->with('success', 'Course deleted successfully.');
    }
}
