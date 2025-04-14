<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airport extends Model
{
    use HasFactory; // Optional: Add if you plan to use factories

    protected $fillable = [
        'name',
        'school_id',
        'arrival_price',
        'departure_price',
        'active',
        'city_id',
        'country_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'arrival_price' => 'float',
        'departure_price' => 'float',
        'active' => 'boolean',
    ];

    /**
     * Get the school that owns the airport.
     */
    public function school(): BelongsTo
    {
        // An airport might belong to one primary school (if applicable)
        // Or remove this if an airport isn't directly owned by one school
        // An airport might belong to one primary school (if applicable)
        // Or remove this if an airport isn't directly owned by one school
        // An airport might belong to one primary school (if applicable)
        // Or remove this if an airport isn't directly owned by one school
        return $this->belongsTo(School::class);
    }

    // Optional: Add relationships for city and country if needed
    // public function city(): BelongsTo
    // {
    //     return $this->belongsTo(City::class);
    // }

    // public function country(): BelongsTo
    // {
    //     return $this->belongsTo(Country::class);
    // }
}
