<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class AdminPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::latest()->paginate(10);
        return view('admin.positions', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'quota' => 'required|integer|min:1',
            'deadline' => 'nullable|date',
            'status' => 'required|in:open,closed',
        ]);

        Position::create($validated);

        return redirect()->route('admin.positions')->with('success', 'Lowongan Berhasil dibuat.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'quota' => 'required|integer|min:1',
            'deadline' => 'nullable|date',
            'status' => 'required|in:open,closed',
        ]);

        $position->update($validated);

        return redirect()->route('admin.positions')->with('success', 'Lowongan Berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('admin.positions')->with('success', 'Lowongan Berhasil dihapus.');
    }
}
