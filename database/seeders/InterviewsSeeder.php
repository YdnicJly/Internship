<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Interview;
use Carbon\Carbon;

class InterviewsSeeder extends Seeder
{
    public function run(): void
    {
        $applications = Application::whereIn('status', ['interview', 'accepted'])->get();

        foreach ($applications as $app) {
            $status = rand(0, 1) ? 'scheduled' : 'done';
            $scheduledAt = $status === 'scheduled'
                ? Carbon::now()->addDays(rand(1, 5))->setTime(rand(8, 15), [0, 30][rand(0, 1)])
                : Carbon::now()->subDays(rand(2, 15))->setTime(rand(8, 15), [0, 30][rand(0, 1)]);

            Interview::create([
                'application_id' => $app->id,
                'scheduled_at' => $scheduledAt,
                'status' => $status,
                'result' => $status === 'done'
                    ? (rand(0, 1)
                        ? 'Wawancara berjalan lancar, kandidat menunjukkan motivasi yang baik.'
                        : 'Kandidat masih perlu meningkatkan kemampuan komunikasi.')
                    : null,
            ]);
        }
    }
}
