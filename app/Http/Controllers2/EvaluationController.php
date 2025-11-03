<?php

namespace App\Http\Controllers;

use App\Models\FinalReport;
use App\Models\Evaluation;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Menampilkan halaman evaluasi dan laporan akhir mahasiswa.
     */
    public function index()
    {
        $userId = Auth::id();

        $finalReport = FinalReport::where('user_id', $userId)->first();
        $evaluation  = Evaluation::where('user_id', $userId)->first();
        $certificate = Certificate::where('user_id', $userId)->first();

        return view('student.evaluation', compact('finalReport', 'evaluation', 'certificate'));
    }

    /**
     * Menyimpan atau memperbarui laporan akhir mahasiswa.
     */
    public function storeFinalReport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:5120',
        ], [
            'file.required' => 'File laporan wajib diunggah.',
            'file.mimes' => 'Format file harus berupa PDF, DOC, atau DOCX.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ]);

        $path = $request->file('file')->store('final_reports', 'public');

        FinalReport::updateOrCreate(
            ['user_id' => Auth::id()],
            ['file_path' => $path]
        );

        return redirect()->route('student.evaluation')->with('success', 'Laporan akhir berhasil diunggah.');
    }
}
