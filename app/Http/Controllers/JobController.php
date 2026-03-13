<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::with('employer.employerProfile')->where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('experience')) {
            $query->where('experience_level', $request->experience);
        }

        if ($request->filled('work_arrangement')) {
            $query->where('work_arrangement', $request->work_arrangement);
        }

        if ($request->filled('gender')) {
            $query->where('gender_preference', $request->gender);
        }

        $jobs = $query->latest()->paginate(12);

        $categories = ['Information Technology', 'Healthcare', 'Engineering', 'Education', 'Finance', 'Management', 'Design', 'Marketing', 'Human Resources', 'Administration', 'Customer Service', 'Logistics'];

        return view('jobs.index', compact('jobs', 'categories'));
    }

    public function show($id)
    {
        $job = JobListing::with('employer.employerProfile')->findOrFail($id);
        $job->increment('views_count');

        $relatedJobs = JobListing::with('employer.employerProfile')
            ->where('status', 'active')
            ->where('category', $job->category)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        $hasApplied = false;
        if (session('logged_in') && session('user_role') === 'jobseeker') {
            $hasApplied = $job->applications()->where('jobseeker_id', session('user_id'))->exists();
        }

        return view('jobs.show', compact('job', 'relatedJobs', 'hasApplied'));
    }

    public function byCategory($category)
    {
        $jobs = JobListing::with('employer.employerProfile')
            ->where('status', 'active')
            ->where('category', $category)
            ->latest()
            ->paginate(12);

        return view('jobs.index', compact('jobs'))->with('selectedCategory', $category);
    }
}