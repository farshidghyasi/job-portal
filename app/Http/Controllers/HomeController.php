<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\FreelanceJob;
use App\Models\User;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = JobListing::with('employer.employerProfile')
            ->where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $latestJobs = JobListing::with('employer.employerProfile')
            ->where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        $featuredFreelance = FreelanceJob::with('employer.employerProfile')
            ->where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        $topFreelancers = FreelancerProfile::with('user')
            ->orderBy('rating', 'desc')
            ->take(4)
            ->get();

        $stats = [
            'total_jobs' => JobListing::where('status', 'active')->count(),
            'total_companies' => User::where('role', 'employer')->count(),
            'total_jobseekers' => User::where('role', 'jobseeker')->count(),
            'total_freelancers' => User::where('role', 'freelancer')->count(),
        ];

        $categories = [
            ['name' => 'Information Technology', 'icon' => '💻', 'count' => JobListing::where('category', 'Information Technology')->where('status', 'active')->count()],
            ['name' => 'Healthcare', 'icon' => '🏥', 'count' => JobListing::where('category', 'Healthcare')->where('status', 'active')->count()],
            ['name' => 'Engineering', 'icon' => '⚙️', 'count' => JobListing::where('category', 'Engineering')->where('status', 'active')->count()],
            ['name' => 'Education', 'icon' => '📚', 'count' => JobListing::where('category', 'Education')->where('status', 'active')->count()],
            ['name' => 'Finance', 'icon' => '💰', 'count' => JobListing::where('category', 'Finance')->where('status', 'active')->count()],
            ['name' => 'Management', 'icon' => '📊', 'count' => JobListing::where('category', 'Management')->where('status', 'active')->count()],
            ['name' => 'Design', 'icon' => '🎨', 'count' => JobListing::where('category', 'Design')->where('status', 'active')->count()],
            ['name' => 'Marketing', 'icon' => '📢', 'count' => JobListing::where('category', 'Marketing')->where('status', 'active')->count()],
        ];

        return view('home', compact('featuredJobs', 'latestJobs', 'featuredFreelance', 'topFreelancers', 'stats', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}