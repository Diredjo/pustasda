<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            ['name' => 'Teknologi Informasi', 'icon' => 'fa-laptop-code'],
            ['name' => 'Sains & Matematika', 'icon' => 'fa-flask'],
            ['name' => 'Seni & Desain', 'icon' => 'fa-paint-brush'],
            ['name' => 'Bahasa & Sastra', 'icon' => 'fa-book'],
            ['name' => 'Kewirausahaan', 'icon' => 'fa-chart-line'],
            ['name' => 'Robotika', 'icon' => 'fa-robot'],
            ['name' => 'Multimedia', 'icon' => 'fa-film'],
            ['name' => 'Networking', 'icon' => 'fa-network-wired'],
        ];

        foreach ($fields as $field) {
            Field::create($field);
        }
    }
}