<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class AdminApplicantController extends Controller
{
    // ✅ Menampilkan semua applicant
public function index(Request $request)
{
    $query = Application::with(['user', 'position', 'selection', 'documents'])
        ->whereNotIn('status', ['active', 'completed']) // ⛔️ Kecualikan status ini
        ->when($request->status, fn($q) => $q->where('status', $request->status))
        ->orderBy('created_at', 'desc');

    $applications = $query->get();

    return view('admin.applicants', compact('applications'));
}


    // ✅ Menampilkan detail applicant (AJAX)
    public function show($id)
    {
        $app = Application::with(['user', 'position', 'selection', 'documents'])
            ->findOrFail($id);

        return response()->json([
            'html' => view('admin.partials.applicant-detail', compact('app'))->render()
        ]);
    }

    // ✅ Update data applicant beserta selection & interview
    public function update(Request $request, $id)
    {
        $app = Application::findOrFail($id);

        $validated = $request->validate([
            'active_email' => 'required|email',
            'whatsapp_number' => 'required|string|max:20',
            'duration' => 'required|string|max:100',
            'motivation' => 'nullable|string',
            'status' => 'required|string|in:submitted,under_review,interview,accepted,rejected,active,completed',
            'score' => 'nullable|integer|min:0|max:100',
            'remarks' => 'nullable|string',
            'result' => 'nullable|string|in:pending,passed,failed',
            'scheduled_at' => 'nullable|date',
            'interview_status' => 'nullable|string|in:scheduled,done,canceled',
            'interview_result' => 'nullable|string',
        ]);

        // Update Application
        $app->update($validated);

        // ✅ Update atau buat data Selection
        if ($request->filled('score') || $request->filled('remarks') || $request->filled('result')) {
            $app->selection()->updateOrCreate(
                ['application_id' => $app->id],
                [
                    'score' => $request->score,
                    'remarks' => $request->remarks,
                    'result' => $request->result ?? 'pending',
                ]
            );
        }

        // ✅ Jika status interview → buat/jadwalkan wawancara
        if ($request->status === 'interview') {
            $app->interview()->updateOrCreate(
                ['application_id' => $app->id],
                [
                    'scheduled_at' => $request->scheduled_at,
                    'status' => $request->interview_status ?? 'scheduled',
                    'result' => $request->interview_result,
                ]
            );
        }

        return redirect()->route('admin.applicants')
            ->with('success', 'Data pendaftar berhasil diperbarui.');
    }


    // ✅ Hapus data applicant
    public function destroy($id)
    {
        $app = Application::findOrFail($id);
        $app->delete();

        return redirect()->route('admin.applicants')
            ->with('success', 'Data pendaftar berhasil dihapus.');
    }
}
