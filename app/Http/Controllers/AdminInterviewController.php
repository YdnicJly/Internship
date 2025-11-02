<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminInterviewController extends Controller
{
    /**
     * Tampilkan semua jadwal interview.
     */
    public function index()
    {
        $interviews = Interview::with(['application.user', 'application.position'])
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return view('admin.interviews', compact('interviews'));
    }

    /**
     * Simpan jadwal interview baru (opsional kalau kamu ingin tombol Add nanti).
     */
    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'scheduled_at'   => 'required|date',
            'status'         => 'required|string',
            'result'         => 'nullable|string|max:255',
        ]);

        Interview::create($request->only('application_id', 'scheduled_at', 'status', 'result'));

        return redirect()->route('admin.interviews')
            ->with('success', 'Data Interview Berhasil dibuat.');
    }

    /**
     * Update interview (dipakai di modal edit).
     */
    public function update(Request $request, $id)
    {
        $interview = Interview::findOrFail($id);

        $request->validate([
            'scheduled_at' => 'required|date',
            'status'       => 'required|string',
            'result'       => 'nullable|string|max:255',
        ]);

        $interview->update([
            'scheduled_at' => $request->scheduled_at,
            'status'       => $request->status,
            'result'       => $request->result,
        ]);

        return redirect()->route('admin.interviews')
            ->with('success', 'Data Interview Berhasil diperbarui.');
    }

    /**
     * Hapus jadwal interview.
     */
    public function destroy($id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete();

        return redirect()->route('admin.interviews')
            ->with('success', 'Data Interview Berhasil dihapus.');
    }
}
