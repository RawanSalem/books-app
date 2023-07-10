<?php

namespace Database\Factories;

use App\Enums\GenderType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReaderFactory extends Factory
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
            'birth_date' => $this->faker->date(),
            'country' => $this->faker->country(),
            'bio' => $this->faker->sentences(2, true),
            'gender' => GenderType::getRandomValue()
        ];
    }
}
