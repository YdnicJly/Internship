<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'admin'])->default('student')->after('password');
            $table->string('school_name')->nullable()->after('role');
            $table->string('major')->nullable()->after('school_name');
            $table->enum('education_level', ['SMK', 'Universitas'])->nullable()->after('major');
            $table->string('phone')->nullable()->after('education_level');
            $table->text('address')->nullable()->after('phone');
            $table->string('profile_photo')->nullable()->after('address');
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'school_name', 'major', 'education_level',
                'phone', 'address', 'profile_photo'
            ]);
        });
    }
};
