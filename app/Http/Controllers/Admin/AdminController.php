<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Application;
use App\Models\FreelanceJob;
use App\Models\Proposal;
use App\Models\Resume;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $stats = [
            'total_users' => User::count(),
            'jobseekers' => User::where('role', 'jobseeker')->count(),
            'employers' => User::where('role', 'employer')->count(),
            'freelancers' => User::where('role', 'freelancer')->count(),
            'active_jobs' => JobListing::where('status', 'active')->count(),
            'total_applications' => Application::count(),
            'freelance_jobs' => FreelanceJob::where('status', 'active')->count(),
            'total_proposals' => Proposal::count(),
            'total_resumes' => Resume::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentJobs = JobListing::with('employer.employerProfile')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentJobs'));
    }
}