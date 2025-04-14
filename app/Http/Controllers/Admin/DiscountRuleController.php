<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountRule;
use App\Models\School;
use App\Models\Country;
use App\Models\Region; // Import Region
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Accommodation;
use App\Models\Addon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class DiscountRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Eager load region along with other relations
        $discountRules = DiscountRule::with([
            'school', 'country', 'region', 'course', 'courseType', 'accommodation', 'addon'
        ])->orderBy('name')->paginate(20);
        return view('admin.discount_rules.index', compact('discountRules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $schools = School::where('active', true)->orderBy('name')->pluck('name', 'id');
        $countries = Country::where('active', true)->orderBy('name')->pluck('name', 'id');
        $regions = Region::where('active', true)->orderBy('name')->pluck('name', 'id'); // Fetch Regions
        $courses = Course::where('active', true)->orderBy('name')->pluck('name', 'id');
        $courseTypes = CourseType::where('active', true)->orderBy('name')->pluck('name', 'id');
        $accommodations = Accommodation::where('active', true)->orderBy('name')->pluck('name', 'id');
        $addons = Addon::where('active', true)->orderBy('name')->pluck('name', 'id');
        $discountTypes = ['percentage' => 'Percentage', 'fixed_amount' => 'Fixed Amount', 'fee_waiver' => 'Fee Waiver', 'fixed_amount_per_week' => 'Fixed Amount Per Week']; // Added new type
        $appliesToOptions = [
            'course_tuition' => 'Course Tuition',
            'accommodation_price' => 'Accommodation Price',
            'registration_fee' => 'Registration Fee',
            'accommodation_fee' => 'Accommodation Fee',
            'addon' => 'Specific Addon'
        ];
        $dateConditionTypes = ['booking_date' => 'Booking Date', 'start_date' => 'Start Date'];
        return view('admin.discount_rules.create', compact(
            'schools', 'countries', 'regions', 'courses', 'courseTypes', 'accommodations', 'addons', // Pass regions
            'discountTypes', 'appliesToOptions', 'dateConditionTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => ['required', Rule::in(['percentage', 'fixed_amount', 'fee_waiver', 'fixed_amount_per_week'])], // Added new type to validation
            'discount_value' => ['nullable', 'numeric', 'min:0', Rule::requiredIf(fn () => $request->input('discount_type') !== 'fee_waiver')], // Value still required unless fee waiver
            'applies_to' => ['required', Rule::in(['course_tuition', 'accommodation_price', 'registration_fee', 'accommodation_fee', 'addon'])],
            'addon_id' => ['nullable', 'exists:addons,id', Rule::requiredIf(fn () => $request->input('applies_to') === 'addon')],
            'school_id' => 'nullable|exists:schools,id',
            'country_id' => 'nullable|exists:countries,id',
            'region_id' => 'nullable|exists:regions,id', // Add validation for region_id
            'course_id' => 'nullable|exists:courses,id',
            'course_type_id' => 'nullable|exists:course_types,id',
            'accommodation_id' => 'nullable|exists:accommodations,id',
            'accommodation_type' => 'nullable|string|max:100',
            'min_course_weeks' => 'nullable|integer|min:1',
            'max_course_weeks' => 'nullable|integer|min:1|gte:min_course_weeks',
            'min_accommodation_weeks' => 'nullable|integer|min:1',
            'max_accommodation_weeks' => 'nullable|integer|min:1|gte:min_accommodation_weeks',
            'valid_from_date' => 'nullable|date',
            'valid_to_date' => 'nullable|date|after_or_equal:valid_from_date',
            'date_condition_type' => ['nullable', Rule::in(['booking_date', 'start_date'])],
            'combinable' => 'nullable|boolean',
            'priority' => 'required|integer',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        $validated['combinable'] = $request->has('combinable');
        if ($validated['discount_type'] === 'fee_waiver') $validated['discount_value'] = null;
        if ($validated['applies_to'] !== 'addon') $validated['addon_id'] = null;
        DiscountRule::create($validated);
        return redirect()->route('admin.discount-rules.index')
            ->with('success', 'Discount Rule created successfully.'); // Add flash message
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
    public function edit(DiscountRule $discountRule): View
    {
        $schools = School::where('active', true)->orderBy('name')->pluck('name', 'id');
        $countries = Country::where('active', true)->orderBy('name')->pluck('name', 'id');
        $regions = Region::where('active', true)->orderBy('name')->pluck('name', 'id'); // Fetch Regions
        $courses = Course::where('active', true)->orderBy('name')->pluck('name', 'id');
        $courseTypes = CourseType::where('active', true)->orderBy('name')->pluck('name', 'id');
        $accommodations = Accommodation::where('active', true)->orderBy('name')->pluck('name', 'id');
        $addons = Addon::where('active', true)->orderBy('name')->pluck('name', 'id');
        $discountTypes = ['percentage' => 'Percentage', 'fixed_amount' => 'Fixed Amount', 'fee_waiver' => 'Fee Waiver', 'fixed_amount_per_week' => 'Fixed Amount Per Week']; // Added new type
        $appliesToOptions = [
            'course_tuition' => 'Course Tuition',
            'accommodation_price' => 'Accommodation Price',
            'registration_fee' => 'Registration Fee',
            'accommodation_fee' => 'Accommodation Fee',
            'addon' => 'Specific Addon'
        ];
        $dateConditionTypes = ['booking_date' => 'Booking Date', 'start_date' => 'Start Date'];
        return view('admin.discount_rules.edit', compact(
            'discountRule', 'schools', 'countries', 'regions', 'courses', 'courseTypes', 'accommodations', 'addons', // Pass regions
            'discountTypes', 'appliesToOptions', 'dateConditionTypes'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiscountRule $discountRule): RedirectResponse
    {
        // --- Debug: Log incoming request data ---
        Log::info('DiscountRule Update Request Data:', $request->all());
        // --- End Debug ---

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => ['required', Rule::in(['percentage', 'fixed_amount', 'fee_waiver', 'fixed_amount_per_week'])], // Added new type to validation
            'discount_value' => ['nullable', 'numeric', 'min:0', Rule::requiredIf(fn () => $request->input('discount_type') !== 'fee_waiver')], // Value still required unless fee waiver
            'applies_to' => ['required', Rule::in(['course_tuition', 'accommodation_price', 'registration_fee', 'accommodation_fee', 'addon'])],
            'addon_id' => ['nullable', 'exists:addons,id', Rule::requiredIf(fn () => $request->input('applies_to') === 'addon')],
            'school_id' => 'nullable|exists:schools,id',
            'country_id' => 'nullable|exists:countries,id',
            'region_id' => 'nullable|exists:regions,id', // Add validation for region_id
            'course_id' => 'nullable|exists:courses,id',
            'course_type_id' => 'nullable|exists:course_types,id',
            'accommodation_id' => 'nullable|exists:accommodations,id',
            'accommodation_type' => 'nullable|string|max:100',
            'min_course_weeks' => 'nullable|integer|min:1',
            'max_course_weeks' => 'nullable|integer|min:1|gte:min_course_weeks',
            'min_accommodation_weeks' => 'nullable|integer|min:1',
            'max_accommodation_weeks' => 'nullable|integer|min:1|gte:min_accommodation_weeks',
            'valid_from_date' => 'nullable|date',
            'valid_to_date' => 'nullable|date|after_or_equal:valid_from_date',
            'date_condition_type' => ['nullable', Rule::in(['booking_date', 'start_date'])],
            'combinable' => 'nullable|boolean',
            'priority' => 'required|integer',
            'active' => 'nullable|boolean',
        ]);
        $validated['active'] = $request->has('active');
        $validated['combinable'] = $request->has('combinable');
        if ($validated['discount_type'] === 'fee_waiver') $validated['discount_value'] = null;
        if ($validated['applies_to'] !== 'addon') $validated['addon_id'] = null;

        // Explicitly set dates before mass update
        $discountRule->valid_from_date = $validated['valid_from_date'] ?? null;
        $discountRule->valid_to_date = $validated['valid_to_date'] ?? null;

        // Remove dates from validated array before mass update
        unset($validated['valid_from_date']);
        unset($validated['valid_to_date']);

        $discountRule->update($validated); // Update remaining fields

        // Save the model again to persist the explicitly set dates (update doesn't save automatically after explicit set)
        // Although update() calls save(), setting attributes directly doesn't trigger save for those attributes in the same call.
        $discountRule->save();


        return redirect()->route('admin.discount-rules.index')
            ->with('success', 'Discount Rule updated successfully.'); // Add flash message
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountRule $discountRule): RedirectResponse
    {
        $discountRule->delete();
        return redirect()->route('admin.discount-rules.index')
            ->with('success', 'Discount Rule deleted successfully.'); // Add flash message
    }
}
