<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentApplicationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'position_id' => 'required|exists:positions,id',
                'motivation' => 'required|string|max:1000',
                'duration' => 'required|string|max:50',
                'whatsapp_number' => 'required|string|max:20',
                'active_email' => 'required|email|max:255',
                'documents.*' => 'nullable|file|mimes:pdf|max:2048',
            ]);

            $application = Application::create([
                'user_id' => Auth::id(),
                'position_id' => $request->position_id,
                'motivation' => $request->motivation,
                'duration' => $request->duration,
                'whatsapp_number' => $request->whatsapp_number,
                'active_email' => $request->active_email,
                'status' => 'submitted',
            ]);

            // 🔹 Gunakan system path dari DOCUMENT_ROOT
            $destinationPath = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/documents';

            // Buat folder kalau belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // 🔹 Simpan setiap file
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $type => $file) {
                    if ($file) {
                        // Nama file unik
                        $filename = time() . '_' . uniqid() . '_' . $type . '.' . $file->getClientOriginalExtension();

                        // Pindahkan file ke public_html/documents/
                        $file->move($destinationPath, $filename);

                        // Simpan path relatif (untuk URL akses di view)
                        Document::create([
                            'application_id' => $application->id,
                            'type' => $type,
                            'path' => 'documents/' . $filename,
                        ]);
                    }
                }
            }

            return redirect()
                ->route('student.applications')
                ->with('success', 'Lamaran berhasil dikirim!');

        } catch (\Exception $e) {
            return redirect()
                ->route('student.applications')
                ->with('error', 'Terjadi kesalahan saat mengirim lamaran. Silakan coba lagi.');
        }
    }
}
