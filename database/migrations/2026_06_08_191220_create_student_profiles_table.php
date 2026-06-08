<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nis', 20)->nullable();
            $table->string('kelas', 20)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->year('angkatan')->nullable();
            $table->text('bio_ai')->nullable();
            $table->json('preferences')->nullable();
            $table->enum('privacy_profile', ['public', 'private'])->default('public');
            $table->boolean('allow_team_invite')->default(true);
            $table->enum('notification_pref', ['all', 'important', 'none'])->default('all');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
