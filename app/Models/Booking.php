<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'event_id',
        'ticket_id',
        'quantity',
        'total_price',
        'status', // contoh: pending, confirmed, cancelled
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // Relasi ke Tiket
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    // Relasi ke Payment
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    // Accessor: Format harga dengan IDR
    public function getFormattedTotalPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    // Accessor: Badge status untuk Blade (HTML)
    public function getStatusBadgeAttribute(): string
    {
        $status = $this->payment?->status ?? 'pending';

        return match ($status) {
            'pending'  => '<span class="badge bg-secondary">Pending</span>',
            'verified' => '<span class="badge bg-success">Verified</span>',
            'rejected' => '<span class="badge bg-danger">Rejected</span>',
            default    => '<span class="badge bg-light text-dark">Unknown</span>',
        };
    }
}
