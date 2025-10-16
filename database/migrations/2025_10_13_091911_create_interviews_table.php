<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->dateTime('scheduled_at')->nullable();
            $table->enum('status', ['scheduled', 'done', 'canceled'])->default('scheduled');
            $table->text('result')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('interviews');
    }
};
