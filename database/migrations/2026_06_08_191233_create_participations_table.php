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
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('competition_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['registered', 'in_progress', 'submitted', 'not_submitted', 'completed'])->default('registered');
            $table->enum('result', ['juara_1', 'juara_2', 'juara_3', 'juara_harapan', 'favorit', 'terpilih', 'lolos_tahap', 'tidak_lolos', 'belum_diisi'])->default('belum_diisi');
            $table->integer('current_stage')->default(1);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};
