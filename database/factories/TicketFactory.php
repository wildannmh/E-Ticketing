<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition()
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'name' => $this->faker->word . ' Ticket',
            'price' => $this->faker->numberBetween(10000, 100000),
            'quantity' => $this->faker->numberBetween(50, 500),
            'description' => $this->faker->sentence,
        ];
    }
}