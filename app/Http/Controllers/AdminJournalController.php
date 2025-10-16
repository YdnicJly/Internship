<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminJournalController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with(['user', 'position']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate(10);

        return view('admin.applicants', compact('applications'));
    }

}
