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

        return redirect()->back()->with('success', 'Intern data updated successfully!');
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

    return redirect()->back()->with('success', 'Intern has been deleted successfully.');
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

    $intern->evaluations()->create($validated);

    return redirect()->back()->with('success', 'Evaluasi berhasil ditambahkan.');
}

public function storeCertificate(Request $request, $id)
{
    $validated = $request->validate([
        'certificate_file' => 'required|mimes:pdf|max:2048',
    ]);

    $intern = User::findOrFail($id);

    if ($request->hasFile('certificate_file')) {
        $path = $request->file('certificate_file')->store('certificates', 'public');

        $intern->certificate()->create([
            'file_path' => $path,
            'issued_date' => now(),
        ]);
    }

    return redirect()->back()->with('success', 'Sertifikat berhasil diupload.');
}

}
