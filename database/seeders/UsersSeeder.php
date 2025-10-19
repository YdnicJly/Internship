<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator Sistem',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Diskominfo Kabupaten Contoh',
            'profile_photo' => null,
        ]);

        // Belasan siswa (SMK & Universitas)
        $schoolNames = ['SMK Negeri 1 Bandung', 'SMK Telkom Malang', 'Universitas Brawijaya', 'Universitas Diponegoro', 'SMK Negeri 2 Jakarta'];
        $majors = ['Teknik Informatika', 'Sistem Informasi', 'Desain Grafis', 'Manajemen', 'Akuntansi'];

        for ($i = 1; $i <= 18; $i++) {
            $isUniv = rand(0, 1);
            User::create([
                'name' => fake('id_ID')->name(),
                'email' => 'student' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'school_name' => $schoolNames[array_rand($schoolNames)],
                'major' => $majors[array_rand($majors)],
                'education_level' => $isUniv ? 'Universitas' : 'SMK',
                'phone' => '08' . rand(1000000000, 9999999999),
                'address' => fake('id_ID')->address(),
                'profile_photo' => null,
            ]);
        }
    }
}
