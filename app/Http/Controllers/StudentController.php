<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Application;
use App\Models\Interview;

class StudentController extends Controller
{    
    public function index()
{
    $positions = Position::latest()->get();
    return view('student.dashboard', compact('positions'));
}

public function applications()
{
    $applications = Application::with('position')->where('user_id', auth()->id())->get();
    $interviews = Interview::whereHas('application', function($q) {
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

    return back()->with('success', 'Final report uploaded successfully.');
}

}
