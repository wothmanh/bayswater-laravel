<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSelection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quotation_id',
        'course_id',
        'start_date',
        'duration_weeks',
        'sequence_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'duration_weeks' => 'integer',
        'sequence_order' => 'integer',
    ];

    /**
     * Get the quotation that owns the course selection.
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Get the course associated with the selection.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
