<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'name' => $this->faker->name(),
            'followers' => $this->faker->numberBetween(1,1000),
            'established_date' => $this->faker->date(),
            'bio' => $this->faker->sentences(2, true)
        ];
    }
}
