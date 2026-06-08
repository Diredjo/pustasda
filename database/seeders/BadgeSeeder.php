<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            ['name' => 'Juara Perdana', 'description' => 'Pertama kali meraih juara', 'icon' => 'fa-star', 'color' => '#f5a623', 'condition_type' => 'first_win', 'condition_value' => 1],
            ['name' => 'Aktif Berlomba', 'description' => 'Mengikuti 5 lomba', 'icon' => 'fa-running', 'color' => '#e31e25', 'condition_type' => 'total_participations', 'condition_value' => 5],
            ['name' => 'Rajin Daftar', 'description' => 'Mengikuti 10 lomba', 'icon' => 'fa-medal', 'color' => '#e31e25', 'condition_type' => 'total_participations', 'condition_value' => 10],
            ['name' => 'Tim Solid', 'description' => 'Menang lomba tim pertama kali', 'icon' => 'fa-users', 'color' => '#6c757d', 'condition_type' => 'team_win', 'condition_value' => 1],
            ['name' => 'Nasionalis', 'description' => 'Ikut lomba nasional', 'icon' => 'fa-flag', 'color' => '#e31e25', 'condition_type' => 'national_competition', 'condition_value' => 1],
            ['name' => 'Konsisten', 'description' => 'Submit tepat waktu 3 lomba berturut', 'icon' => 'fa-check-circle', 'color' => '#28a745', 'condition_type' => 'on_time_submit', 'condition_value' => 3],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}