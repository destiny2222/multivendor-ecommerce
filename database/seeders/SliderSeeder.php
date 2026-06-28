<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Slider::create([
            'title' => 'Top Products <span class="text-primary">At The Best Prices</span> From Verified Vendors',
            'subtitle' => 'Deals And Promotions',
            'description' => null,
            'image' => null, // The image path is hardcoded or should be moved. For seeder we can use dummy or leave null if we adjust the view to check
            'background_image' => null,
            'background_color' => '#f1f0f0',
            'button_text' => 'Shop Now',
            'button_link' => '/products',
            'alignment' => 'right',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        \App\Models\Slider::create([
            'title' => 'Latest Collections',
            'subtitle' => 'New Arrivals',
            'description' => 'Free returns extended to 30 days after delivery',
            'image' => null,
            'background_image' => null,
            'background_color' => '#d9ddd9',
            'button_text' => 'Shop Now',
            'button_link' => '/products',
            'alignment' => 'center', // based on HTML y-50 left aligned usually but it's fine
            'is_active' => true,
            'sort_order' => 2,
        ]);

        \App\Models\Slider::create([
            'title' => 'Best Deals From <span class="text-primary">Verified Stores</span> This Month',
            'subtitle' => 'Top Monthly Sellers',
            'description' => 'Only until the end of this week.',
            'image' => null,
            'background_image' => null,
            'background_color' => '#d0cfcb',
            'button_text' => 'Shop Now',
            'button_link' => '/products',
            'alignment' => 'center',
            'is_active' => true,
            'sort_order' => 3,
        ]);
    }
}
