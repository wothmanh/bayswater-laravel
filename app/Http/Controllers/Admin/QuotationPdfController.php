<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\FeeCalculatorService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuotationPdfController extends Controller
{
    /**
     * Generate a PDF from the quotation data
     *
     * @param Request $request
     * @param FeeCalculatorService $calculator
     * @return Response
     */
    public function generatePdf(Request $request, FeeCalculatorService $calculator)
    {
        // Check if we're dealing with the new split selection format
        if ($request->has('courses') || $request->has('accommodations')) {
            // Validate for split selections
            $validatedData = $this->validateSplitSelections($request);
        } else {
            // Validate for single selection (original format)
            $validatedData = $request->validate([
                'school_id' => 'required|exists:schools,id',
                'region_id' => 'required|exists:regions,id',
                'course_id' => 'required|exists:courses,id',
                'course_start_date' => 'required|date',
                'course_duration_weeks' => 'required|integer|min:1',
                'accommodation_id' => 'nullable|exists:accommodations,id',
                'accommodation_duration_weeks' => [
                    'nullable',
                    'required_with:accommodation_id',
                    'integer',
                    'min:1',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($value > $request->input('course_duration_weeks')) {
                            $fail('Accommodation duration cannot exceed course duration.');
                        }
                    }
                ],
                'client_birthday' => 'nullable|date',
                'client_nationality_country_id' => 'nullable|exists:countries,id',
                'selected_addons' => 'nullable|array',
                'selected_addons.*' => 'sometimes|boolean',
                'arrival_transfer_airport_id' => 'nullable|exists:airports,id', // Add validation
                'departure_transfer_airport_id' => 'nullable|exists:airports,id', // Add validation
            ]);
        }

        // Prepare parameters for the service
        $quoteParams = $validatedData;

        // Ensure accommodation duration is null if accommodation_id is null
        if (empty($validatedData['accommodation_id'])) {
            $quoteParams['accommodation_duration_weeks'] = null;
        }

        // Handle Christmas accommodation if provided
        if (!empty($validatedData['accommodation_id']) && isset($request->christmas_accommodation)) {
            if ($request->christmas_accommodation === 'yes') {
                $quoteParams['christmas_accommodation'] = true;

                // Add Christmas extra weeks if provided
                if (isset($request->christmas_extra_weeks)) {
                    $quoteParams['christmas_extra_weeks'] = (int) $request->christmas_extra_weeks;
                }

                // Add Christmas dates if provided
                if (isset($request->christmas_start_date) && isset($request->christmas_end_date)) {
                    $quoteParams['christmas_start_date'] = $request->christmas_start_date;
                    $quoteParams['christmas_end_date'] = $request->christmas_end_date;
                }
            }
        }

        // Format selected_addons if necessary
        if (isset($quoteParams['selected_addons'])) {
            $formattedAddons = [];
            foreach ($quoteParams['selected_addons'] as $id => $value) {
                if ($value) {
                    $formattedAddons[$id] = true;
                }
            }
            $quoteParams['selected_addons'] = $formattedAddons;
        }

        // Explicitly add airport transfer IDs if they exist in validated data
        if (isset($validatedData['arrival_transfer_airport_id'])) {
            $quoteParams['arrival_transfer_airport_id'] = $validatedData['arrival_transfer_airport_id'];
        }
        if (isset($validatedData['departure_transfer_airport_id'])) {
            $quoteParams['departure_transfer_airport_id'] = $validatedData['departure_transfer_airport_id'];
        }

        // Calculate the quote
        \Illuminate\Support\Facades\Log::info('PDF Generation - Calculating quote with params:', $quoteParams); // Log params for PDF

        // Use split quote calculation if additional course or accommodation is provided
        if (!empty($quoteParams['courses']) || !empty($quoteParams['accommodations'])) {
            $costBreakdown = $calculator->calculateSplitQuote($quoteParams);
        } else {
            $costBreakdown = $calculator->calculateQuote($quoteParams);
        }

        // Add course start date to the cost breakdown for display
        if (isset($validatedData['course_start_date'])) {
            $costBreakdown['course_start_date'] = $validatedData['course_start_date'];
        }

        // Add courses and accommodations data to the cost breakdown for display
        if (!empty($quoteParams['courses'])) {
            // Calculate end dates for each course if not already set
            foreach ($quoteParams['courses'] as $index => $course) {
                if (!isset($course['end_date'])) {
                    // Calculate course end date (Friday of the last week)
                    $startDate = \Carbon\Carbon::parse($course['start_date']);
                    $endDate = $startDate->copy()->addWeeks($course['duration_weeks'] - 1)->addDays(4);
                    $quoteParams['courses'][$index]['end_date'] = $endDate->format('Y-m-d');
                }
            }
            $costBreakdown['courses'] = $quoteParams['courses'];
        }

        if (!empty($quoteParams['accommodations'])) {
            $costBreakdown['accommodations'] = $quoteParams['accommodations'];
        }

        // Get settings for company info and logo
        $settings = Setting::first();

        // Generate PDF
        $pdf = PDF::loadView('admin.quotations.pdf', [
            'costBreakdown' => $costBreakdown,
            'settings' => $settings
        ]);

        // Set PDF options
        $pdf->setPaper('a4');

        // Return the PDF as a download
        return $pdf->download('quotation-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Print the quotation
     *
     * @param Request $request
     * @param FeeCalculatorService $calculator
     * @return Response
     */
    public function printQuotation(Request $request, FeeCalculatorService $calculator)
    {
        // Check if we're dealing with the new split selection format
        if ($request->has('courses') || $request->has('accommodations')) {
            // Validate for split selections
            $validatedData = $this->validateSplitSelections($request);
        } else {
            // Validate for single selection (original format)
            $validatedData = $request->validate([
                'school_id' => 'required|exists:schools,id',
                'region_id' => 'required|exists:regions,id',
                'course_id' => 'required|exists:courses,id',
                'course_start_date' => 'required|date',
                'course_duration_weeks' => 'required|integer|min:1',
                'accommodation_id' => 'nullable|exists:accommodations,id',
                'accommodation_duration_weeks' => [
                    'nullable',
                    'required_with:accommodation_id',
                    'integer',
                    'min:1',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($value > $request->input('course_duration_weeks')) {
                            $fail('Accommodation duration cannot exceed course duration.');
                        }
                    }
                ],
                'client_birthday' => 'nullable|date',
                'client_nationality_country_id' => 'nullable|exists:countries,id',
                'selected_addons' => 'nullable|array',
                'selected_addons.*' => 'sometimes|boolean',
                'arrival_transfer_airport_id' => 'nullable|exists:airports,id', // Add validation
                'departure_transfer_airport_id' => 'nullable|exists:airports,id', // Add validation
            ]);
        }

        // Prepare parameters for the service
        $quoteParams = $validatedData;

        // Ensure accommodation duration is null if accommodation_id is null
        if (empty($validatedData['accommodation_id'])) {
            $quoteParams['accommodation_duration_weeks'] = null;
        }

        // Handle Christmas accommodation if provided
        if (!empty($validatedData['accommodation_id']) && isset($request->christmas_accommodation)) {
            if ($request->christmas_accommodation === 'yes') {
                $quoteParams['christmas_accommodation'] = true;

                // Add Christmas extra weeks if provided
                if (isset($request->christmas_extra_weeks)) {
                    $quoteParams['christmas_extra_weeks'] = (int) $request->christmas_extra_weeks;
                }

                // Add Christmas dates if provided
                if (isset($request->christmas_start_date) && isset($request->christmas_end_date)) {
                    $quoteParams['christmas_start_date'] = $request->christmas_start_date;
                    $quoteParams['christmas_end_date'] = $request->christmas_end_date;
                }
            }
        }

        // Format selected_addons if necessary
        if (isset($quoteParams['selected_addons'])) {
            $formattedAddons = [];
            foreach ($quoteParams['selected_addons'] as $id => $value) {
                if ($value) {
                    $formattedAddons[$id] = true;
                }
            }
            $quoteParams['selected_addons'] = $formattedAddons;
        }

        // Explicitly add airport transfer IDs if they exist in validated data
        if (isset($validatedData['arrival_transfer_airport_id'])) {
            $quoteParams['arrival_transfer_airport_id'] = $validatedData['arrival_transfer_airport_id'];
        }
        if (isset($validatedData['departure_transfer_airport_id'])) {
            $quoteParams['departure_transfer_airport_id'] = $validatedData['departure_transfer_airport_id'];
        }

        // Calculate the quote
        \Illuminate\Support\Facades\Log::info('Print Quotation - Calculating quote with params:', $quoteParams); // Log params for Print

        // Use split quote calculation if additional course or accommodation is provided
        if (!empty($quoteParams['courses']) || !empty($quoteParams['accommodations'])) {
            $costBreakdown = $calculator->calculateSplitQuote($quoteParams);
        } else {
            $costBreakdown = $calculator->calculateQuote($quoteParams);
        }

        // Add course start date to the cost breakdown for display
        if (isset($validatedData['course_start_date'])) {
            $costBreakdown['course_start_date'] = $validatedData['course_start_date'];
        }

        // Add courses and accommodations data to the cost breakdown for display
        if (!empty($quoteParams['courses'])) {
            // Calculate end dates for each course if not already set
            foreach ($quoteParams['courses'] as $index => $course) {
                if (!isset($course['end_date'])) {
                    // Calculate course end date (Friday of the last week)
                    $startDate = \Carbon\Carbon::parse($course['start_date']);
                    $endDate = $startDate->copy()->addWeeks($course['duration_weeks'] - 1)->addDays(4);
                    $quoteParams['courses'][$index]['end_date'] = $endDate->format('Y-m-d');
                }
            }
            $costBreakdown['courses'] = $quoteParams['courses'];
        }

        if (!empty($quoteParams['accommodations'])) {
            $costBreakdown['accommodations'] = $quoteParams['accommodations'];
        }

        // Get settings for company info and logo
        $settings = Setting::first();

        // Return the view for printing
        return view('admin.quotations.print', [
            'costBreakdown' => $costBreakdown,
            'settings' => $settings
        ]);
    }

    /**
     * Validate split course and accommodation selections.
     *
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateSplitSelections(Request $request): array
    {
        // Validate common fields
        $validatedData = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'region_id' => 'required|exists:regions,id',
            'client_birthday' => 'nullable|date',
            'client_nationality_country_id' => 'nullable|exists:countries,id',
            'selected_addons' => 'nullable|array',
            'selected_addons.*' => 'sometimes|boolean',
            'arrival_transfer_airport_id' => 'nullable|exists:airports,id',
            'departure_transfer_airport_id' => 'nullable|exists:airports,id',
        ]);

        // Validate course selections
        if ($request->has('courses')) {
            $validatedData['courses'] = $request->validate([
                'courses' => 'required|array|min:1',
                'courses.*.course_id' => 'required|exists:courses,id',
                'courses.*.start_date' => 'required|date',
                'courses.*.duration_weeks' => 'required|integer|min:1',
            ])['courses'];

            // Validate that courses are sequential
            $this->validateSequentialCourses($validatedData['courses']);
        }

        // Validate accommodation selections
        if ($request->has('accommodations')) {
            $validatedData['accommodations'] = $request->validate([
                'accommodations' => 'required|array|min:1',
                'accommodations.*.accommodation_id' => 'required|exists:accommodations,id',
                'accommodations.*.duration_weeks' => 'required|integer|min:1',
            ])['accommodations'];

            // Validate that total accommodation duration doesn't exceed total course duration
            $this->validateAccommodationDuration($validatedData);
        }

        return $validatedData;
    }

    /**
     * Validate that courses are sequential without gaps.
     *
     * @param array $courses
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateSequentialCourses(array $courses): void
    {
        if (count($courses) <= 1) {
            return; // No need to validate if there's only one course
        }

        // Sort courses by start date
        usort($courses, function ($a, $b) {
            return strtotime($a['start_date']) - strtotime($b['start_date']);
        });

        // Check that each course starts immediately after the previous one ends
        for ($i = 0; $i < count($courses) - 1; $i++) {
            $currentCourse = $courses[$i];
            $nextCourse = $courses[$i + 1];

            $currentEndDate = \Carbon\Carbon::parse($currentCourse['start_date'])->addWeeks($currentCourse['duration_weeks']);
            $nextStartDate = \Carbon\Carbon::parse($nextCourse['start_date']);

            if (!$currentEndDate->isSameDay($nextStartDate)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    "courses.{$i}.duration_weeks" => ["Course " . ($i + 2) . " must start immediately after Course " . ($i + 1) . " ends."]
                ]);
            }
        }
    }

    /**
     * Validate that total accommodation duration doesn't exceed total course duration.
     *
     * @param array $validatedData
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateAccommodationDuration(array $validatedData): void
    {
        if (empty($validatedData['courses']) || empty($validatedData['accommodations'])) {
            return; // Can't validate if either courses or accommodations are missing
        }

        // Calculate total course duration
        $totalCourseDuration = array_reduce($validatedData['courses'], function ($total, $course) {
            return $total + $course['duration_weeks'];
        }, 0);

        // Calculate total accommodation duration
        $totalAccommodationDuration = array_reduce($validatedData['accommodations'], function ($total, $accommodation) {
            return $total + $accommodation['duration_weeks'];
        }, 0);

        // Validate that total accommodation duration doesn't exceed total course duration
        if ($totalAccommodationDuration > $totalCourseDuration) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'accommodations' => ['Total accommodation duration cannot exceed total course duration.']
            ]);
        }
    }
}