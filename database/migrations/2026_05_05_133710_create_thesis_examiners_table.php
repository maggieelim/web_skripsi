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
        Schema::create('thesis_examiners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_id')->constrained('theses')->cascadeOnDelete();
            $table->foreignId('lecturer_id')->constrained()->cascadeOnDelete();
            $table->enum('role', ['penguji 1', 'penguji 2', 'ketua sidang']);
            $table->timestamps();

            $table->unique(['thesis_id', 'lecturer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_examiners');
    }
};
