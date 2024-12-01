<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'author' => fake()->lastName().' '. fake()->firstName(),
            'description' => fake()->paragraphs(3, true),
            'page_count' => fake()->numberBetween(100, 500),
            'category_id' => fake()->numberBetween(1, 5),
        ];
    }
}
