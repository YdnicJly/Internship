<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use App\Models\Document;
use App\Models\Journal;
use App\Models\Position;
use App\Models\FinalReport;
use App\Models\Evaluation;
use App\Models\Certificate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminInternController extends Controller
{
    // ✅ Menampilkan semua applicant
public function index()
{
    $interns = User::whereHas('applications', function ($q) {
        $q->where('status', 'active');
    })->with('applications.position')->get();

    $completedInterns = User::whereHas('applications', function ($q) {
        $q->where('status', 'completed');
    })->with('applications.position')->get();

    $positions = Position::all();

    return view('admin.intern', compact('interns', 'completedInterns', 'positions'));
}



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'school_name' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'position_id' => 'required|exists:positions,id',
            'status' => 'required|in:active,completed,rejected,pending',
        ]);

        $intern = User::findOrFail($id);

        // Update basic user data
        $intern->update([
            'name' => $request->name,
            'school_name' => $request->school_name,
            'major' => $request->major,
            'phone' => $request->phone,
        ]);

        // Update the related application
        $application = $intern->applications()->where('status', '!=', null)->first();
        if ($application) {
            $application->update([
                'position_id' => $request->position_id,
                'status' => $request->status,
            ]);
        }

        return redirect()->back()->with('success', 'Data Pemagang Berhasil diperbarui!');
    }

    public function destroy($id)
{
    $intern = User::findOrFail($id);

    // Hapus semua relasi terkait bila diperlukan
    // (agar tidak ada foreign key constraint error)
    $intern->applications()->delete();
    $intern->journals()->delete();
    $intern->evaluations()->delete();
    $intern->certificate()?->delete();
    $intern->finalReport()?->delete();

    // Terakhir, hapus user
    $intern->delete();

    return redirect()->back()->with('success', 'Data Pemagang Berhasil dihapus.');
}
public function storeEvaluation(Request $request, $id)
{
    $validated = $request->validate([
        'discipline' => 'required|integer|min:0|max:100',
        'teamwork' => 'required|integer|min:0|max:100',
        'communication' => 'required|integer|min:0|max:100',
        'skill' => 'required|integer|min:0|max:100',
        'responsibility' => 'required|integer|min:0|max:100',
        'notes' => 'nullable|string',
    ]);

    $intern = User::findOrFail($id);

    // 🔄 Jika sudah ada evaluasi → update, kalau belum → buat baru
    $intern->evaluations()->updateOrCreate(
        ['user_id' => $intern->id],
        $validated
    );

    return redirect()->back()->with('success', 'Evaluasi berhasil disimpan.');
}

public function storeCertificate(Request $request, $id)
{
    $validated = $request->validate([
        'certificate_file' => 'required|mimes:pdf|max:2048',
    ], [
        'certificate_file.required' => 'File sertifikat wajib diunggah.',
        'certificate_file.mimes' => 'Format file harus PDF.',
        'certificate_file.max' => 'Ukuran file maksimal 2MB.',
    ]);

    $intern = User::findOrFail($id);

    $destinationPath = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/certificates';

    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    // 🔹 Hapus sertifikat lama kalau sudah ada
    if ($intern->certificate && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $intern->certificate->file_path)) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $intern->certificate->file_path);
    }

    // 🔹 Simpan file baru
    $file = $request->file('certificate_file');
    $filename = 'certificate_' . str_replace(' ', '_', strtolower($intern->name)) . '_' . time() . '.pdf';
    $file->move($destinationPath, $filename);

    $relativePath = 'certificates/' . $filename;

    // 🔄 Update atau buat baru
    $intern->certificate()->updateOrCreate(
        ['user_id' => $intern->id],
        [
            'file_path' => $relativePath,
            'issued_date' => now(),
        ]
    );

    return redirect()->back()->with('success', 'Sertifikat berhasil diupload.');
}

}
