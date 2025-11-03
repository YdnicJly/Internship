<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Evaluation;

class EvaluationsSeeder extends Seeder
{
    public function run(): void
    {
        $evaluatedApplications = Application::whereIn('status', ['active', 'completed'])->get();

        foreach ($evaluatedApplications as $app) {
            Evaluation::create([
                'user_id' => $app->user_id,
                'discipline' => rand(75, 100),
                'teamwork' => rand(70, 100),
                'communication' => rand(70, 100),
                'skill' => rand(70, 100),
                'responsibility' => rand(75, 100),
                'notes' => collect([
                    'Peserta menunjukkan tanggung jawab dan disiplin tinggi.',
                    'Mampu bekerja sama dengan baik dalam tim.',
                    'Perlu meningkatkan kemampuan komunikasi profesional.',
                    'Memiliki potensi besar dalam bidang yang digeluti.',
                    'Kinerja sangat memuaskan selama masa magang.',
                ])->random(),
            ]);
        }
    }
}
