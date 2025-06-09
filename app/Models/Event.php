<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'location',
        'location_link',
        'start_date',
        'end_date',
        'banner_image',
        'category',
        'policies',
        'is_published'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Event::class, 'event_user')->withTimestamps();
    }
    
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'event_user')->withTimestamps();
    }
}