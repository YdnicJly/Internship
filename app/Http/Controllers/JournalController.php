<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FinalReport;
use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())->latest('date')->get();
        $finalReport = FinalReport::where('user_id', Auth::id())->get();
        return view('student.journal', compact('journals','finalReport'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'activity' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Journal::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'activity' => $request->activity,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Journal entry added successfully.');
    }

    public function destroy($id)
    {
        $journal = Journal::where('user_id', Auth::id())->findOrFail($id);
        $journal->delete();

        return redirect()->back()->with('success', 'Journal entry deleted.');
    }
}
