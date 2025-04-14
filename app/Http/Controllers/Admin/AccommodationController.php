<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\School; // Import School model
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $accommodations = Accommodation::with('school')->orderBy('name')->paginate(20);
        return view('admin.accommodations.index', compact('accommodations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $schools = School::where('active', true)->orderBy('name')->pluck('name', 'id');
        return view('admin.accommodations.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'type' => 'nullable|string|max:100',
            'room_type' => 'nullable|string|max:100',
            'meal_plan' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'min_age' => 'nullable|integer|min:0',
            'max_age' => 'nullable|integer|min:0|gte:min_age',
            'requires_guardianship' => 'nullable|boolean',
            'requires_christmas_supplement' => 'nullable|boolean',
            'summer_fee_per_week' => 'nullable|numeric|min:0',
            'summer_start_date' => 'nullable|date',
            'summer_end_date' => 'nullable|date|after_or_equal:summer_start_date',
            'summer_fee_note' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        $validated['requires_guardianship'] = $request->has('requires_guardianship');
        $validated['requires_christmas_supplement'] = $request->has('requires_christmas_supplement');
        Accommodation::create($validated);
        return redirect()->route('admin.accommodations.index');
            // ->with('success', 'Accommodation created successfully.');
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
    public function edit(Accommodation $accommodation): View
    {
        // Eager load the accommodation relationship with the prices
        $accommodation->load('accommodationPrices.accommodation');
        $schools = School::where('active', true)->orderBy('name')->pluck('name', 'id');
        return view('admin.accommodations.edit', compact('accommodation', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accommodation $accommodation): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'type' => 'nullable|string|max:100',
            'room_type' => 'nullable|string|max:100',
            'meal_plan' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'min_age' => 'nullable|integer|min:0',
            'max_age' => 'nullable|integer|min:0|gte:min_age',
            'requires_guardianship' => 'nullable|boolean',
            'requires_christmas_supplement' => 'nullable|boolean',
            'summer_fee_per_week' => 'nullable|numeric|min:0',
            'summer_start_date' => 'nullable|date',
            'summer_end_date' => 'nullable|date|after_or_equal:summer_start_date',
            'summer_fee_note' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        $validated['requires_guardianship'] = $request->has('requires_guardianship');
        $validated['requires_christmas_supplement'] = $request->has('requires_christmas_supplement');
        $accommodation->update($validated);
        return redirect()->route('admin.accommodations.index');
            // ->with('success', 'Accommodation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation): RedirectResponse
    {
        $accommodation->delete(); // Cascading deletes should handle prices
        return redirect()->route('admin.accommodations.index');
            // ->with('success', 'Accommodation deleted successfully.');
    }
}
