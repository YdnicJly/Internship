<?php

namespace App\Http\Controllers;

use App\Models\FinalReport;
use App\Models\Evaluation;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EvaluationController extends Controller
{
    /**
     * Menampilkan halaman evaluasi dan laporan akhir mahasiswa.
     */
    public function index()
    {
        $userId = Auth::id();

        $finalReport = FinalReport::where('user_id', $userId)->first();
        $evaluation = Evaluation::where('user_id', $userId)->first();
        $certificate = Certificate::where('user_id', $userId)->first();

        return view('student.evaluation', compact('finalReport', 'evaluation', 'certificate'));
    }

    /**
     * Menyimpan laporan akhir baru (jika belum ada).
     */
    public function storeFinalReport(Request $request)
    {
        try {
            // 🔹 Validasi input
            $request->validate([
                'file' => 'required|mimes:pdf,doc,docx|max:5120',
            ], [
                'file.required' => 'File laporan wajib diunggah.',
                'file.mimes' => 'Format file harus berupa PDF, DOC, atau DOCX.',
                'file.max' => 'Ukuran file maksimal 5MB.',
            ]);

            // 🔹 Tentukan lokasi penyimpanan di public_html/final_reports
            $destinationPath = base_path('../public_html/final_reports');

            // Buat folder jika belum ada
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // 🔹 Ambil file dan beri nama unik
            $file = $request->file('file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Pindahkan file ke public_html/final_reports
            $file->move($destinationPath, $filename);

            // Simpan path relatif (agar bisa dipanggil dengan asset())
            $relativePath = 'final_reports/' . $filename;

            // 🔹 Simpan atau update data ke tabel final_reports
            \App\Models\FinalReport::updateOrCreate(
                ['user_id' => Auth::id()],
                ['file_path' => $relativePath]
            );

            return redirect()
                ->route('student.evaluation')
                ->with('success', 'Laporan akhir berhasil diunggah!');
        } catch (\Exception $e) {
            // Kamu bisa aktifkan log jika mau lihat detail error
            // \Log::error('Final report upload failed: ' . $e->getMessage());

            return redirect()
                ->route('student.evaluation')
                ->with('error', 'Terjadi kesalahan saat mengunggah laporan. Silakan coba lagi.');
        }
    }

    public function updateFinalReport(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:5120',
        ], [
            'file.required' => 'File laporan wajib diunggah.',
            'file.mimes' => 'Format file harus berupa PDF, DOC, atau DOCX.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ]);

        try {
            $report = \App\Models\FinalReport::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // ✅ Simpan ke public_html
            $destinationPath = base_path('../public_html/final_reports');

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Hapus file lama
            $oldFile = base_path('../public_html/' . $report->file_path);
            if ($report->file_path && file_exists($oldFile)) {
                @unlink($oldFile);
            }

            // Upload baru
            $file = $request->file('file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);

            $relativePath = 'final_reports/' . $filename;

            $report->update(['file_path' => $relativePath]);

            return redirect()
                ->route('student.evaluation')
                ->with('success', 'Laporan akhir berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('student.evaluation')
                ->with('error', 'Terjadi kesalahan saat memperbarui laporan. Silakan coba lagi.');
        }
    }
}