<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Lomba Nasional', 'icon' => 'fa-flag', 'color' => '#e31e25'],
            ['name' => 'Lomba Terbaru', 'icon' => 'fa-clock', 'color' => '#f5a623'],
            ['name' => 'Lomba Tren', 'icon' => 'fa-fire', 'color' => '#e31e25'],
            ['name' => 'Lomba Disekitar', 'icon' => 'fa-map-marker-alt', 'color' => '#6c757d'],
            ['name' => 'Lomba Internasional', 'icon' => 'fa-globe', 'color' => '#e31e25'],
            ['name' => 'Lomba Tingkat Kota', 'icon' => 'fa-city', 'color' => '#6c757d'],
            ['name' => 'Lomba Tingkat Provinsi', 'icon' => 'fa-map', 'color' => '#f5a623'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}