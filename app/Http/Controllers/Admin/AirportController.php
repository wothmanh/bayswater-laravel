<?php

namespace App\Http\Controllers\Admin;

use App\Models\Airport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View; // Import View
use Illuminate\Http\RedirectResponse; // Import RedirectResponse
use App\Models\School; // Import School model

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch airports, potentially with relationships for display (e.g., school)
        $airports = Airport::with('school')->orderBy('name')->paginate(20); // Example: Paginate results
        return view('admin.airports.index', compact('airports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch necessary data for the form, e.g., schools
        $schools = \App\Models\School::orderBy('name')->pluck('name', 'id');
        return view('admin.airports.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'arrival_price' => 'nullable|numeric|min:0',
            'departure_price' => 'nullable|numeric|min:0',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->has('active');

        // Fetch associated school to get city and country IDs
        $school = School::find($validated['school_id']);
        if ($school) {
            $validated['city_id'] = $school->city_id;
            $validated['country_id'] = $school->city->country_id; // Assuming City has country relationship
        } else {
             // Handle case where school might not be found, though validation should prevent this
             return back()->withErrors(['school_id' => 'Selected school not found.'])->withInput();
        }


        Airport::create($validated);

        return redirect()->route('admin.airports.index')->with('success', 'Airport created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airport $airport): View
    {
        $schools = School::orderBy('name')->pluck('name', 'id');
        return view('admin.airports.edit', compact('airport', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'arrival_price' => 'nullable|numeric|min:0',
            'departure_price' => 'nullable|numeric|min:0',
            'active' => 'nullable|boolean',
        ]);

        $validated['active'] = $request->has('active');

        // If school_id changed, update city_id and country_id
        if ($airport->school_id != $validated['school_id']) {
            $school = School::find($validated['school_id']);
             if ($school) {
                $validated['city_id'] = $school->city_id;
                $validated['country_id'] = $school->city->country_id;
            } else {
                 return back()->withErrors(['school_id' => 'Selected school not found.'])->withInput();
            }
        }


        $airport->update($validated);

        return redirect()->route('admin.airports.index')->with('success', 'Airport updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airport $airport): RedirectResponse
    {
        $airport->delete();
        return redirect()->route('admin.airports.index')->with('success', 'Airport deleted successfully.');
    }
}
