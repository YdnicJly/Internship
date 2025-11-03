<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\FinalReport;

class FinalReportsSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user yang sudah menyelesaikan magang
        $completedApplications = Application::where('status', 'completed')->get();

        foreach ($completedApplications as $app) {
            FinalReport::create([
                'user_id' => $app->user_id,
                'file_path' => "uploads/final_reports/{$app->user_id}/laporan_akhir.pdf",
            ]);
        }
    }
}
