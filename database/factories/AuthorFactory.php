<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'bio' => $this->faker->sentences(2, true),
            'followers' => $this->faker->numberBetween(10, 500)
        ];
    }
}
