<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApplicationsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('applications')->insert([
            [
                'user_id' => 2,
                'position_id' => 1,
                'motivation' => 'Saya tertarik untuk berkontribusi dalam pengembangan sistem informasi Diskominfo.',
                'duration' => '8',
                'whatsapp_number' => '0812345678',
                'active_email' => 'student@diskominfo.test',
                'status' => 'under_review',
                'created_at' => Carbon::parse('2025-10-12 03:37:25'),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'position_id' => 3,
                'motivation' => 'Meningkatkan kemampuan desain UI/UX profesional.',
                'duration' => '12',
                'whatsapp_number' => '0812345678',
                'active_email' => 'student@diskominfo.test',
                'status' => 'rejected',
                'created_at' => Carbon::parse('2025-10-08 03:37:25'),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
