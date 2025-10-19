<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Nilai per kriteria (0–100)
            $table->integer('discipline')->nullable()->comment('Kedisiplinan');
            $table->integer('teamwork')->nullable()->comment('Kerja sama tim');
            $table->integer('communication')->nullable()->comment('Kemampuan komunikasi');
            $table->integer('skill')->nullable()->comment('Kompetensi keahlian');
            $table->integer('responsibility')->nullable()->comment('Tanggung jawab');

            // Catatan evaluator
            $table->text('notes')->nullable()->comment('Catatan tambahan dari pembimbing');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('evaluations');
    }
};

