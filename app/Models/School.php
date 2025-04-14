<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'name',
        'currency_id',
        'registration_fee',
        'accommodation_fee',
        'bank_charges',
        'books_fee',
        'books_weeks',
        'insurance_fee_per_week',
        'courier_fee',
        'guardianship_fee_per_week',
        'custodianship_fee',
        'christmas_fee_per_week',
        'christmas_start_date',
        'christmas_end_date',
        'extra_accommodation_weeks',
        'summer_fee_per_week',
        'summer_start_date',
        'summer_end_date',
        'summer_fee_weeks_off',
        'summer_fee_note',
        'active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'christmas_start_date' => 'date',
        'christmas_end_date' => 'date',
        'summer_start_date' => 'date',
        'summer_end_date' => 'date',
        'active' => 'boolean',
    ];

    /**
     * Get the city that owns the school.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the currency for the school.
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the courses for the school.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Get the accommodations for the school.
     */
    public function accommodations(): HasMany
    {
        return $this->hasMany(Accommodation::class);
    }

    /**
     * Get the addons for the school.
     */
    public function addons(): HasMany
    {
        return $this->hasMany(Addon::class);
    }

    /**
     * Get the discount rules specific to this school.
     */
    public function discountRules(): HasMany
    {
        return $this->hasMany(DiscountRule::class);
    }

     /**
     * Get the quotations associated with this school.
     */
    public function quotations(): HasMany
    {
         return $this->hasMany(Quotation::class);
    }

     /**
      * Get the airports associated with the school.
      */
     public function airports(): HasMany
     {
         return $this->hasMany(Airport::class);
     }
 }
