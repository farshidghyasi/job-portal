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
    private function checkAdmin()
    {
        // Accept either admin_logged_in (admin panel login) or logged_in with admin role
        if (session('admin_logged_in')) {
            return null;
        }
        if (session('logged_in') && session('user_role') === 'admin') {
            return null;
        }
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $stats = [
            'total_users'        => User::count(),
            'jobseekers'         => User::where('role', 'jobseeker')->count(),
            'employers'          => User::where('role', 'employer')->count(),
            'freelancers'        => User::where('role', 'freelancer')->count(),
            'active_jobs'        => JobListing::where('status', 'active')->count(),
            'total_applications' => Application::count(),
            'freelance_jobs'     => FreelanceJob::where('status', 'active')->count(),
            'total_proposals'    => Proposal::count(),
            'total_resumes'      => Resume::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentJobs  = JobListing::with('employer.employerProfile')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentJobs'));
    }
}