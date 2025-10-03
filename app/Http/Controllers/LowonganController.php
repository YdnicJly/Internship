<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        // Contoh data dummy (nanti bisa diganti ambil dari DB)
        $lowongan = [
            [
                'judul' => 'Web Developer Intern',
                'perusahaan' => 'PT Teknologi Nusantara',
                'lokasi' => 'Jakarta',
                'deskripsi' => 'Membantu pengembangan aplikasi berbasis web menggunakan Laravel & React.',
                'deadline' => '2025-10-30',
            ],
            [
                'judul' => 'UI/UX Designer Intern',
                'perusahaan' => 'CV Kreatif Design',
                'lokasi' => 'Bandung',
                'deskripsi' => 'Membuat wireframe dan prototipe untuk aplikasi mobile.',
                'deadline' => '2025-11-15',
            ],
            [
                'judul' => 'Data Analyst Intern',
                'perusahaan' => 'PT Data Indonesia',
                'lokasi' => 'Surabaya',
                'deskripsi' => 'Mengolah dan menganalisis data menggunakan Python dan SQL.',
                'deadline' => '2025-12-01',
            ],
        ];

        return view('welcome.blade.php', compact('lowongan'));
    }
}
