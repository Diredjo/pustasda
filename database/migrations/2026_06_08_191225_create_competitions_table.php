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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('field_id')->constrained()->onDelete('restrict');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->string('title');
            $table->string('organizer', 200);
            $table->enum('level', ['sekolah', 'kota', 'provinsi', 'nasional', 'internasional']);
            $table->enum('type', ['solo', 'team'])->default('solo');
            $table->integer('max_members')->default(1);
            $table->integer('min_members')->default(1);
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->string('link_registration')->nullable();
            $table->string('poster')->nullable();
            $table->string('cover')->nullable();
            $table->date('register_deadline')->nullable();
            $table->date('deadline');
            $table->date('announcement_date')->nullable();
            $table->integer('total_stages')->default(1);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_trending')->default(false);
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
