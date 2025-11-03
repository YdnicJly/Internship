<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Journal;

class AdminJournalController extends Controller
{
    public function show($id)
    {
        // Ambil data user (intern)
        $intern = User::with('journals')->findOrFail($id);

        // Ambil jurnal berdasarkan user_id
        $journals = Journal::where('user_id', $intern->id)
            ->orderBy('date', 'asc')
            ->get();

        return view('admin.journal', compact('intern', 'journals'));
    }
}
