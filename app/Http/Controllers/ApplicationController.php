<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Application;
use App\Models\Resume;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function create($id)
    {
        if (!session('logged_in') || session('user_role') !== 'jobseeker') {
            return redirect()->route('login')->with('error', 'Please login as a jobseeker to apply.');
        }

        $job = JobListing::with('employer.employerProfile')->findOrFail($id);
        $hasApplied = Application::where('job_listing_id', $id)
            ->where('jobseeker_id', session('user_id'))
            ->exists();

        if ($hasApplied) {
            return redirect()->route('jobs.show', $id)->with('error', 'You have already applied for this job.');
        }

        $resumes = Resume::where('user_id', session('user_id'))->get();

        return view('jobs.apply', compact('job', 'resumes'));
    }

    public function store(Request $request, $id)
    {
        if (!session('logged_in') || session('user_role') !== 'jobseeker') {
            return redirect()->route('login');
        }

        $request->validate([
            'cover_letter' => 'required|string|min:50',
        ]);

        Application::create([
            'job_listing_id' => $id,
            'jobseeker_id' => session('user_id'),
            'resume_id' => $request->resume_id ?: null,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return redirect()->route('jobseeker.applications')->with('success', 'Your application has been submitted successfully!');
    }
}