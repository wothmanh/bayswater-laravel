<?php

namespace App\Services;

use App\Models\Course;
use App\Models\School;
use App\Models\Accommodation;
use App\Models\Airport; // Import Airport model
use App\Models\Currency;
use App\Models\DiscountRule;
use App\Models\CoursePrice;
use App\Models\CourseSchedule;
use App\Models\AccommodationPrice;
use App\Models\Addon;
use Carbon\Carbon; // For date calculations
use Illuminate\Support\Facades\Log; // For logging errors

class FeeCalculatorService
{
    private array $quoteDetails = [];
    private ?School $school = null;
    private ?Currency $currency = null;
    private ?Course $course = null;
    private ?Accommodation $accommodation = null;
    private ?Carbon $startDate = null;
    private ?int $courseWeeks = null;
    private ?int $accommodationWeeks = null;
    private array $selectedAddons = []; // e.g., ['insurance' => true, 'courier' => true, 'airport_arrival_id' => 5]
    private ?int $studentAge = null;
    private ?int $nationalityCountryId = null;
    private ?int $regionId = null; // Add property for region ID
    private bool $christmasAccommodation = false; // Flag for Christmas accommodation option
    private ?Carbon $christmasStartDate = null;
    private ?Carbon $christmasEndDate = null;
    private ?int $christmasExtraWeeks = null; // Number of extra weeks for Christmas accommodation
    private ?int $arrivalAirportId = null; // New property for arrival airport ID
    private ?int $departureAirportId = null; // New property for departure airport ID

    private array $costBreakdown = [
        'items' => [],
        'discounts' => [],
        'subtotals' => [
            'tuition' => 0,
            'accommodation' => 0,
            'fees' => 0,
            'addons' => 0,
        ],
        'total' => 0,
        'currency_code' => '',
        'currency_symbol' => '',
        'errors' => [], // To store calculation errors
        'notes' => [], // To store additional notes about the calculation
    ];

    /**
     * Calculate the full quote based on input parameters.
     *
     * @param array $quoteParams Parameters like school_id, course_id, start_date, course_weeks, etc.
     * @return array The detailed cost breakdown.
     */
    public function calculateQuote(array $quoteParams): array
    {
        try {
            $this->reset();
            if (!$this->loadQuoteDetails($quoteParams)) {
                return $this->costBreakdown; // Return early if loading failed
            }

            // --- Main Calculation Steps ---
            $this->calculateSchoolFees();
            $this->calculateCourseTuition();
            $this->calculateAccommodationCost();
            $this->calculateAddonCosts();
            $this->calculateAirportTransferCosts(); // Calculate airport transfer costs
            $this->applyDiscounts(); // Apply discounts after initial costs are calculated

            $this->calculateTotal();

            // Add metadata to the cost breakdown
            $this->costBreakdown['school_name'] = $this->school->name ?? 'Unknown School';
            $this->costBreakdown['city_name'] = $this->school->city->name ?? 'Unknown City';
            $this->costBreakdown['course_name'] = $this->course->name ?? 'Unknown Course';
            $this->costBreakdown['course_duration_weeks'] = $this->courseWeeks;
            // Add course start date here as well, as it's used in display
            $this->costBreakdown['course_start_date'] = $this->startDate ? $this->startDate->format('Y-m-d') : null;


            return $this->costBreakdown;
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error in FeeCalculatorService: ' . $e->getMessage(), [
                'exception' => $e,
                'params' => $quoteParams
            ]);

