<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// --- Admin Controllers ---
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CourseTypeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\AddonController;
use App\Http\Controllers\Admin\DiscountRuleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CoursePriceController;
use App\Http\Controllers\Admin\CourseScheduleController;
use App\Http\Controllers\Admin\AccommodationPriceController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\AirportController; // Import AirportController
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\QuotationPdfController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Admin Routes ---
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', \App\Http\Middleware\IsAdmin::class]) // Use the full class path directly
    ->group(function () {

        // Country CRUD routes
        Route::resource('countries', CountryController::class);
        // City CRUD routes
        Route::resource('cities', CityController::class);
        // School CRUD routes
        Route::resource('schools', SchoolController::class);
        Route::get('schools/{school}/details', [SchoolController::class, 'getDetails'])->name('schools.get-details');
        Route::get('schools/{school}/airports', [SchoolController::class, 'getAirports'])->name('schools.get-airports'); // AJAX endpoint for airports
        // Currency CRUD routes
        Route::resource('currencies', CurrencyController::class);
        // Course Type CRUD routes
        Route::resource('course-types', CourseTypeController::class); // Use kebab-case for route names
        // Course CRUD routes (with nested pricing and schedules)
        Route::resource('courses', CourseController::class);
        Route::resource('courses.prices', CoursePriceController::class)->shallow()->except(['show', 'index']); // Nested under courses
        Route::resource('courses.schedules', CourseScheduleController::class)->shallow()->except(['show', 'index']); // Nested under courses
        // Accommodation CRUD routes (with nested pricing)
        Route::resource('accommodations', AccommodationController::class);
        // Use a completely different URL pattern for accommodation prices to avoid route collision
        Route::resource('accommodations.prices', AccommodationPriceController::class)
             ->parameters(['prices' => 'accommodation_price']) // Rename parameter
             ->names([
                 'create' => 'accommodations.prices.create',
                 'store' => 'accommodations.prices.store',
                 'edit' => 'accommodation-prices.edit',
                 'update' => 'accommodation-prices.update',
                 'destroy' => 'accommodation-prices.destroy',
             ])
             ->shallow()
             ->except(['show', 'index']);

        // Add custom routes for accommodation prices with a different URL pattern
        Route::get('accommodation-prices/{accommodation_price}/edit', [AccommodationPriceController::class, 'edit'])
             ->name('accommodation-prices.edit');
        Route::put('accommodation-prices/{accommodation_price}', [AccommodationPriceController::class, 'update'])
             ->name('accommodation-prices.update');
        Route::delete('accommodation-prices/{accommodation_price}', [AccommodationPriceController::class, 'destroy'])
             ->name('accommodation-prices.destroy');
        // Addon CRUD routes
        Route::resource('addons', AddonController::class);
        // Discount Rule CRUD routes
        Route::resource('discount-rules', DiscountRuleController::class);
        // User CRUD routes
        Route::resource('users', UserController::class);
        // Region CRUD routes
        Route::resource('regions', RegionController::class);
        // Airport CRUD routes
        Route::resource('airports', AirportController::class);

        // Quotation Calculator Routes
        Route::get('quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
        Route::post('quotations/calculate', [QuotationController::class, 'calculate'])->name('quotations.calculate');
        Route::post('quotations/pdf', [QuotationPdfController::class, 'generatePdf'])->name('quotations.pdf');
        Route::post('quotations/print', [QuotationPdfController::class, 'printQuotation'])->name('quotations.print');
        // Add routes for index, show, store later if needed for saving quotes

        // Settings Routes
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('settings/remove-logo', [SettingController::class, 'removeLogo'])->name('settings.remove-logo');
});


require __DIR__.'/auth.php';
