<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;
use App\Models\CompetitionStage;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        // Lomba Solo Nasional
        $c1 = Competition::create([
            'category_id' => 1,
            'field_id' => 1,
            'created_by' => 2,
            'title' => 'Lomba Web Design Nasional 2025',
            'organizer' => 'Kemendikbud RI',
            'level' => 'nasional',
            'type' => 'solo',
            'max_members' => 1,
            'min_members' => 1,
            'description' => 'Kompetisi desain website tingkat nasional untuk siswa SMK seluruh Indonesia.',
            'requirements' => 'Siswa aktif SMK, membawa laptop sendiri, karya orisinal.',
            'link_registration' => 'https://lomba.kemdikbud.go.id',
            'deadline' => now()->addDays(30),
            'register_deadline' => now()->addDays(15),
            'announcement_date' => now()->addDays(45),
            'total_stages' => 1,
            'is_trending' => true,
        ]);

        // Lomba Tim Provinsi (Multi-stage seperti FIKSI)
        $c2 = Competition::create([
            'category_id' => 4,
            'field_id' => 2,
            'created_by' => 2,
            'title' => 'FIKSI 2025 - Festival Inovasi dan Kreativitas Siswa Indonesia',
            'organizer' => 'Dinas Pendidikan Provinsi Jawa Timur',
            'level' => 'provinsi',
            'type' => 'team',
            'max_members' => 3,
            'min_members' => 2,
            'description' => 'Festival inovasi multi-tahap untuk tim siswa SMK Jawa Timur.',
            'requirements' => 'Tim 2-3 siswa, proposal inovasi, presentasi.',
            'link_registration' => 'https://fiksi.jatim.go.id',
            'deadline' => now()->addDays(60),
            'register_deadline' => now()->addDays(20),
            'announcement_date' => now()->addDays(90),
            'total_stages' => 3,
            'is_trending' => true,
        ]);

        CompetitionStage::insert([
            ['competition_id' => $c2->id, 'stage_number' => 1, 'stage_name' => 'Seleksi Administrasi & Proposal', 'deadline' => now()->addDays(25)->toDateString(), 'description' => 'Pengumpulan proposal inovasi'],
            ['competition_id' => $c2->id, 'stage_number' => 2, 'stage_name' => 'Presentasi Regional', 'deadline' => now()->addDays(45)->toDateString(), 'description' => 'Presentasi di tingkat kota/kabupaten'],
            ['competition_id' => $c2->id, 'stage_number' => 3, 'stage_name' => 'Final Provinsi', 'deadline' => now()->addDays(60)->toDateString(), 'description' => 'Grand final tingkat provinsi'],
        ]);

        // Lomba Kota
        Competition::create([
            'category_id' => 3,
            'field_id' => 7,
            'created_by' => 3,
            'title' => 'Kompetisi Video Kreatif Sidoarjo Cup 2025',
            'organizer' => 'Dinas Pendidikan Kota Sidoarjo',
            'level' => 'kota',
            'type' => 'solo',
            'max_members' => 1,
            'min_members' => 1,
            'description' => 'Lomba pembuatan video kreatif untuk siswa SMA/SMK se-Sidoarjo.',
            'requirements' => 'Durasi video 3-10 menit, tema bebas positif, format MP4.',
            'link_registration' => 'https://disdik.sidoarjokab.go.id',
            'deadline' => now()->addDays(14),
            'register_deadline' => now()->addDays(7),
            'announcement_date' => now()->addDays(21),
            'total_stages' => 1,
        ]);
    }
}