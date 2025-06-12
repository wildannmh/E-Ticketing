<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'logo',
        'contact_email',
        'contact_phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    protected static function booted()
    {
        static::deleting(function ($organizer) {
            // Cek apakah organizer memiliki user terkait
            if ($organizer->user) {
                // Kembalikan role user ke 'user'
                $organizer->user->update(['role' => 'user']);
            }
        });
    }
}