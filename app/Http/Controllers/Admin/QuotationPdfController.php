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
        // Validate the request
        $validatedData = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'region_id' => 'required|exists:regions,id',
            'course_id' => 'required|exists:courses,id',
            'course_start_date' => 'required|date',
            'course_duration_weeks' => 'required|integer|min:1',
            'accommodation_id' => 'nullable|exists:accommodations,id',
            'accommodation_duration_weeks' => 'nullable|required_with:accommodation_id|integer|min:1',
            'client_birthday' => 'nullable|date',
            'client_nationality_country_id' => 'nullable|exists:countries,id',
            'selected_addons' => 'nullable|array',
            'selected_addons.*' => 'sometimes|boolean',
            'arrival_transfer_airport_id' => 'nullable|exists:airports,id', // Add validation
            'departure_transfer_airport_id' => 'nullable|exists:airports,id', // Add validation
        ]);

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
        $costBreakdown = $calculator->calculateQuote($quoteParams);

        // Add course start date to the cost breakdown for display
        $costBreakdown['course_start_date'] = $validatedData['course_start_date'];

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
        // Validate the request
        $validatedData = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'region_id' => 'required|exists:regions,id',
            'course_id' => 'required|exists:courses,id',
            'course_start_date' => 'required|date',
            'course_duration_weeks' => 'required|integer|min:1',
            'accommodation_id' => 'nullable|exists:accommodations,id',
            'accommodation_duration_weeks' => 'nullable|required_with:accommodation_id|integer|min:1',
            'client_birthday' => 'nullable|date',
            'client_nationality_country_id' => 'nullable|exists:countries,id',
            'selected_addons' => 'nullable|array',
            'selected_addons.*' => 'sometimes|boolean',
            'arrival_transfer_airport_id' => 'nullable|exists:airports,id', // Add validation
            'departure_transfer_airport_id' => 'nullable|exists:airports,id', // Add validation
        ]);

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
        $costBreakdown = $calculator->calculateQuote($quoteParams);

        // Add course start date to the cost breakdown for display
        $costBreakdown['course_start_date'] = $validatedData['course_start_date'];

        // Get settings for company info and logo
        $settings = Setting::first();

        // Return the view for printing
        return view('admin.quotations.print', [
            'costBreakdown' => $costBreakdown,
            'settings' => $settings
        ]);
    }
}
