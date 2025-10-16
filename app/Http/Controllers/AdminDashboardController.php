<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $positionsCount = Position::count();
        $applicantsCount = User::where('role', 'student')->count();
        $interviewsCount = Application::where('status', 'interview')->count();
        $internsCount = Application::where('status', 'active')->count();

        $recentApplicants = Application::with(['user', 'position'])
            ->whereIn('status', ['submitted', 'under_review'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'positionsCount',
            'applicantsCount',
            'interviewsCount',
            'internsCount',
            'recentApplicants'
        ));
    }
}
