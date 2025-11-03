<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Position;
use App\Models\Application;
use App\Models\Document;
use App\Models\Journal;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ActiveInternStudentSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Buat 1 student
        $student = User::create([
            'name' => 'Rafi Aditya',
            'email' => 'rafi.aditya@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'school_name' => 'SMK Negeri 5 Bandung',
            'major' => 'Teknik Komputer dan Jaringan',
            'education_level' => 'SMK',
            'phone' => '081234567890',
            'address' => 'Jl. Sukamaju No. 23, Bandung',
            'profile_photo' => 'uploads/profiles/rafi.jpg',
        ]);

        // 2️⃣ Buat 1 posisi magang (kalau belum ada)
        $position = Position::first() ?? Position::create([
            'title' => 'Staf IT Support',
            'department' => 'Teknologi Informasi',
            'description' => 'Membantu tim dalam pemeliharaan sistem dan jaringan internal.',
            'requirements' => 'Menguasai dasar jaringan komputer, mampu bekerja tim.',
            'quota' => 2,
            'deadline' => Carbon::now()->addDays(30),
            'status' => 'open',
        ]);

        // 3️⃣ Buat 1 aplikasi dengan status “active”
        $application = Application::create([
            'user_id' => $student->id,
            'position_id' => $position->id,
            'motivation' => 'Saya ingin menambah pengalaman di bidang IT support dan belajar lingkungan kerja nyata.',
            'duration' => '3 bulan',
            'whatsapp_number' => $student->phone,
            'active_email' => $student->email,
            'status' => 'active',
        ]);

        // 4️⃣ Dokumen pelengkap
        $docs = ['CV', 'Surat Pengantar', 'Transkrip Nilai'];
        foreach ($docs as $type) {
            Document::create([
                'application_id' => $application->id,
                'type' => $type,
                'path' => "uploads/documents/{$student->id}/" . strtolower(str_replace(' ', '_', $type)) . ".pdf",
            ]);
        }

        // 5️⃣ Jurnal magang (aktivitas 7 hari terakhir)
        $activities = [
            'Membuat laporan harian kegiatan jaringan',
            'Membantu tim memperbaiki koneksi internet kantor',
            'Melakukan instalasi ulang sistem operasi',
            'Mendokumentasikan peralatan IT yang digunakan',
            'Mengikuti rapat koordinasi tim IT',
            'Membuat panduan troubleshooting dasar',
            'Membantu backup data ke server lokal',
        ];

        $start = Carbon::now()->subDays(7);
        for ($i = 0; $i < 7; $i++) {
            Journal::create([
                'user_id' => $student->id,
                'date' => $start->copy()->addDays($i),
                'activity' => $activities[$i],
                'description' => 'Kegiatan berjalan lancar dan menambah pengalaman praktis.',
            ]);
        }

        // 6️⃣ Notifikasi aktif
        $messages = [
            'Selamat! Anda resmi memulai program magang.',
            'Jangan lupa isi jurnal harian Anda setiap hari.',
            'Periksa dashboard untuk update kegiatan magang.',
        ];

        foreach ($messages as $msg) {
            Notification::create([
                'user_id' => $student->id,
                'message' => $msg,
                'read' => false,
            ]);
        }

        $this->command->info('✅ Data student aktif magang berhasil dibuat: rafi.aditya@example.com / password');
    }
}
