<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Application;
use App\Models\Interview;
use App\Models\FinalReport;
use Illuminate\Support\Facades\Auth; // ✅ add this line

class StudentController extends Controller
{
public function index(Request $request)
{
    // Query dasar: hanya posisi yang statusnya open
    $query = Position::where('status', 'open');

    // Filter Departemen
    if ($request->filled('department') && $request->department !== 'Semua Departemen') {
        $query->where('department', $request->department);
    }

    // Filter Posisi
    if ($request->filled('title') && $request->title !== 'Semua Posisi') {
        $query->where('title', $request->title);
    }

    // Filter berdasarkan kata kunci (judul, departemen, atau deskripsi)
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function ($q) use ($keyword) {
            $q->where('title', 'like', "%{$keyword}%")
              ->orWhere('department', 'like', "%{$keyword}%")
              ->orWhere('description', 'like', "%{$keyword}%");
        });
    }

    // Urutkan berdasarkan deadline
    $positions = $query->orderBy('deadline', 'asc')->get();

    return view('student.dashboard', [
        'positions' => $positions,
        'user' => Auth::user(),
    ]);
}


    public function applications()
    {
        $applications = Application::with(['position', 'documents'])
            ->where('user_id', auth()->id())
            ->get();

        $interviews = Interview::whereHas('application', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();

        return view('student.applications', compact('applications', 'interviews'));
    }


    public function report(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:5120',
        ]);

        $path = $request->file('file')->store('final_reports', 'public');

        FinalReport::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'file_path' => $path,
                'submitted_at' => now(),
            ]
        );

        return back()->with('success', 'Laporan Akhir Berhasil diunggah.');
    }
}
