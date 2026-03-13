<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JobListing;
use App\Models\Application;
use App\Models\EmployerProfile;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    private function checkAuth()
    {
        if (!session('logged_in') || session('user_role') !== 'employer') {
            return redirect()->route('login')->with('error', 'Please login as an employer.');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $userId = session('user_id');
        $recentJobs = JobListing::where('employer_id', $userId)->with('applications')->latest()->take(5)->get();
        $stats = [
            'active_jobs' => JobListing::where('employer_id', $userId)->where('status', 'active')->count(),
            'total_applications' => Application::whereHas('job', fn($q) => $q->where('employer_id', $userId))->count(),
            'pending_reviews' => Application::whereHas('job', fn($q) => $q->where('employer_id', $userId))->where('status', 'pending')->count(),
            'hired' => Application::whereHas('job', fn($q) => $q->where('employer_id', $userId))->where('status', 'hired')->count(),
        ];
        return view('employer.dashboard', compact('recentJobs', 'stats'));
    }

    public function profile()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $user = User::with('employerProfile')->findOrFail(session('user_id'));
        return view('employer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $user = User::findOrFail(session('user_id'));
        $user->update($request->only(['name', 'phone', 'location']));
        session(['user_name' => $user->name]);

        $profile = EmployerProfile::firstOrNew(['user_id' => $user->id]);
        $profile->fill($request->only(['company_name', 'company_description', 'industry', 'company_size', 'founded_year', 'website', 'city', 'address']));
        $profile->save();

        return back()->with('success', 'Company profile updated!');
    }

    public function jobs()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $jobs = JobListing::where('employer_id', session('user_id'))->withCount('applications')->latest()->paginate(10);
        return view('employer.jobs', compact('jobs'));
    }

    public function createJob()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        return view('employer.create-job');
    }

    public function storeJob(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'category' => 'required|string',
            'type' => 'required|string',
            'location' => 'required|string',
        ]);

        $data = $request->only([
            'title', 'description', 'responsibilities', 'requirements', 'benefits',
            'category', 'type', 'work_arrangement', 'location', 'country', 'province',
            'salary_min', 'salary_max', 'salary_currency',
            'experience_level', 'years_of_experience', 'education_level',
            'deadline', 'num_vacancies', 'gender_preference',
        ]);

        if ($request->filled('skills_required')) {
            $data['skills_required'] = array_map('trim', explode(',', $request->skills_required));
        }
        if ($request->filled('skills_preferred')) {
            $data['skills_preferred'] = array_map('trim', explode(',', $request->skills_preferred));
        }

        $data['employer_id'] = session('user_id');
        $data['status'] = 'active';

        JobListing::create($data);

        return redirect()->route('employer.jobs')->with('success', 'Job posted successfully!');
    }

    public function editJob($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $job = JobListing::where('employer_id', session('user_id'))->findOrFail($id);
        return view('employer.edit-job', compact('job'));
    }

    public function updateJob(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $job = JobListing::where('employer_id', session('user_id'))->findOrFail($id);
        $data = $request->only([
            'title', 'description', 'responsibilities', 'requirements', 'benefits',
            'category', 'type', 'work_arrangement', 'location', 'country', 'province',
            'salary_min', 'salary_max', 'salary_currency',
            'experience_level', 'years_of_experience', 'education_level',
            'deadline', 'status', 'num_vacancies', 'gender_preference',
        ]);

        if ($request->has('skills_required')) {
            $data['skills_required'] = $request->skills_required
                ? array_map('trim', explode(',', $request->skills_required))
                : null;
        }
        if ($request->has('skills_preferred')) {
            $data['skills_preferred'] = $request->skills_preferred
                ? array_map('trim', explode(',', $request->skills_preferred))
                : null;
        }

        $job->update($data);
        return redirect()->route('employer.jobs')->with('success', 'Job updated!');
    }

    public function destroyJob($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        JobListing::where('employer_id', session('user_id'))->findOrFail($id)->delete();
        return redirect()->route('employer.jobs')->with('success', 'Job deleted.');
    }

    public function jobApplications($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $job = JobListing::where('employer_id', session('user_id'))->findOrFail($id);
        $applications = Application::where('job_listing_id', $id)->with('jobseeker', 'resume')->latest()->paginate(10);
        return view('employer.applications', compact('job', 'applications'));
    }

    public function updateApplicationStatus(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $application = Application::findOrFail($id);
        $application->update(['status' => $request->status, 'notes' => $request->notes]);
        return back()->with('success', 'Application status updated!');
    }

    public function publicIndex()
    {
        $companies = EmployerProfile::with('user')->paginate(12);
        return view('companies.index', compact('companies'));
    }

    public function publicShow($id)
    {
        $profile = EmployerProfile::with('user')->findOrFail($id);
        $jobs = JobListing::where('employer_id', $profile->user_id)->where('status', 'active')->latest()->take(6)->get();
        return view('companies.show', compact('profile', 'jobs'));
    }
}