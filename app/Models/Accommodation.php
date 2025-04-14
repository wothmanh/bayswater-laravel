<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_id',
        'name',
        'type',
        'room_type',
        'meal_plan',
        'description',
        'min_age',
        'max_age',
        'requires_guardianship',
        'requires_christmas_supplement',
        'summer_fee_per_week',
        'summer_start_date',
        'summer_end_date',
        'summer_fee_note',
        'active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'requires_guardianship' => 'boolean',
        'requires_christmas_supplement' => 'boolean',
        'summer_start_date' => 'date',
        'summer_end_date' => 'date',
        'active' => 'boolean',
    ];

    /**
     * Get the school that offers the accommodation.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the prices for the accommodation.
     */
    public function accommodationPrices(): HasMany
    {
        return $this->hasMany(AccommodationPrice::class);
    }

    /**
     * Get the discount rules associated with this accommodation.
     */
    public function discountRules(): HasMany
    {
        return $this->hasMany(DiscountRule::class);
    }

    /**
     * Get the quotations that include this accommodation.
     */
    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
}
