<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicSession extends Model
{
    use HasFactory;

    // In AcademicSession.php
    protected $fillable = [
        'start_year',
        'end_year',
        'name',
        'is_current',           
        'start_date',
        'end_date',
        'description'
    ];

    protected $casts = [
        'start_year' => 'integer',
        'end_year' => 'integer',
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected static function booted()
    {
        // Only auto-generate name on create
        static::creating(function ($session) {
            if (!$session->name) {
                $session->name = "{$session->start_year}/{$session->end_year}";
            }
        });
    }

    public static function getCurrentSessionAndTerm()
    {
        $session = self::where('is_current', true)->first();
        return [$session, $session?->current_term];
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }

    public static function current(): ?self
    {
        return self::where('is_current', true)->first();
    }
}