<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Category;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs to assign to menu items
        $mieGanasCategory = Category::where('slug', 'mie-ganas')->first();
        $minumanCategory = Category::where('slug', 'minuman')->first();
        $snackCategory = Category::where('slug', 'snack')->first();
        
        $menus = [
            [
                'name' => 'Nasi Goreng',
                'description' => 'Mie Ganas Special Nasi Goreng',
                'price' => 25000,
                'status' => 'active',
                'image' => 'images/nasi-goreng.jpg',
                'category_id' => $mieGanasCategory->id ?? null,
            ],
            [
                'name' => 'Mie Ayam',
                'description' => 'Ayam original dengan kuah gurih',
                'price' => 22000,
                'status' => 'active',
                'image' => 'images/mie-ayam.jpg',
                'category_id' => $mieGanasCategory->id ?? null,
            ],
            [
                'name' => 'Bakso',
                'description' => 'Bakso urat dengan kuah bening',
                'price' => 18000,
                'status' => 'inactive',
                'image' => 'images/bakso.jpg',
                'category_id' => $snackCategory->id ?? null,
            ],
            [
                'name' => 'Sate Ayam',
                'description' => 'Sate ayam dengan bumbu kacang',
                'price' => 20000,
                'status' => 'active',
                'image' => 'images/sate-ayam.jpg',
                'category_id' => $snackCategory->id ?? null,
            ],
            [
                'name' => 'Es Teh',
                'description' => 'Es teh manis segar',
                'price' => 5000,
                'status' => 'active',
                'image' => 'images/es-teh.jpg',
                'category_id' => $minumanCategory->id ?? null,
            ],
            [
                'name' => 'Jus Alpukat',
                'description' => 'Jus alpukat original',
                'price' => 15000,
                'status' => 'active',
                'image' => 'images/jus-alpukat.jpg',
                'category_id' => $minumanCategory->id ?? null,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}