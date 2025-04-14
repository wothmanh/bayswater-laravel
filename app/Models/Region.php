<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import HasFactory
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany

class Region extends Model
{
    use HasFactory; // Add HasFactory trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'active',
    ];

    /**
     * Get the discount rules associated with the region.
     */
    public function discountRules(): HasMany
    {
        return $this->hasMany(DiscountRule::class);
    }
}
