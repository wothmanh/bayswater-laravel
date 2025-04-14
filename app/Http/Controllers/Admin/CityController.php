<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country; // Import Country model
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cities = City::with('country')->orderBy('name')->paginate(20);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::where('active', true)->orderBy('name')->pluck('name', 'id');
        return view('admin.cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        City::create($validated);
        return redirect()->route('admin.cities.index');
            // ->with('success', 'City created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404); // Not typically needed for admin CRUD
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city): View
    {
        $countries = Country::where('active', true)->orderBy('name')->pluck('name', 'id');
        return view('admin.cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        $city->update($validated);
        return redirect()->route('admin.cities.index');
            // ->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city): RedirectResponse
    {
        $city->delete();
        return redirect()->route('admin.cities.index');
            // ->with('success', 'City deleted successfully.');
    }
}
