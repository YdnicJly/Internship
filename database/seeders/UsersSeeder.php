<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Diskominfo',
                'email' => 'admin@diskominfo.test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'school_name' => null,
                'major' => null,
                'education_level' => null,
                'phone' => null,
                'address' => null,
                'profile_photo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Student Tester',
                'email' => 'student@diskominfo.test',
                'password' => Hash::make('student123'),
                'role' => 'student',
                'school_name' => 'Universitas Negeri Diskominfo',
                'major' => 'Teknik Informatika',
                'education_level' => 'Universitas',
                'phone' => '081234567890',
                'address' => 'Jl. Pemuda No. 12, Kota Diskominfo',
                'profile_photo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
