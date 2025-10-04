<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mie Ganas',
                'slug' => 'mie-ganas',
                'description' => 'Menu mie pedas khas Mie Ganas',
                'icon' => 'fa-bowl-rice',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'description' => 'Berbagai pilihan minuman segar',
                'icon' => 'fa-glass-water',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Snack',
                'slug' => 'snack',
                'description' => 'Makanan ringan pendamping',
                'icon' => 'fa-utensils',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Hemat',
                'slug' => 'paket-hemat',
                'description' => 'Paket combo hemat',
                'icon' => 'fa-box',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Dessert',
                'slug' => 'dessert',
                'description' => 'Menu penutup manis',
                'icon' => 'fa-ice-cream',
                'display_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Seafood',
                'slug' => 'seafood',
                'description' => 'Menu seafood segar',
                'icon' => 'fa-fish',
                'display_order' => 6,
                'is_active' => false,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}