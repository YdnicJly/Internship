<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FinalReport;
use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    /**
     * Menampilkan halaman jurnal mahasiswa.
     */
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())
            ->latest('date')
            ->get();

        $finalReport = FinalReport::where('user_id', Auth::id())->get();

        return view('student.journal', compact('journals', 'finalReport'));
    }

    /**
     * Menyimpan entri jurnal baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'activity' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'date.required' => 'Tanggal wajib diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'activity.required' => 'Kegiatan wajib diisi.',
            'activity.max' => 'Kegiatan tidak boleh lebih dari 255 karakter.',
            'description.required' => 'Deskripsi wajib diisi.',
        ]);

        Journal::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'activity' => $request->activity,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Entri jurnal berhasil ditambahkan.');
    }

    /**
     * Menghapus entri jurnal milik pengguna.
     */
    public function destroy($id)
    {
        $journal = Journal::where('user_id', Auth::id())->findOrFail($id);
        $journal->delete();

        return redirect()->back()->with('success', 'Entri jurnal berhasil dihapus.');
    }
}
