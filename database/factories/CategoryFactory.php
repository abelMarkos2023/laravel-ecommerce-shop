<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(2, true); // Generate a random name with 2 words
        return [
            'name' => $name,
            'slug' => Str::slug($name), // Generate a random slug
            'description' => $this->faker->sentence, // Generate a random description
            'created_at' => now(), // Set the current timestamp for created_at
            'updated_at' => now(), // Set the current timestamp for updated_at
            'status' => $this->faker->randomElement(['active','archived']), // 80% chance of being active
            'image' => $this->faker->imageUrl(640, 480, 'category', true, 'Category'), // Generate a random image URL

        ];
    }
}
