<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudentProfile;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Siswa 1
        $siswa1 = User::create([
            'name' => 'Rafi Akbar Pratama',
            'email' => 'rafi@student.pustasda.id',
            'password' => Hash::make('siswa123'),
            'role' => 'student',
            'wa_number' => '6281200000005',
        ]);
        StudentProfile::create([
            'user_id' => $siswa1->id,
            'nis' => '2223001',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'angkatan' => 2022,
        ]);

        // Siswa 2
        $siswa2 = User::create([
            'name' => 'Aulia Fitri Ramadhani',
            'email' => 'aulia@student.pustasda.id',
            'password' => Hash::make('siswa123'),
            'role' => 'student',
            'wa_number' => '6281200000006',
        ]);
        StudentProfile::create([
            'user_id' => $siswa2->id,
            'nis' => '2223002',
            'kelas' => 'XI',
            'jurusan' => 'TKJ',
            'angkatan' => 2023,
        ]);

        // Siswa 3
        $siswa3 = User::create([
            'name' => 'Dimas Surya Wijaya',
            'email' => 'dimas@student.pustasda.id',
            'password' => Hash::make('siswa123'),
            'role' => 'student',
            'wa_number' => '6281200000007',
        ]);
        StudentProfile::create([
            'user_id' => $siswa3->id,
            'nis' => '2223003',
            'kelas' => 'X',
            'jurusan' => 'RPL',
            'angkatan' => 2024,
        ]);
    }
}