<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearCompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Matikan proteksi foreign key constraint sementara agar MySQL tidak protes
        Schema::disableForeignKeyConstraints();

        // 2. Bersihkan tabel-tabel anak yang menempel pada data lomba
        // Catatan: Sesuaikan nama tabel di bawah ini dengan nama tabel asli di databasemu!
        DB::table('competition_saves')->truncate();    // Menghapus semua bookmark/simpanan lomba siswa
        DB::table('competition_stages')->truncate();   // Menghapus semua tahapan/stages lomba bawaan seeder

        // Jika kamu punya tabel pendaftaran seperti student_competitions atau sejenisnya, buka komentar baris di bawah:
        // DB::table('student_competitions')->truncate(); 

        // 3. Bersihkan tabel utama lomba
        DB::table('competitions')->truncate();

        // 4. Nyalakan kembali proteksi foreign key constraint
        Schema::enableForeignKeyConstraints();

        $this->command->info('Mantap! Semua data lomba bawaan seeder berhasil dibersihkan tanpa menghapus data user/kategori.');
    }
}