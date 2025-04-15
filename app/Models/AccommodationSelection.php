<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccommodationSelection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quotation_id',
        'accommodation_id',
        'duration_weeks',
        'sequence_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'duration_weeks' => 'integer',
        'sequence_order' => 'integer',
    ];

    /**
     * Get the quotation that owns the accommodation selection.
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Get the accommodation associated with the selection.
     */
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
