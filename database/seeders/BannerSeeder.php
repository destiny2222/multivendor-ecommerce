<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Electronics',
                'subtitle' => 'Starting At',
                'price_info' => '₦125,000.00',
                'image' => 'assets/images/demos/demo2/categories/1-1.jpg',
                'button_link' => '#',
                'position' => 'home_left',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Cosmetics Sets',
                'subtitle' => 'Sale Up To',
                'price_info' => '30% Off',
                'image' => 'assets/images/demos/demo2/categories/1-2.jpg',
                'button_link' => '#',
                'position' => 'home_right',
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['position' => $banner['position']],
                $banner
            );
        }
    }
}
