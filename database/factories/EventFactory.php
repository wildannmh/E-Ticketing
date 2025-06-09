<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition()
    {
        return [
            'organizer_id' => \App\Models\Organizer::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->address,
            'start_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'category' => $this->faker->randomElement(['Expo', 'Concert', 'Workshop', 'Seminar']),
            'policies' => $this->faker->paragraphs(2, true),
            'is_published' => true,
        ];
    }
}