<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Developer
        $dev = User::create([
            'name' => 'Developer PUSTASDA',
            'email' => 'developer@pustasda.id',
            'password' => Hash::make('developer123'),
            'role' => 'developer',
            'wa_number' => '6281200000001',
        ]);

        // Admin
        $admin = User::create([
            'name' => 'Admin PUSTASDA',
            'email' => 'admin@pustasda.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'wa_number' => '6281200000002',
        ]);

        // Guru 1
        $guru1 = User::create([
            'name' => 'Bpk. Andi Firmansyah, S.Kom',
            'email' => 'andi.guru@pustasda.id',
            'password' => Hash::make('guru123'),
            'role' => 'teacher',
            'wa_number' => '6281200000003',
        ]);
        TeacherProfile::create([
            'user_id' => $guru1->id,
            'nip' => '198501012010011001',
            'bidang_keahlian' => 'Rekayasa Perangkat Lunak',
            'jabatan' => 'Guru Produktif RPL',
        ]);

        // Guru 2
        $guru2 = User::create([
            'name' => 'Ibu Sari Dewi, S.T',
            'email' => 'sari.guru@pustasda.id',
            'password' => Hash::make('guru123'),
            'role' => 'teacher',
            'wa_number' => '6281200000004',
        ]);
        TeacherProfile::create([
            'user_id' => $guru2->id,
            'nip' => '199001012015012001',
            'bidang_keahlian' => 'Teknik Komputer Jaringan',
            'jabatan' => 'Guru Produktif TKJ',
        ]);

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