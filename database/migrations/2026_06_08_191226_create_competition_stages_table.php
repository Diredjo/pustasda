<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('competition_stages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('competition_id')->constrained()->onDelete('cascade');
        $table->integer('stage_number');
        $table->string('stage_name', 200);
        $table->date('deadline')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_stages');
    }
};
