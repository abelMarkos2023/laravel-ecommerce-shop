<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
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
            'status' => $this->faker->randomElement(['active','inactive']), // 80% chance of being active
            'logo_image' => $this->faker->imageUrl(640, 480, 'store', true, 'Store'), // Generate a random image URL
            'cover_image' => $this->faker->imageUrl(1280, 720, 'store', true, 'Store Cover'), // Generate a random cover image URL


        ];
    }
}
