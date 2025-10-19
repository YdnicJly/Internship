<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            PositionsSeeder::class,
            ApplicationsSeeder::class,
            DocumentsSeeder::class,
            SelectionsSeeder::class,
            InterviewsSeeder::class,
            JournalsSeeder::class,
            FinalReportsSeeder::class,
            EvaluationsSeeder::class,
            CertificatesSeeder::class,
            NotificationsSeeder::class,
        ]);
    }
}
