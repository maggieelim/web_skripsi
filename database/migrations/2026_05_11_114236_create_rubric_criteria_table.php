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
        Schema::create('rubric_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rubric_id')->constrained('rubrics')->onDelete('cascade');
            $table->unsignedTinyInteger('score_level'); // 0, 1, 2, 3
            $table->text('description'); // Deskripsi kriteria untuk level skor tertentu
            $table->timestamps();

            // Unique constraint: satu rubrik tidak boleh punya dua level skor yang sama
            $table->unique(['rubric_id', 'score_level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubric_criterias');
    }
};
