<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Journal;
use Carbon\Carbon;

class JournalsSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user yang aplikasinya aktif atau sudah selesai
        $activeApplications = Application::whereIn('status', ['active', 'completed'])->get();

        $activities = [
            'Membuat laporan harian',
            'Menginput data sistem',
            'Membantu tim desain membuat poster kegiatan',
            'Mengikuti rapat koordinasi divisi',
            'Melakukan riset sederhana untuk proyek',
            'Mempelajari alur kerja aplikasi internal',
            'Membuat dokumentasi kegiatan harian',
            'Melaksanakan tugas yang diberikan mentor',
        ];

        foreach ($activeApplications as $app) {
            $startDate = Carbon::now()->subDays(rand(10, 30));
            $journalCount = rand(5, 10);

            for ($i = 0; $i < $journalCount; $i++) {
                Journal::create([
                    'user_id' => $app->user_id,
                    'date' => $startDate->copy()->addDays($i),
                    'activity' => $activities[array_rand($activities)],
                    'description' => 'Kegiatan berjalan dengan baik dan memberikan pengalaman baru.',
                ]);
            }
        }
    }
}
