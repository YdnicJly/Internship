<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Document;

class DocumentsSeeder extends Seeder
{
    public function run(): void
    {
        $applications = Application::all();

        foreach ($applications as $application) {
            $documentTypes = ['CV', 'Surat Pengantar', 'Transkrip Nilai'];
            $docCount = rand(2, 3);

            foreach (array_slice($documentTypes, 0, $docCount) as $type) {
                Document::create([
                    'application_id' => $application->id,
                    'type' => $type,
                    'path' => "uploads/documents/{$application->user_id}/" . strtolower(str_replace(' ', '_', $type)) . ".pdf",
                ]);
            }
        }
    }
}
