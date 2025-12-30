<?php

// app/Models/Event.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'is_upcoming',
        'user_id',
        'published',
        'published_at'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true)->whereNotNull('published_at');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now())->orderBy('event_date');
    }

    public function scopePast($query)
    {
        return $query->where('event_date', '<', now())->orderByDesc('event_date');
    }
}
