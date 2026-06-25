<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Categories
        $categories = collect([
            'Electronics', 'Fashion', 'Home & Garden', 'Sports', 'Books', 'Beauty', 'Toys', 'Automotive',
        ])->map(fn ($name) => Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => "Shop the best $name products.",
            'is_active' => true,
            'sort_order' => 0,
        ]));

        // Vendors with stores and products
        User::factory(5)->vendor()->create()->each(function (User $vendor) use ($categories) {
            $store = Store::factory()->create(['user_id' => $vendor->id]);

            Product::factory(8)->create([
                'store_id' => $store->id,
                'category_id' => $categories->random()->id,
            ]);
        });

        // Customers
        User::factory(10)->create();
    }
}
