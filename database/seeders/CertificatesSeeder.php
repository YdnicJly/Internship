<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Certificate;
use Carbon\Carbon;

class CertificatesSeeder extends Seeder
{
    public function run(): void
    {
        $completedApplications = Application::where('status', 'completed')->get();

        foreach ($completedApplications as $app) {
            Certificate::create([
                'user_id' => $app->user_id,
                'file_path' => "uploads/certificates/{$app->user_id}/sertifikat_magang.pdf",
                'issued_date' => Carbon::now()->subDays(rand(1, 15)),
            ]);
        }
    }
}
