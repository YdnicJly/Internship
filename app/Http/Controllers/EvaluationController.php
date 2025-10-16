<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FinalReport;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
public function index()
{
    $userId = Auth::id();

    $finalReport = FinalReport::where('user_id', $userId)->first();
    $evaluation  = Evaluation::where('user_id', $userId)->first();
    $certificate = Certificate::where('user_id', $userId)->first();

    return view('student.evaluation', compact('finalReport', 'evaluation', 'certificate'));
}
public function storeFinalReport(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:pdf,doc,docx|max:5120'
    ]);

    $path = $request->file('file')->store('final_reports', 'public');

    FinalReport::updateOrCreate(
        ['user_id' => Auth::id()],
        ['file_path' => $path]
    );

    return redirect()->route('student.evaluation')->with('success', 'Final report uploaded successfully!');
}

}
