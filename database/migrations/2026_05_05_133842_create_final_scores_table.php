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
        Schema::create('final_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_id')->constrained('theses')->cascadeOnDelete();
            $table->decimal('final_score', 5, 2);
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_scores');
    }
};