            // Add error to the cost breakdown
            $this->addError('An unexpected error occurred during calculation: ' . $e->getMessage());
            return $this->costBreakdown;
        }
    }

    /**
     * Reset calculation state.
     */
    private function reset(): void
    {
        $this->quoteDetails = [];
        $this->school = null;
        $this->currency = null;
        $this->course = null;
        $this->accommodation = null;
        $this->startDate = null;
        $this->courseWeeks = null;
        $this->accommodationWeeks = null;
        $this->selectedAddons = [];
        $this->studentAge = null;
        $this->nationalityCountryId = null;
        $this->regionId = null;
        $this->christmasAccommodation = false;
        $this->christmasStartDate = null;
        $this->christmasEndDate = null;
        $this->christmasExtraWeeks = null;
        $this->arrivalAirportId = null; // Reset airport IDs
        $this->departureAirportId = null;

        $this->costBreakdown = [
            'items' => [],
            'discounts' => [],
            'subtotals' => [
                'tuition' => 0,
                'accommodation' => 0,
                'fees' => 0,
                'addons' => 0,
            ],
            'total' => 0,
            'currency_code' => '',
            'currency_symbol' => '',
            'errors' => [],
            'notes' => [],
        ];
    }

    /**
     * Load and validate necessary models and details from input parameters.
     * Returns false if essential data is missing or invalid.
     *
     * @param array $quoteParams
     * @return bool Success status
     */
    private function loadQuoteDetails(array $quoteParams): bool
    {
        $this->quoteDetails = $quoteParams;

        // --- Load Essential Models ---
        $this->school = School::with('currency', 'city')->find($quoteParams['school_id'] ?? null); // Eager load city
        if (!$this->school) {
            $this->addError('Invalid School ID provided.');
            return false;
        }
        $this->currency = $this->school->currency;
        if (!$this->currency) {
             $this->addError('School is missing a currency configuration.');
             return false;
        }
        $this->costBreakdown['currency_code'] = $this->currency->code;
        $this->costBreakdown['currency_symbol'] = $this->currency->symbol ?? $this->currency->code;

        $this->course = Course::find($quoteParams['course_id'] ?? null);
        if (!$this->course) {
            $this->addError('Invalid Course ID provided.');
            return false;
        }
        if ($this->course->school_id !== $this->school->id) {
             $this->addError('Selected course does not belong to the selected school.');
             return false;
        }

        // --- Load Dates and Durations ---
        try {
            $this->startDate = Carbon::parse($quoteParams['course_start_date'] ?? null);
        } catch (\Exception $e) {
            $this->addError('Invalid Course Start Date provided.');
            return false;
        }
        $this->courseWeeks = isset($quoteParams['course_duration_weeks']) ? (int) $quoteParams['course_duration_weeks'] : null;
        if ($this->courseWeeks === null || $this->courseWeeks < 1) {
             $this->addError('Invalid Course Duration provided.');
             return false;
        }

        // --- Load Optional Accommodation ---
        if (!empty($quoteParams['accommodation_id'])) {
            $this->accommodation = Accommodation::find($quoteParams['accommodation_id']);
            if (!$this->accommodation) {
                $this->addError('Invalid Accommodation ID provided.');
                // Potentially allow continuing without accommodation? Decide based on requirements.
                // return false;
            } elseif ($this->accommodation->school_id !== $this->school->id) {
                 $this->addError('Selected accommodation does not belong to the selected school.');
                 $this->accommodation = null; // Unset invalid accommodation
            } else {
                 $this->accommodationWeeks = isset($quoteParams['accommodation_duration_weeks']) ? (int) $quoteParams['accommodation_duration_weeks'] : null;
                 if ($this->accommodationWeeks === null || $this->accommodationWeeks < 1) {
                      $this->addError('Invalid Accommodation Duration provided.');
                      $this->accommodation = null; // Unset if duration invalid
                 }
            }
        }

        // --- Load Student Details (Optional but needed for some fees/discounts) ---
        if (!empty($quoteParams['client_birthday'])) {
            try {
                $this->studentAge = Carbon::parse($quoteParams['client_birthday'])->age;
            } catch (\Exception $e) {
                 $this->addError('Invalid Client Birthday provided.');
                 // Don't fail, but age-dependent calculations might be skipped
            }
        }

        // --- Load Christmas Accommodation Option ---
        // Use the value directly from the request if present
        // Check for truthiness, as controller now sends boolean true
        $this->christmasAccommodation = !empty($quoteParams['christmas_accommodation']); // Corrected check
        $this->christmasExtraWeeks = isset($quoteParams['christmas_extra_weeks']) ? (int) $quoteParams['christmas_extra_weeks'] : null;

        // Load Christmas dates from request OR school settings
        try {
            if (!empty($quoteParams['christmas_start_date'])) {
                $this->christmasStartDate = Carbon::parse($quoteParams['christmas_start_date']);
            } elseif ($this->school->christmas_start_date) {
                 $this->christmasStartDate = Carbon::parse($this->school->christmas_start_date);
            }

            if (!empty($quoteParams['christmas_end_date'])) {
                $this->christmasEndDate = Carbon::parse($quoteParams['christmas_end_date']);
            } elseif ($this->school->christmas_end_date) {
                 $this->christmasEndDate = Carbon::parse($this->school->christmas_end_date);
            }
        } catch (\Exception $e) {
            $this->addError('Invalid Christmas period dates provided.');
            // Don't fail, but Christmas accommodation might not be calculated correctly
        }

        Log::info('Loaded Christmas Details:', [
            'christmasAccommodation' => $this->christmasAccommodation,
            'christmasExtraWeeks' => $this->christmasExtraWeeks,
            'christmasStartDate' => $this->christmasStartDate ? $this->christmasStartDate->toDateString() : null,
            'christmasEndDate' => $this->christmasEndDate ? $this->christmasEndDate->toDateString() : null,
        ]);


        $this->nationalityCountryId = $quoteParams['client_nationality_country_id'] ?? null;
        $this->regionId = $quoteParams['region_id'] ?? null; // Load region ID

        // --- Load Selected Addons ---
        $this->selectedAddons = $quoteParams['selected_addons'] ?? []; // Expecting an array like ['addon_id_1' => true, 'addon_id_5' => ['weeks' => 10]]

        // --- Load Airport Transfer IDs ---
        $this->arrivalAirportId = $quoteParams['arrival_transfer_airport_id'] ?? null;
        $this->departureAirportId = $quoteParams['departure_transfer_airport_id'] ?? null;

        return true; // Loading successful
    }

    /**
     * Calculate mandatory school fees (registration, bank charges, etc.).
     */
    private function calculateSchoolFees(): void
    {
        if (!$this->school) return;

        // Check for registration fee waiver before adding
        $hasRegFeeWaiver = collect($this->costBreakdown['discounts'])->contains('applied_to', 'registration_fee_waiver');
        if ($this->school->registration_fee > 0 && !$hasRegFeeWaiver) {
            $this->addItem('Registration Fee', $this->school->registration_fee, 'fees');
        } elseif ($hasRegFeeWaiver) {
             Log::info('Registration fee waived.'); // Optional logging
        }

         if ($this->school->bank_charges > 0) {
             $this->addItem('Bank Charges', $this->school->bank_charges, 'fees');
         }

        // Books Fee
        if ($this->school->books_fee > 0) {
            $booksFee = $this->school->books_fee;
            $booksFeeName = 'Books Fee';
            if ($this->school->books_weeks > 0 && $this->courseWeeks > 0) {
                // Apply fee for every X weeks, rounding up
                $multiplier = ceil($this->courseWeeks / $this->school->books_weeks);
                $booksFee *= $multiplier;
                $booksFeeName .= " (Applied every {$this->school->books_weeks} weeks)";
            }
            $this->addItem($booksFeeName, $booksFee, 'fees');
        }

        // Guardianship/Custodianship Fees (Under 18)
        if ($this->studentAge !== null && $this->studentAge < 18) {
            // Check if accommodation is selected AND requires guardianship
            if ($this->school->guardianship_fee_per_week > 0 && $this->accommodation && $this->accommodation->requires_guardianship && $this->accommodationWeeks > 0) {
                 $guardianshipTotal = $this->school->guardianship_fee_per_week * $this->accommodationWeeks;
                 $this->addItem('Guardianship Fee (U18)', $guardianshipTotal, 'fees');
            }
            // Custodianship fee might be independent of accommodation type, keep as is unless specified otherwise
            if ($this->school->custodianship_fee > 0) {
                 $this->addItem('Custodianship Fee (U18)', $this->school->custodianship_fee, 'fees');
            }
        }
    }

    /**
     * Calculate the course tuition based on pricing type (per week or fixed schedule).
     */
    private function calculateCourseTuition(): void
    {
        if (!$this->course || !$this->courseWeeks || !$this->startDate) return;

        $tuitionPrice = 0;
        $itemName = $this->course->name;

        if ($this->course->pricing_type === 'per_week') {
            $pricePerWeek = $this->getCoursePricePerWeek();
            if ($pricePerWeek === null) {
                $this->addError("Could not find weekly price for '{$this->course->name}' for {$this->courseWeeks} weeks.");
                return;
            }
            $tuitionPrice = $pricePerWeek * $this->courseWeeks;
            $itemName .= ' (' . $this->courseWeeks . ' weeks)';
        } elseif ($this->course->pricing_type === 'fixed_schedule') {
            $schedule = $this->getCourseFixedSchedule();
            if (!$schedule) {
                 $this->addError("Could not find schedule for '{$this->course->name}' starting {$this->startDate->toDateString()} for {$this->courseWeeks} weeks.");
                 return;
            }
            $tuitionPrice = $schedule->fixed_price;
             $itemName .= ' (' . $schedule->start_date->format('Y-m-d') . ' - ' . $schedule->duration_weeks . ' weeks)';
        }

         $this->addItem($itemName, $tuitionPrice, 'tuition');

        // Add Course Summer Supplement
        if ($this->school->summer_fee_per_week > 0 && $this->school->summer_start_date && $this->school->summer_end_date) {
            $courseEndDate = $this->startDate->copy()->addWeeks($this->courseWeeks);
            $overlapWeeks = $this->calculateOverlapWeeks(
                $this->startDate,
                $courseEndDate,
                Carbon::parse($this->school->summer_start_date),
                Carbon::parse($this->school->summer_end_date)
            );

            // Check if the supplement should be waived based on course duration
            $waiveSupplement = $this->school->summer_fee_weeks_off !== null && $this->courseWeeks >= $this->school->summer_fee_weeks_off;

            if ($overlapWeeks > 0 && !$waiveSupplement) {
                $summerFee = $overlapWeeks * $this->school->summer_fee_per_week;
                $this->addItem('Course Summer Supplement', $summerFee, 'fees');
            }
        }
    }

     /**
      * Get course price per week based on duration.
      * Returns null if no matching active price range is found.
      */
     private function getCoursePricePerWeek(): ?float
     {
         if (!$this->course || !$this->courseWeeks) {
             return null;
         }

         // Find the active price range that includes the requested number of weeks
         $price = CoursePrice::where('course_id', $this->course->id)
                             ->where('min_weeks', '<=', $this->courseWeeks)
                             ->where('max_weeks', '>=', $this->courseWeeks)
                             ->where('active', true)
                             ->orderBy('min_weeks', 'desc') // Prioritize the narrowest matching range if overlapping
                             ->first();

         return $price ? (float) $price->price_per_week : null;
     }

     /**
      * Get fixed course schedule based on start date and duration.
      * Returns null if no matching active schedule is found.
      */
     private function getCourseFixedSchedule(): ?CourseSchedule
     {
         if (!$this->course || !$this->startDate || !$this->courseWeeks) {
             return null;
         }

         // Find the active schedule matching the exact start date and duration
         return CourseSchedule::where('course_id', $this->course->id)
                              ->where('start_date', $this->startDate->toDateString())
                              ->where('duration_weeks', $this->courseWeeks)
                              ->where('active', true)
                              ->first();
     }


    /**
     * Calculate the accommodation cost.
     */
    private function calculateAccommodationCost(): void
    {
        if (!$this->accommodation || !$this->accommodationWeeks) return;

        // Get price for the base duration first
        $pricePerWeek = $this->getAccommodationPricePerWeek();

        // Add base accommodation cost if price was found
        if ($pricePerWeek !== null) {
            $accommodationPrice = $pricePerWeek * $this->accommodationWeeks;
            $itemName = $this->accommodation->name . ' (' . $this->accommodationWeeks . ' weeks)';
            $this->addItem($itemName, $accommodationPrice, 'accommodation');
        } else {
             $this->addError("Could not find weekly price for '{$this->accommodation->name}' for {$this->accommodationWeeks} weeks.");
             // Continue to calculate other fees even if base price is missing
        }

        // Add Placement Fee (doesn't depend on pricePerWeek)
        $hasAccommFeeWaiver = collect($this->costBreakdown['discounts'])->contains('applied_to', 'accommodation_fee_waiver');
        if ($this->school?->accommodation_fee > 0 && !$hasAccommFeeWaiver) {
             $this->addItem('Accommodation Placement Fee', $this->school->accommodation_fee, 'fees');
        } elseif ($hasAccommFeeWaiver) {
             Log::info('Accommodation placement fee waived.');
        }

        // Calculate accommodation end date
        $accommodationEndDate = $this->startDate->copy()->addWeeks($this->accommodationWeeks);

        // Add Accommodation Summer Supplement (doesn't depend on pricePerWeek)
        if ($this->accommodation->summer_fee_per_week > 0 && $this->accommodation->summer_start_date && $this->accommodation->summer_end_date) {
            $overlapWeeks = $this->calculateOverlapWeeks(
                $this->startDate,
                $accommodationEndDate,
                Carbon::parse($this->accommodation->summer_start_date),
                Carbon::parse($this->accommodation->summer_end_date)
            );
            if ($overlapWeeks > 0) {
                $summerFee = $overlapWeeks * $this->accommodation->summer_fee_per_week;
                $this->addItem('Accommodation Summer Supplement', $summerFee, 'fees');
            }
        }

        // Add Accommodation Christmas Supplement & Extra Weeks Cost
        $christmasSupplementApplies = $this->christmasAccommodation || $this->accommodation->requires_christmas_supplement;
        $hasChristmasDates = $this->christmasStartDate && $this->christmasEndDate;

        if ($christmasSupplementApplies && $hasChristmasDates) {

            $overlapWeeks = $this->calculateOverlapWeeks(
                $this->startDate,
                $accommodationEndDate,
                $this->christmasStartDate,
                $this->christmasEndDate
            );

            // Add Christmas Supplement Fee
            if ($overlapWeeks > 0 && $this->school->christmas_fee_per_week > 0) {
                $christmasFee = $overlapWeeks * $this->school->christmas_fee_per_week;
                $this->addItem('Accommodation Christmas Supplement', $christmasFee, 'fees');
            }

            // Add note and extra weeks cost ONLY if Christmas accommodation was explicitly requested
            if ($this->christmasAccommodation) {
                 $noteText = 'Includes accommodation during Christmas period: ' .
                     $this->christmasStartDate->format('M j, Y') . ' to ' . $this->christmasEndDate->format('M j, Y');

                 // Add extra weeks cost if applicable
                 if ($this->christmasExtraWeeks > 0) {
                     Log::info('Attempting to calculate Extra Christmas Weeks cost.', [
                        'christmasExtraWeeks' => $this->christmasExtraWeeks,
                        'pricePerWeek' => $pricePerWeek // Log the price used
                     ]);
                     $extraWeeksText = $this->christmasExtraWeeks . ' extra ' .
                         ($this->christmasExtraWeeks === 1 ? 'week' : 'weeks');
                     $noteText .= ' (' . $extraWeeksText . ')';

                     // Use the previously fetched $pricePerWeek for the calculation
                     if ($pricePerWeek !== null) {
                         $extraAccommodationItem = 'Extra Christmas Accommodation (' . $extraWeeksText . ')';
                         $extraWeeksCost = $this->christmasExtraWeeks * $pricePerWeek;
                         Log::info('Adding Extra Christmas Accommodation item:', ['name' => $extraAccommodationItem, 'amount' => $extraWeeksCost]);
                         $this->addItem($extraAccommodationItem, $extraWeeksCost, 'fees');
                     } else {
                         // Log warning and add error if price is missing but extra weeks were requested
                         Log::warning('Cannot add Extra Christmas Accommodation cost because base pricePerWeek is null.', ['weeks' => $this->christmasExtraWeeks]);
                         $this->addError("Could not calculate cost for extra Christmas weeks because the base accommodation price is missing.");
                     }
                 }
                 $this->costBreakdown['notes'][] = $noteText;
            }
        }
    }


     /**
      * Get accommodation price per week based on duration.
      * Returns null if no matching active price range is found.
      */
     private function getAccommodationPricePerWeek(): ?float
     {
         if (!$this->accommodation || !$this->accommodationWeeks) {
             return null;
         }

         // Find the active price range that includes the requested number of weeks
         $price = AccommodationPrice::where('accommodation_id', $this->accommodation->id)
                                    ->where('min_weeks', '<=', $this->accommodationWeeks)
                                    ->where('max_weeks', '>=', $this->accommodationWeeks)
                                    ->where('active', true)
                                    ->orderBy('min_weeks', 'desc') // Prioritize the narrowest matching range
                                    ->first();

         return $price ? (float) $price->price_per_week : null;
     }

    /**
     * Calculate costs for selected addons (insurance, courier, transfers).
     */
    private function calculateAddonCosts(): void
    {
        if (empty($this->selectedAddons)) return;

        $addonIds = array_keys($this->selectedAddons); // Assuming keys are addon IDs
        $addons = Addon::whereIn('id', $addonIds)->where('active', true)->get()->keyBy('id');

        foreach ($this->selectedAddons as $addonId => $details) {
            if (!isset($addons[$addonId])) {
                $this->addError("Selected addon ID {$addonId} not found or inactive.");
                continue;
            }

            $addon = $addons[$addonId];
            $addonCost = 0;
            $itemName = $addon->name;

            if ($addon->price_type === 'per_week') {
                // Assume addon duration matches course duration if not specified otherwise
                $weeks = $details['weeks'] ?? $this->courseWeeks;
                if ($weeks === null || $weeks < 1) {
                     $this->addError("Invalid duration for weekly addon '{$addon->name}'.");
                     continue;
                }
                $addonCost = $addon->price * $weeks;
                $itemName .= " ({$weeks} weeks)";
            } else { // one_time
                $addonCost = $addon->price;
            }

            $this->addItem($itemName, $addonCost, 'addons');
        }
    }

    /**
     * Calculate costs for selected airport transfers.
     */
    private function calculateAirportTransferCosts(): void
    {
        if ($this->arrivalAirportId) {
            $airport = Airport::find($this->arrivalAirportId);
            if ($airport && $airport->arrival_price > 0) {
                $itemName = 'Arrival Transfer: ' . $airport->name;
                $itemAmount = $airport->arrival_price;
                Log::info('Adding Arrival Transfer item', ['name' => $itemName, 'amount' => $itemAmount]); // Log adding item
                $this->addItem($itemName, $itemAmount, 'fees');
            } elseif ($airport) {
                Log::warning('Selected arrival airport has no arrival price configured.', ['airport_id' => $this->arrivalAirportId]);
            } else {
                 $this->addError("Selected arrival airport ID {$this->arrivalAirportId} not found.");
            }
        }

        if ($this->departureAirportId) {
            $airport = Airport::find($this->departureAirportId);
            if ($airport && $airport->departure_price > 0) {
                $itemName = 'Departure Transfer: ' . $airport->name;
                $itemAmount = $airport->departure_price;
                Log::info('Adding Departure Transfer item', ['name' => $itemName, 'amount' => $itemAmount]); // Log adding item
                $this->addItem($itemName, $itemAmount, 'fees');
            } elseif ($airport) {
                 Log::warning('Selected departure airport has no departure price configured.', ['airport_id' => $this->departureAirportId]);
            } else {
                 $this->addError("Selected departure airport ID {$this->departureAirportId} not found.");
            }
        }
    }


    /**
     * Apply relevant discounts based on the calculated items and quote details.
     */
    private function applyDiscounts(): void
    {
        // Fetch potentially applicable discount rules (active, global or for the specific school)
        $rules = DiscountRule::where('active', true)
            ->where(function ($query) {
                $query->whereNull('school_id') // Global rules
                      ->orWhere('school_id', $this->school->id); // School-specific rules
            })
            // Add region condition to the query
            ->where(function ($query) {
                 $query->whereNull('region_id') // Global discounts (no region specified)
                       ->orWhere('region_id', $this->regionId); // Region-specific discounts
            })
            ->orderBy('priority', 'asc') // Apply lower priority numbers first
            ->get();

        $appliedDiscounts = []; // Track applied non-combinable discounts per category

        foreach ($rules as $rule) {
            if ($this->checkDiscountConditions($rule)) {
                // Check if a non-combinable discount for this category has already been applied
                $appliesToCategory = $this->getDiscountCategory($rule->applies_to);
                if (!$rule->combinable && isset($appliedDiscounts[$appliesToCategory])) {
                    continue; // Skip if a non-combinable discount already applied to this category
                }

                $discountAmount = $this->calculateDiscountAmount($rule);

                if ($discountAmount > 0) {
                    $this->addDiscount($rule->name, $discountAmount, $rule->applies_to);

                    // Mark this category as having a non-combinable discount applied
                    if (!$rule->combinable) {
                        $appliedDiscounts[$appliesToCategory] = true;
                    }
                } elseif ($rule->discount_type === 'fee_waiver') {
                    // Handle fee waiver specifically (amount is 0, but we mark it)
                     $this->addDiscount($rule->name, 0, $rule->applies_to . '_waiver'); // Mark as waiver
                     if (!$rule->combinable) {
                         $appliedDiscounts[$appliesToCategory] = true;
                     }
                     // Note: Actual fee removal might need adjustment in calculateSchoolFees or other methods
                     // Or adjust total calculation to consider waivers. Simpler for now to just list it.
                }
            }
        }
    }

    /**
     * Check if the conditions of a discount rule match the current quote details.
     *
     * @param DiscountRule $rule
     * @return bool
     */
    private function checkDiscountConditions(DiscountRule $rule): bool
    {
        // School condition (already pre-filtered, but good for clarity)
        if ($rule->school_id !== null && $rule->school_id !== $this->school->id) {
            return false;
        }

        // Nationality condition
        if ($rule->country_id !== null && $rule->country_id !== $this->nationalityCountryId) {
            return false;
        }

        // Region condition (double-check, though filtered in query)
        if ($rule->region_id !== null && $rule->region_id !== $this->regionId) {
            return false;
        }

        // Course condition
        if ($rule->course_id !== null && $rule->course_id !== $this->course->id) {
            return false;
        }

        // Course Type condition
        if ($rule->course_type_id !== null && $rule->course_type_id !== $this->course->course_type_id) {
            return false;
        }

        // Accommodation condition
        if ($rule->accommodation_id !== null && (!$this->accommodation || $rule->accommodation_id !== $this->accommodation->id)) {
            return false;
        }
        // Accommodation Type condition
        if ($rule->accommodation_type !== null && (!$this->accommodation || !str_contains(strtolower($this->accommodation->type ?? ''), strtolower($rule->accommodation_type)))) {
             return false;
        }


        // Course Weeks condition
        if ($rule->min_course_weeks !== null && $this->courseWeeks < $rule->min_course_weeks) {
            return false;
        }
        if ($rule->max_course_weeks !== null && $this->courseWeeks > $rule->max_course_weeks) {
            return false;
        }

        // Accommodation Weeks condition
        if ($rule->min_accommodation_weeks !== null && (!$this->accommodationWeeks || $this->accommodationWeeks < $rule->min_accommodation_weeks)) {
            return false;
        }
         if ($rule->max_accommodation_weeks !== null && (!$this->accommodationWeeks || $this->accommodationWeeks > $rule->max_accommodation_weeks)) {
             return false;
         }

        // Date conditions
        if ($rule->valid_from_date !== null || $rule->valid_to_date !== null) {
            $comparisonDate = null;
            if ($rule->date_condition_type === 'start_date') {
                $comparisonDate = $this->startDate;
            } elseif ($rule->date_condition_type === 'booking_date') {
                $comparisonDate = Carbon::now(); // Use current date for booking date check
            }

            if ($comparisonDate) {
                if ($rule->valid_from_date !== null && $comparisonDate->lt(Carbon::parse($rule->valid_from_date))) {
                    return false;
                }
                if ($rule->valid_to_date !== null && $comparisonDate->gt(Carbon::parse($rule->valid_to_date))) {
                    return false;
                }
            } else if ($rule->valid_from_date !== null || $rule->valid_to_date !== null) {
                 // If date condition type is not set but dates are, rule is invalid/incomplete
                 return false;
            }
        }

        // Addon condition (checked when applying discount, not here)

        return true; // All conditions passed
    }

    /**
     * Calculate the actual discount amount based on the rule type and value.
     *
     * @param DiscountRule $rule
     * @return float
     */
    private function calculateDiscountAmount(DiscountRule $rule): float
    {
        $baseAmount = 0;

        switch ($rule->applies_to) {
            case 'course_tuition':
                $baseAmount = $this->costBreakdown['subtotals']['tuition'];
                break;
            case 'accommodation_price':
                 $baseAmount = $this->costBreakdown['subtotals']['accommodation'];
                 break;
            case 'registration_fee':
                 // Find registration fee item if added
                 foreach ($this->costBreakdown['items'] as $item) {
                     if ($item['name'] === 'Registration Fee' && $item['category'] === 'fees') {
                         $baseAmount = $item['amount'];
                         break;
                     }
                 }
                 break;
             case 'accommodation_fee':
                  // Find accommodation placement fee item if added
                  foreach ($this->costBreakdown['items'] as $item) {
                      if ($item['name'] === 'Accommodation Placement Fee' && $item['category'] === 'fees') {
                          $baseAmount = $item['amount'];
                          break;
                      }
                  }
                  break;
            case 'addon':
                if ($rule->addon_id === null) return 0; // Should not happen if validation is correct
                // Find the specific addon item cost
                $addon = Addon::find($rule->addon_id); // Fetch addon details if needed (e.g., name)
                if (!$addon) return 0;
                foreach ($this->costBreakdown['items'] as $item) {
                    // Match based on name - might need refinement if names aren't unique enough
                    // A better approach might be to store addon_id with the item in addItem
                    if (str_starts_with($item['name'], $addon->name) && $item['category'] === 'addons') {
                        $baseAmount = $item['amount'];
                        break;
                    }
                }
                break;
        }

        if ($baseAmount <= 0) {
            return 0; // No base amount to apply discount to
        }

        // Calculate discount
        if ($rule->discount_type === 'percentage') {
            return ($baseAmount * $rule->discount_value) / 100;
        } elseif ($rule->discount_type === 'fixed_amount') {
            // Ensure fixed amount doesn't exceed the base amount
            return min($baseAmount, $rule->discount_value);
        } elseif ($rule->discount_type === 'fee_waiver') {
             // Return the full base amount for waiver, handled by addDiscount
             return $baseAmount;
        } elseif ($rule->discount_type === 'fixed_amount_per_week') {
            // This type requires calculating overlapping weeks
            if ($rule->applies_to !== 'accommodation_price' || !$this->accommodationWeeks || !$this->startDate || !$rule->valid_from_date || !$rule->valid_to_date) {
                // Only applicable to accommodation and requires dates/duration
                return 0;
            }

            $accommodationEndDate = $this->startDate->copy()->addWeeks($this->accommodationWeeks);
            $discountStartDate = Carbon::parse($rule->valid_from_date);
            $discountEndDate = Carbon::parse($rule->valid_to_date);

            $overlapWeeks = $this->calculateOverlapWeeks(
                $this->startDate,
                $accommodationEndDate,
                $discountStartDate,
                $discountEndDate
            );

            if ($overlapWeeks > 0) {
                // Calculate total discount based on overlapping weeks and weekly amount
                $totalDiscount = $overlapWeeks * $rule->discount_value;
                // Ensure discount doesn't exceed the total accommodation cost for those weeks
                // Note: $baseAmount here is the *total* accommodation cost, not per week.
                // We need the weekly price to cap the discount correctly per week, but for simplicity,
                // we'll cap against the total base amount for now. A more precise calculation
                // might be needed if discounts could make weekly price negative.
                return min($baseAmount, $totalDiscount);
            }
        }

        return 0;
    }

     /**
      * Get the cost category associated with a discount's 'applies_to' field.
      * Used for tracking non-combinable discounts.
      *
      * @param string $appliesTo
      * @return string
      */
     private function getDiscountCategory(string $appliesTo): string
     {
         return match ($appliesTo) {
             'course_tuition' => 'tuition',
             'accommodation_price' => 'accommodation',
             'registration_fee', 'accommodation_fee' => 'fees',
             'addon' => 'addons', // Or potentially more granular if needed
             default => 'unknown',
         };
     }

    /**
     * Calculate the final total based on subtotals and applied discounts.
     */
    private function calculateTotal(): void
    {
        $total = 0;
        foreach ($this->costBreakdown['subtotals'] as $subtotal) {
            $total += $subtotal;
        }

        // Subtract discounts
        $totalDiscount = 0;
        foreach ($this->costBreakdown['discounts'] as $discount) {
            $totalDiscount += $discount['amount'];
        }
        $total -= $totalDiscount;

        $this->costBreakdown['total'] = max(0, $total); // Ensure total is not negative
    }

    /**
     * Helper to add an item to the cost breakdown.
     */
    private function addItem(string $name, float $amount, string $category): void
    {
        if ($amount <= 0) return;

        $this->costBreakdown['items'][] = [
            'name' => $name,
            'amount' => round($amount, 2), // Round to 2 decimal places
            'category' => $category,
        ];
        // Ensure the subtotal category exists before adding
        if (!isset($this->costBreakdown['subtotals'][$category])) {
            $this->costBreakdown['subtotals'][$category] = 0;
        }
        $this->costBreakdown['subtotals'][$category] += round($amount, 2);
    }


     /**
      * Helper to add a discount to the cost breakdown.
      */
     private function addDiscount(string $name, float $amount, string $appliedTo): void
     {
         // Allow 0 amount only for waivers, otherwise amount must be positive
         if ($amount <= 0 && !str_ends_with($appliedTo, '_waiver')) return;

         $this->costBreakdown['discounts'][] = [
             'name' => $name,
             'amount' => round($amount, 2), // Store as positive value representing deduction
             'applied_to' => $appliedTo,
         ];
     }

     /**
      * Add an error message to the breakdown.
      */
     private function addError(string $message): void
     {
         Log::error("FeeCalculatorService Error: " . $message, $this->quoteDetails);
         $this->costBreakdown['errors'][] = $message;
     }

    /**
     * Calculate the number of full weeks overlapping between two date ranges.
     *
     * @param Carbon $range1Start
     * @param Carbon $range1End
     * @param Carbon $range2Start
     * @param Carbon $range2End
     * @return int Number of overlapping weeks
     */
    private function calculateOverlapWeeks(Carbon $range1Start, Carbon $range1End, Carbon $range2Start, Carbon $range2End): int
    {
        // Find the actual start and end of the overlap period
        $overlapStart = $range1Start->max($range2Start);
        $overlapEnd = $range1End->min($range2End);

        // Check if there is any overlap
        if ($overlapStart->greaterThanOrEqualTo($overlapEnd)) {
            return 0; // No overlap or touches at the boundary
        }

        // Calculate the difference in days and convert to full weeks
        // Add 1 day because diffInDays is exclusive of the end date for full days
        $overlapDays = $overlapStart->diffInDays($overlapEnd) +1;

        // Calculate full weeks, rounding down.
        // Use 7 days per week for calculation.
        return floor($overlapDays / 7);
    }
}
