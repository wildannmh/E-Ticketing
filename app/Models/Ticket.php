<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quantity',
        'remaining',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            if (is_null($ticket->remaining)) {
                $ticket->remaining = $ticket->quantity;
            }
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}