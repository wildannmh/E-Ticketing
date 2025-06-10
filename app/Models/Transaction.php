<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'event_id',
        'ticket_id',
        'quantity',
        'total_price',
        'full_name',
        'email',
        'phone',
        'gender',
        'birth_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-secondary',
            'processing' => 'bg-warning text-dark',
            'completed' => 'bg-success',
            'failed' => 'bg-danger',
            'cancelled' => 'bg-danger'
        ];

        return '<span class="badge '.$badges[$this->status].' px-3 py-2">'.ucfirst($this->status).'</span>';
    }

    public function getFormattedTotalPriceAttribute()
    {
        return number_format($this->total_price, 2, ',', '.');
    }
}