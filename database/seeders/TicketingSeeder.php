<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketingSeeder extends Seeder
{
    public function run()
    {
        // Buat user
        $user = User::factory()->create([
            'name' => 'Munawar',
            'email' => 'munawar@example.com',
            'password' => bcrypt('password')
        ]);

        // Buat event dengan tiket
        $event = Event::factory()->create([
            'title' => 'Atrium Eastcoast 2025',
            'category' => 'Expo',
            'location' => 'Pakuwon City Mall, Surabaya',
            'start_date' => now()->addMonths(3),
            'is_published' => true
        ]);

        Ticket::factory()->create([
            'event_id' => $event->id,
            'name' => 'Regular Ticket',
            'price' => 80000,
            'quantity' => 100
        ]);
    }
}