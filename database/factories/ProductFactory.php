<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        $name = fake()->words(3, true);
        $price = fake()->randomFloat(2, 500, 50000);

        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name).'-'.fake()->unique()->randomNumber(5),
            'description' => fake()->paragraphs(3, true),
            'short_description' => fake()->sentence(),
            'price' => $price,
            'compare_price' => fake()->boolean(40) ? $price * fake()->randomFloat(2, 1.1, 1.5) : null,
            'stock' => fake()->numberBetween(0, 200),
            'sku' => strtoupper(fake()->unique()->bothify('SKU-####-???')),
            'status' => 'active',
        ];
    }

    public function draft(): static
    {
        return $this->state(['status' => 'draft']);
    }

    public function outOfStock(): static
    {
        return $this->state(['stock' => 0]);
    }
}
