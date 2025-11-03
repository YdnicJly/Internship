<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentApplicationController extends Controller
{
    public function store(Request $request)
    {
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

        // Save documents if any
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $type => $file) {
                if ($file) {
                    $path = $file->store('documents', 'public');
                    Document::create([
                        'application_id' => $application->id,
                        'type' => $type,
                        'path' => $path,
                    ]);
                }
            }
        }

        return redirect()->route('student.applications')
            ->with('success', 'Your application has been submitted successfully!');
    }
}
