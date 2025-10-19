<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Selection;

class SelectionsSeeder extends Seeder
{
    public function run(): void
    {
        $applications = Application::all();

        foreach ($applications as $app) {
            // Hanya buat seleksi untuk aplikasi yang status-nya bukan "submitted"
            if ($app->status !== 'submitted') {
                $score = rand(60, 100);
                $result = $score >= 75 ? 'passed' : 'failed';

                Selection::create([
                    'application_id' => $app->id,
                    'score' => $score,
                    'remarks' => $result === 'passed'
                        ? 'Lolos tahap seleksi administrasi.'
                        : 'Belum memenuhi standar seleksi administrasi.',
                    'result' => $result,
                ]);
            }
        }
    }
}
