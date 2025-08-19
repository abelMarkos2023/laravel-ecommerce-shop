<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $name = $this->faker->words(4, true); // Generate a random name with 2 words
       return [
            'name' => $name,
            'slug' => Str::slug($name), // Generate a random slug
            'description' => $this->faker->sentence, // Generate a random description
            'created_at' => now(), // Set the current timestamp for created_at
            'updated_at' => now(), // Set the current timestamp for updated_at
            'status' => $this->faker->randomElement(['active','draft','archived']), // 80% chance of being active
            'image' => $this->faker->imageUrl(640, 680, 'product', true, 'Product'), // Generate a random image URL
           'price' => $this->faker->randomFloat(2, 10, 1000), // Generate a random price between 10 and 1000
            'compare_price' => $this->faker->randomFloat(2, 10, 1000), // Generate a random compare price
            'quantity' => $this->faker->numberBetween(1, 100), // Generate a random quantity between 1 and 100
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'is_new' => $this->faker->boolean(30), // 30% chance of being new
            'is_best_seller' => $this->faker->boolean(10), // 10% chance of being a best seller
            'is_top_rated' => $this->faker->boolean(15), // 15% chance of being top rated
            'option' => json_encode(['color' => $this->faker->colorName, 'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL'])]), // Generate random options
            'rating' => $this->faker->randomFloat(1, 5), // Generate a random rating between 1 and 5
           // Generate a random image URL for the store
           'category_id'  => DB::table('categories')->inRandomOrder()->first()->id, // Assuming category_id is set to a random category
           // 'category_id'  => Category::factory(), // Alternatively, you can use a
            'store_id' =>  DB::table('stores')->inRandomOrder()->first()->id, // Assuming store_id will be set later

        ];
    }
}
