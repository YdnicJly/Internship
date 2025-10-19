<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\User;
use App\Models\Position;

class ApplicationsSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $positions = Position::all();

        $statuses = ['submitted', 'under_review', 'interview', 'accepted', 'rejected', 'completed'];

        foreach ($students as $student) {
            $applyCount = rand(1, 3);
            $appliedPositions = $positions->random($applyCount);

            foreach ($appliedPositions as $position) {
                $status = collect($statuses)->random();

                Application::create([
                    'user_id' => $student->id,
                    'position_id' => $position->id,
                    'status' => $status,
                    'motivation' => 'Saya sangat tertarik dengan posisi ini dan ingin belajar lebih banyak.',
                    'duration' => rand(1, 6) . ' bulan',
                    'whatsapp_number' => '08' . rand(1000000000, 9999999999),
                    'active_email' => $student->email,
                ]);
            }
        }
    }
}
