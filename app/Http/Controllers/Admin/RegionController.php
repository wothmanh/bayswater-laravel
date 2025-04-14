<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View; // Import View
use Illuminate\Http\RedirectResponse; // Import RedirectResponse

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    { // Ensure only one opening brace
        $regions = Region::orderBy('name')->paginate(20);
        return view('admin.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:regions,name|max:255',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        Region::create($validated);
        return redirect()->route('admin.regions.index')
            ->with('success', 'Region created successfully.'); // Add flash message
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        abort(404); // Not typically needed for admin CRUD
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region): View
    {
        return view('admin.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:regions,name,'.$region->id.'|max:255',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        $region->update($validated);
        return redirect()->route('admin.regions.index')
            ->with('success', 'Region updated successfully.'); // Add flash message
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region): RedirectResponse
    {
        // Consider implications: Deleting a region might affect discount rules.
        // The foreign key constraint is set to nullOnDelete, so discount rules will remain but lose their region link.
        $region->delete();
        return redirect()->route('admin.regions.index')
            ->with('success', 'Region deleted successfully.'); // Add flash message
    }
}
