<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Selection;
use App\Models\Document;
use Illuminate\Http\Request;

class AdminApplicantController extends Controller
{
    // ✅ Menampilkan semua applicant
    public function index(Request $request)
    {
        $query = Application::with(['user', 'position', 'selection'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderBy('created_at', 'desc');

        $applications = $query->get();

        return view('admin.applicants', compact('applications'));
    }
}
