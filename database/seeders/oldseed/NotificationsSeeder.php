<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Interview;
use App\Models\Certificate;
use App\Models\Notification;

class NotificationsSeeder extends Seeder
{
    public function run(): void
    {
        // Notifikasi untuk pelamar berdasarkan status aplikasi
        $applications = Application::all();
        foreach ($applications as $app) {
            switch ($app->status) {
                case 'submitted':
                    $message = 'Lamaran magang Anda telah diterima dan sedang diproses.';
                    break;
                case 'under_review':
                    $message = 'Lamaran magang Anda sedang dalam tahap review oleh tim HR.';
                    break;
                case 'interview':
                    $message = 'Anda dijadwalkan untuk wawancara. Silakan cek jadwal di dashboard Anda.';
                    break;
                case 'accepted':
                    $message = 'Selamat! Anda diterima untuk mengikuti program magang.';
                    break;
                case 'active':
                    $message = 'Program magang Anda sedang berlangsung. Jangan lupa isi jurnal harian.';
                    break;
                case 'completed':
                    $message = 'Selamat! Anda telah menyelesaikan program magang.';
                    break;
                default:
                    $message = 'Status lamaran Anda telah diperbarui.';
                    break;
            }

            Notification::create([
                'user_id' => $app->user_id,
                'message' => $message,
                'read' => rand(0, 1),
            ]);
        }

        // Notifikasi wawancara
        $interviews = Interview::where('status', 'scheduled')->get();
        foreach ($interviews as $interview) {
            Notification::create([
                'user_id' => $interview->application->user_id,
                'message' => 'Anda memiliki jadwal wawancara pada ' . $interview->scheduled_at->format('d M Y H:i'),
                'read' => false,
            ]);
        }

        // Notifikasi sertifikat diterbitkan
        $certificates = Certificate::all();
        foreach ($certificates as $certificate) {
            Notification::create([
                'user_id' => $certificate->user_id,
                'message' => 'Sertifikat magang Anda telah diterbitkan dan dapat diunduh melalui dashboard.',
                'read' => false,
            ]);
        }
    }
}
