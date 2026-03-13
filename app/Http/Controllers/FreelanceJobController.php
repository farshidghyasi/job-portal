<?php

namespace App\Http\Controllers;

use App\Models\FreelanceJob;
use App\Models\Proposal;
use Illuminate\Http\Request;

class FreelanceJobController extends Controller
{
    public function index(Request $request)
    {
        $query = FreelanceJob::with('employer.employerProfile')->where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('budget_type')) {
            $query->where('budget_type', $request->budget_type);
        }

        $jobs = $query->latest()->paginate(12);
        $categories = ['Web Development', 'Mobile Development', 'Design', 'Marketing', 'Data Science', 'Writing', 'Translation', 'Video Production', 'Other'];

        return view('freelance.index', compact('jobs', 'categories'));
    }

    public function show($id)
    {
        $job = FreelanceJob::with('employer.employerProfile', 'proposals')->findOrFail($id);
        $hasApplied = false;
        if (session('logged_in') && session('user_role') === 'freelancer') {
            $hasApplied = $job->proposals()->where('freelancer_id', session('user_id'))->exists();
        }
        return view('freelance.show', compact('job', 'hasApplied'));
    }

    public function employerIndex()
    {
        if (!session('logged_in') || session('user_role') !== 'employer') return redirect()->route('login');
        $jobs = FreelanceJob::where('employer_id', session('user_id'))->withCount('proposals')->latest()->paginate(10);
        return view('employer.freelance-jobs', compact('jobs'));
    }

    public function create()
    {
        if (!session('logged_in') || session('user_role') !== 'employer') return redirect()->route('login');
        return view('employer.create-freelance-job');
    }

    public function store(Request $request)
    {
        if (!session('logged_in') || session('user_role') !== 'employer') return redirect()->route('login');
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'category' => 'required|string',
            'budget_type' => 'required|in:fixed,hourly',
        ]);
        $skills = array_filter(array_map('trim', explode(',', $request->skills_required ?? '')));
        FreelanceJob::create(array_merge($request->only(['title', 'description', 'category', 'budget_min', 'budget_max', 'budget_type', 'duration', 'location_type', 'deadline']), [
            'employer_id' => session('user_id'),
            'skills_required' => array_values($skills),
            'status' => 'active',
        ]));
        return redirect()->route('employer.freelance.index')->with('success', 'Freelance job posted!');
    }

    public function edit($id)
    {
        if (!session('logged_in') || session('user_role') !== 'employer') return redirect()->route('login');
        $job = FreelanceJob::where('employer_id', session('user_id'))->findOrFail($id);
        return view('employer.edit-freelance-job', compact('job'));
    }

    public function update(Request $request, $id)
    {
        if (!session('logged_in') || session('user_role') !== 'employer') return redirect()->route('login');
        $job = FreelanceJob::where('employer_id', session('user_id'))->findOrFail($id);
        $skills = array_filter(array_map('trim', explode(',', $request->skills_required ?? '')));
        $job->update(array_merge($request->only(['title', 'description', 'category', 'budget_min', 'budget_max', 'budget_type', 'duration', 'location_type', 'deadline', 'status']), [
            'skills_required' => array_values($skills),
        ]));
        return redirect()->route('employer.freelance.index')->with('success', 'Job updated!');
    }

    public function destroy($id)
    {
        if (!session('logged_in') || session('user_role') !== 'employer') return redirect()->route('login');
        FreelanceJob::where('employer_id', session('user_id'))->findOrFail($id)->delete();
        return redirect()->route('employer.freelance.index')->with('success', 'Job deleted.');
    }

    public function proposals($id)
    {
        if (!session('logged_in') || session('user_role') !== 'employer') return redirect()->route('login');
        $job = FreelanceJob::where('employer_id', session('user_id'))->findOrFail($id);
        $proposals = Proposal::where('freelance_job_id', $id)->with('freelancer.freelancerProfile')->latest()->paginate(10);
        return view('employer.freelance-proposals', compact('job', 'proposals'));
    }
}