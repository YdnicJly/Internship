<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionsSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            [
                'title' => 'Staf Desain Grafis',
                'department' => 'Humas & Publikasi',
                'description' => 'Membantu membuat desain grafis untuk keperluan publikasi Diskominfo.',
                'requirements' => 'Menguasai CorelDraw atau Adobe Illustrator.',
                'quota' => 2,
                'deadline' => now()->addDays(20),
                'status' => 'open',
            ],
            [
                'title' => 'Staf Web Developer',
                'department' => 'Teknologi Informasi',
                'description' => 'Bertugas mengembangkan dan memelihara website internal.',
                'requirements' => 'Menguasai HTML, CSS, dan Laravel.',
                'quota' => 3,
                'deadline' => now()->addDays(30),
                'status' => 'open',
            ],
            [
                'title' => 'Staf Administrasi',
                'department' => 'Sekretariat',
                'description' => 'Membantu kegiatan administrasi dan dokumentasi surat-menyurat.',
                'requirements' => 'Teliti, mampu mengoperasikan Microsoft Office.',
                'quota' => 2,
                'deadline' => now()->addDays(10),
                'status' => 'open',
            ],
            [
                'title' => 'Staf Jurnalistik',
                'department' => 'Humas & Publikasi',
                'description' => 'Menulis berita kegiatan Diskominfo dan membuat konten untuk media sosial.',
                'requirements' => 'Mampu menulis dan memahami dasar jurnalistik.',
                'quota' => 2,
                'deadline' => now()->addDays(25),
                'status' => 'open',
            ],
            [
                'title' => 'Staf IT Support',
                'department' => 'Teknologi Informasi',
                'description' => 'Membantu troubleshooting jaringan dan peralatan komputer.',
                'requirements' => 'Memahami dasar jaringan dan perakitan komputer.',
                'quota' => 2,
                'deadline' => now()->addDays(15),
                'status' => 'open',
            ],
            [
                'title' => 'Staf Dokumentasi Kegiatan',
                'department' => 'Humas & Publikasi',
                'description' => 'Mengambil foto dan video kegiatan Diskominfo serta mengelolanya.',
                'requirements' => 'Menguasai kamera DSLR dan software editing dasar.',
                'quota' => 2,
                'deadline' => now()->addDays(12),
                'status' => 'open',
            ],
            [
                'title' => 'Staf Data dan Statistik',
                'department' => 'Bidang Statistik',
                'description' => 'Membantu pengumpulan dan pengolahan data daerah.',
                'requirements' => 'Menguasai Excel dan analisis data dasar.',
                'quota' => 2,
                'deadline' => now()->addDays(18),
                'status' => 'open',
            ],
            [
                'title' => 'Staf Keamanan Informasi',
                'department' => 'Bidang Keamanan Data',
                'description' => 'Membantu monitoring sistem keamanan dan backup data.',
                'requirements' => 'Mengetahui dasar keamanan jaringan dan sistem.',
                'quota' => 1,
                'deadline' => now()->addDays(20),
                'status' => 'open',
            ],
            [
                'title' => 'Staf Layanan Publik',
                'department' => 'Bidang Informasi Publik',
                'description' => 'Melayani masyarakat dalam permohonan informasi publik.',
                'requirements' => 'Komunikatif dan memahami UU KIP.',
                'quota' => 1,
                'deadline' => now()->addDays(22),
                'status' => 'open',
            ],
            [
                'title' => 'Staf Sosial Media',
                'department' => 'Humas & Publikasi',
                'description' => 'Mengelola akun media sosial resmi Diskominfo.',
                'requirements' => 'Kreatif dan mampu membuat caption yang menarik.',
                'quota' => 2,
                'deadline' => now()->addDays(14),
                'status' => 'open',
            ],
        ];

        foreach ($positions as $data) {
            Position::create($data);
        }
    }
}
