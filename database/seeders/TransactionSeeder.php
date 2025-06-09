<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'user')->get();
        $events = Event::with('tickets')->get();
        
        $statuses = ['pending', 'processing', 'completed', 'failed', 'cancelled'];
        
        foreach ($users as $user) {
            foreach ($events->random(5) as $event) {
                $ticket = $event->tickets->random();
                
                Transaction::create([
                    'order_number' => 'OR' . rand(100000, 999999),
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'ticket_id' => $ticket->id,
                    'quantity' => rand(1, 5),
                    'total_price' => $ticket->price * rand(1, 5),
                    'status' => $statuses[array_rand($statuses)],
                    'created_at' => now()->subDays(rand(1, 30))
                ]);
            }
        }
    }
}