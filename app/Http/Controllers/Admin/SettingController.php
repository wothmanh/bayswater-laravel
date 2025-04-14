<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Redirect to edit page since we only have one settings record
        return $this->edit();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed as we only have one settings record
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Not needed as we only have one settings record
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not needed as we only have one settings record
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        // Get or create settings
        $settings = Setting::first() ?: new Setting();

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate the request
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get or create settings
        $settings = Setting::first() ?: new Setting();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo_path) {
                Storage::disk('public')->delete($settings->logo_path);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $settings->logo_path = $logoPath;
        }

        // Update other settings
        $settings->company_name = $validated['company_name'] ?? $settings->company_name;
        $settings->company_email = $validated['company_email'] ?? $settings->company_email;
        $settings->company_phone = $validated['company_phone'] ?? $settings->company_phone;
        $settings->company_address = $validated['company_address'] ?? $settings->company_address;

        // Save settings
        $settings->save();

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Not needed as we only have one settings record
        abort(404);
    }

    /**
     * Remove the logo.
     */
    public function removeLogo(): RedirectResponse
    {
        $settings = Setting::first();

        if ($settings && $settings->logo_path) {
            Storage::disk('public')->delete($settings->logo_path);
            $settings->logo_path = null;
            $settings->save();
        }

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Logo removed successfully');
    }
}
