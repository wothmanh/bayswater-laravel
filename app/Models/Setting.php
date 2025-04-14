<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'logo_path',
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
    ];

    /**
     * Get a setting by key
     *
     * @param string $key
     * @return mixed
     */
    public static function getSetting($key)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : null;
    }

    /**
     * Get all settings as key-value pairs
     *
     * @return array
     */
    public static function getAllSettings()
    {
        return self::first() ?: new self();
    }
}
