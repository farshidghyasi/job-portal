<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobseekerController extends Controller
{
    private function checkAuth()
    {
        if (!session('logged_in') || session('user_role') !== 'jobseeker') {
            return redirect()->route('login')->with('error', 'Please login as a jobseeker.');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $userId = session('user_id');
        $applications = Application::where('jobseeker_id', $userId)->with('job.employer.employerProfile')->latest()->take(5)->get();
        $savedJobs = JobListing::whereHas('savedByUsers', fn($q) => $q->where('users.id', $userId))->with('employer.employerProfile')->take(4)->get();
        $stats = [
            'total_applications' => Application::where('jobseeker_id', $userId)->count(),
            'pending' => Application::where('jobseeker_id', $userId)->where('status', 'pending')->count(),
            'shortlisted' => Application::where('jobseeker_id', $userId)->where('status', 'shortlisted')->count(),
            'saved_jobs' => $savedJobs->count(),
        ];

        return view('jobseeker.dashboard', compact('applications', 'savedJobs', 'stats'));
    }

    public function profile()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $user = User::findOrFail(session('user_id'));
        return view('jobseeker.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $request->validate(['name' => 'required|string|max:255']);
        $user = User::findOrFail(session('user_id'));
        $user->update($request->only(['name', 'phone', 'location']));
        session(['user_name' => $user->name]);
        return back()->with('success', 'Profile updated!');
    }

    public function applications()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $applications = Application::where('jobseeker_id', session('user_id'))
            ->with('job.employer.employerProfile')
            ->latest()
            ->paginate(10);
        return view('jobseeker.applications', compact('applications'));
    }

    public function savedJobs()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $user = User::findOrFail(session('user_id'));
        $savedJobs = $user->savedJobs()->with('employer.employerProfile')->paginate(10);
        return view('jobseeker.saved-jobs', compact('savedJobs'));
    }

    public function saveJob($id)
    {
        if (!session('logged_in') || session('user_role') !== 'jobseeker') {
            return redirect()->route('login');
        }
        $user = User::findOrFail(session('user_id'));
        $user->savedJobs()->toggle($id);
        return back()->with('success', 'Job saved/unsaved!');
    }
}