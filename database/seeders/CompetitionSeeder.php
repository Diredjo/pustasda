<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;
use App\Models\CompetitionStage;
use Faker\Factory as Faker;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $categories = [1, 2, 3, 4];
        $fields = [1, 2, 3, 4, 5, 6, 7];
        $levels = ['nasional', 'provinsi', 'kota', 'sekolah'];
        $organizers = ['Kemendikbud', 'Dinas Pendidikan', 'Telkom Indonesia', 'Google Indonesia', 'Universitas Indonesia', 'BUMN', 'Startup Tech'];

        for ($i = 1; $i <= 20; $i++) {
            $type = $faker->randomElement(['solo', 'team']);

            $competition = Competition::create([
                'category_id' => $faker->randomElement($categories),
                'field_id' => $faker->randomElement($fields),
                'created_by' => 2,
                // Menggunakan kombinasi jobTitle dan bs yang pasti ada di semua versi Faker
                'title' => $faker->jobTitle . ' ' . $faker->randomElement(['Challenge', 'Hackathon', 'Competition']),
                'organizer' => $faker->randomElement($organizers),
                'cover' => "https://picsum.photos/seed/" . rand(1, 1000) . "/800/400",
                'level' => $faker->randomElement($levels),
                'type' => $type,
                'max_members' => ($type == 'team') ? $faker->numberBetween(2, 5) : 1,
                'min_members' => ($type == 'team') ? 2 : 1,
                'description' => $faker->sentence(10),
                'requirements' => 'Siswa aktif, memiliki kartu pelajar, karya orisinal.',
                'link_registration' => 'https://example.com',
                'deadline' => now()->addDays(rand(10, 90)),
                'register_deadline' => now()->addDays(rand(5, 15)),
                'announcement_date' => now()->addDays(rand(95, 120)),
                'total_stages' => ($type == 'team') ? 3 : 1,
                'is_trending' => $faker->boolean(40),
            ]);

            if ($type == 'team') {
                CompetitionStage::insert([
                    ['competition_id' => $competition->id, 'stage_number' => 1, 'stage_name' => 'Seleksi Administrasi', 'deadline' => now()->addDays(20)->toDateString(), 'description' => 'Verifikasi berkas'],
                    ['competition_id' => $competition->id, 'stage_number' => 2, 'stage_name' => 'Babak Kualifikasi', 'deadline' => now()->addDays(40)->toDateString(), 'description' => 'Tes tertulis/proyek awal'],
                    ['competition_id' => $competition->id, 'stage_number' => 3, 'stage_name' => 'Final', 'deadline' => now()->addDays(60)->toDateString(), 'description' => 'Presentasi akhir'],
                ]);
            }
        }
    }
}