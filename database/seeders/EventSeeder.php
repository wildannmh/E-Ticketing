<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organizer;
use App\Models\Event;
use App\Models\Ticket;

class EventSeeder extends Seeder
{
    public function run()
    {
        Organizer::factory(5)
            ->has(
                Event::factory(3)
                    ->has(Ticket::factory(2))
            )
            ->create();
    }
}
