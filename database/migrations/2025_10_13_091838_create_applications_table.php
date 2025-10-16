<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->text('motivation')->nullable();
            $table->string('duration')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('active_email')->nullable();
            $table->enum('status', [
                'submitted', 'under_review', 'pretest', 'interview',
                'accepted', 'rejected', 'active', 'completed'
            ])->default('submitted');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('applications');
    }
};
