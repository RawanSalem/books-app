<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
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
            'ISBN' => $this->faker->numberBetween(1000000000, 9999999999),
            'author_id' => Author::factory()->create()->id,
            'publisher_id' => Publisher::factory()->create()->id,
            'description' => $this->faker->text(),
            'publish_date' => $this->faker->date(),
            'rate' => $this->faker->randomFloat(2, 0, 5),
            'pages' => $this->faker->numberBetween(50, 600),
        ];
    }
}
