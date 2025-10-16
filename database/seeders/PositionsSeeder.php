<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PositionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'title' => 'Frontend Developer',
                'department' => 'Web Development',
                'description' => 'Responsible for implementing user interface designs using HTML, CSS, and JavaScript frameworks.',
                'requirements' => 'Knowledge of HTML, CSS, JavaScript, and Bootstrap. Familiarity with Laravel is a plus.',
                'quota' => 3,
                'status' => 'open',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Data Analyst Intern',
                'department' => 'Data Center',
                'description' => 'Assist in cleaning, processing, and visualizing data for Diskominfo reports.',
                'requirements' => 'Proficiency in Excel or Google Sheets. Knowledge of SQL or Python preferred.',
                'quota' => 2,
                'status' => 'open',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'UI/UX Designer',
                'department' => 'Creative Department',
                'description' => 'Design and improve web & mobile interfaces to enhance user experience.',
                'requirements' => 'Experience with Figma, Adobe XD, or similar tools.',
                'quota' => 2,
                'status' => 'open',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Network Engineer Intern',
                'department' => 'Infrastructure Division',
                'description' => 'Support network monitoring and maintenance tasks.',
                'requirements' => 'Understanding of network fundamentals (LAN, WAN, IP, DNS).',
                'quota' => 1,
                'status' => 'open',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
