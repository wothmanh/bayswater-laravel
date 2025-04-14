<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\City; // Import City model
use App\Models\Currency; // Import Currency model
use App\Models\Airport; // Import Airport model
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $schools = School::with(['city.country', 'currency'])->orderBy('name')->paginate(20);
        return view('admin.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $cities = City::where('active', true)->orderBy('name')->pluck('name', 'id');
        $currencies = Currency::where('active', true)->orderBy('name')->pluck('name', 'id');
        return view('admin.schools.create', compact('cities', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'currency_id' => 'required|exists:currencies,id',
            'registration_fee' => 'nullable|numeric|min:0',
            'accommodation_fee' => 'nullable|numeric|min:0',
            'bank_charges' => 'nullable|numeric|min:0',
            'books_fee' => 'nullable|numeric|min:0',
            'books_weeks' => 'nullable|integer|min:1',
            'insurance_fee_per_week' => 'nullable|numeric|min:0',
            'courier_fee' => 'nullable|numeric|min:0',
            'guardianship_fee_per_week' => 'nullable|numeric|min:0',
            'custodianship_fee' => 'nullable|numeric|min:0',
            'christmas_fee_per_week' => 'nullable|numeric|min:0',
            'christmas_start_date' => 'nullable|date',
            'christmas_end_date' => 'nullable|date|after_or_equal:christmas_start_date',
            'extra_accommodation_weeks' => 'nullable|integer|min:0|max:4',
            'summer_fee_per_week' => 'nullable|numeric|min:0',
            'summer_start_date' => 'nullable|date',
            'summer_end_date' => 'nullable|date|after_or_equal:summer_start_date',
            'summer_fee_weeks_off' => 'nullable|integer|min:0',
            'summer_fee_note' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');

        // Ensure extra_accommodation_weeks is properly handled
        if ($request->has('extra_accommodation_weeks')) {
            $validated['extra_accommodation_weeks'] = (int) $request->input('extra_accommodation_weeks');
        } else {
            $validated['extra_accommodation_weeks'] = 0; // Default to 0 if not provided
        }

        School::create($validated);
        return redirect()->route('admin.schools.index');
            // ->with('success', 'School created successfully.');
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
    public function edit(School $school): View
    {
        $cities = City::where('active', true)->orderBy('name')->pluck('name', 'id');
        $currencies = Currency::where('active', true)->orderBy('name')->pluck('name', 'id');
        return view('admin.schools.edit', compact('school', 'cities', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'currency_id' => 'required|exists:currencies,id',
            'registration_fee' => 'nullable|numeric|min:0',
            'accommodation_fee' => 'nullable|numeric|min:0',
            'bank_charges' => 'nullable|numeric|min:0',
            'books_fee' => 'nullable|numeric|min:0',
            'books_weeks' => 'nullable|integer|min:1',
            'insurance_fee_per_week' => 'nullable|numeric|min:0',
            'courier_fee' => 'nullable|numeric|min:0',
            'guardianship_fee_per_week' => 'nullable|numeric|min:0',
            'custodianship_fee' => 'nullable|numeric|min:0',
            'christmas_fee_per_week' => 'nullable|numeric|min:0',
            'christmas_start_date' => 'nullable|date',
            'christmas_end_date' => 'nullable|date|after_or_equal:christmas_start_date',
            'extra_accommodation_weeks' => 'nullable|integer|min:0|max:4',
            'summer_fee_per_week' => 'nullable|numeric|min:0',
            'summer_start_date' => 'nullable|date',
            'summer_end_date' => 'nullable|date|after_or_equal:summer_start_date',
            'summer_fee_weeks_off' => 'nullable|integer|min:0',
            'summer_fee_note' => 'nullable|string',
            'active' => 'nullable|boolean',
            'airports' => 'nullable|array', // Validate airports array
            'airports.*' => 'nullable|integer|exists:airports,id', // Validate each airport ID
        ]);
        $validated['active'] = $request->has('active');

        // Ensure extra_accommodation_weeks is properly handled
        if ($request->has('extra_accommodation_weeks')) {
            $validated['extra_accommodation_weeks'] = (int) $request->input('extra_accommodation_weeks');

            // Log the value for debugging
            \Illuminate\Support\Facades\Log::info('Updating school extra_accommodation_weeks', [
                'school_id' => $school->id,
                'old_value' => $school->extra_accommodation_weeks,
                'new_value' => $validated['extra_accommodation_weeks']
            ]);
        } else {
            $validated['extra_accommodation_weeks'] = 0; // Default to 0 if not provided
        }

        // Separate airport IDs from other validated data
        // $airportIds = $validated['airports'] ?? []; // REMOVED
        // unset($validated['airports']); // Remove airports from the main update array // REMOVED

        // Update the school's main attributes
        $school->update($validated);

        // Sync the airports relationship // REMOVED
        // $school->airports()->sync($airportIds); // Use sync to manage the pivot table // REMOVED

        return redirect()->route('admin.schools.index');
            // ->with('success', 'School updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school): RedirectResponse
    {
        $school->delete();
        return redirect()->route('admin.schools.index');
            // ->with('success', 'School deleted successfully.');
    }

    /**
     * Get relevant details for a school (for AJAX calls).
     */
    public function getDetails(School $school)
    {
        // Get the latest data from the database
        $freshSchool = School::find($school->id);

        // Log the request for debugging
        \Illuminate\Support\Facades\Log::info('getDetails called', [
            'school_id' => $school->id,
            'extra_accommodation_weeks' => $freshSchool->extra_accommodation_weeks,
            'christmas_start_date' => $freshSchool->christmas_start_date,
            'christmas_end_date' => $freshSchool->christmas_end_date,
        ]);

        return response()->json([
            'extra_accommodation_weeks' => $freshSchool->extra_accommodation_weeks ?? 0,
            'christmas_start_date' => $freshSchool->christmas_start_date ? $freshSchool->christmas_start_date->format('Y-m-d') : null,
            'christmas_end_date' => $freshSchool->christmas_end_date ? $freshSchool->christmas_end_date->format('Y-m-d') : null,
            'school_id' => $freshSchool->id,
            'school_name' => $freshSchool->name
        ]);
    }

    /**
     * Get active airports for a specific school (for AJAX calls).
     */
    public function getAirports(School $school)
    {
        $airports = $school->airports()->where('active', true)->orderBy('name')->get(['id', 'name']);
        return response()->json($airports);
    }
}
