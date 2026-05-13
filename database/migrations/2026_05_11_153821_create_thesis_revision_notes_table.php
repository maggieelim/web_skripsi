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
        Schema::create('thesis_revision_notes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('thesis_id')->constrained()->cascadeOnDelete();

            $table->foreignId('lecturer_id')->constrained()->cascadeOnDelete();

            $table->text('substance_note')->nullable();

            $table->text('methodology_note')->nullable();

            $table->text('writing_note')->nullable();

            $table->boolean('is_submitted')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_revision_notes');
    }
};
