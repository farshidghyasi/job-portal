<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FreelancerProfile;
use App\Models\Proposal;
use App\Models\FreelanceJob;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    private function checkAuth()
    {
        if (!session('logged_in') || session('user_role') !== 'freelancer') {
            return redirect()->route('login')->with('error', 'Please login as a freelancer.');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $userId = session('user_id');
        $proposals = Proposal::where('freelancer_id', $userId)->with('freelanceJob.employer.employerProfile')->latest()->take(5)->get();
        $profile = FreelancerProfile::where('user_id', $userId)->first();
        $stats = [
            'total_proposals' => Proposal::where('freelancer_id', $userId)->count(),
            'accepted' => Proposal::where('freelancer_id', $userId)->where('status', 'accepted')->count(),
            'pending' => Proposal::where('freelancer_id', $userId)->where('status', 'pending')->count(),
            'rating' => $profile ? $profile->rating : 0,
        ];
        return view('freelancer.dashboard', compact('proposals', 'stats', 'profile'));
    }

    public function profile()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $user = User::with('freelancerProfile')->findOrFail(session('user_id'));
        return view('freelancer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $user = User::findOrFail(session('user_id'));
        $user->update($request->only(['name', 'phone', 'location']));
        session(['user_name' => $user->name]);

        $profile = FreelancerProfile::firstOrNew(['user_id' => $user->id]);
        $skills = array_filter(array_map('trim', explode(',', $request->skills ?? '')));
        $profile->fill(array_merge(
            $request->only(['title', 'bio', 'hourly_rate', 'availability', 'portfolio_url', 'github_url', 'linkedin_url', 'experience_years', 'category']),
            ['skills' => array_values($skills)]
        ));
        $profile->save();
        return back()->with('success', 'Profile updated!');
    }

    public function proposals()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $proposals = Proposal::where('freelancer_id', session('user_id'))
            ->with('freelanceJob.employer.employerProfile')
            ->latest()
            ->paginate(10);
        return view('freelancer.proposals', compact('proposals'));
    }

    public function applyForm($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $job = FreelanceJob::with('employer.employerProfile')->findOrFail($id);
        $hasApplied = Proposal::where('freelance_job_id', $id)->where('freelancer_id', session('user_id'))->exists();
        if ($hasApplied) return redirect()->route('freelance.show', $id)->with('error', 'You already submitted a proposal.');
        return view('freelancer.apply', compact('job'));
    }

    public function submitProposal(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $request->validate([
            'cover_letter' => 'required|string|min:50',
            'bid_amount' => 'required|numeric|min:1',
            'delivery_time' => 'required|string',
        ]);
        Proposal::create([
            'freelance_job_id' => $id,
            'freelancer_id' => session('user_id'),
            'cover_letter' => $request->cover_letter,
            'bid_amount' => $request->bid_amount,
            'delivery_time' => $request->delivery_time,
            'status' => 'pending',
        ]);
        return redirect()->route('freelancer.proposals')->with('success', 'Proposal submitted successfully!');
    }

    public function publicIndex()
    {
        $freelancers = FreelancerProfile::with('user')->orderBy('rating', 'desc')->paginate(12);
        return view('freelancers.index', compact('freelancers'));
    }

    public function publicShow($id)
    {
        $profile = FreelancerProfile::with('user')->findOrFail($id);
        return view('freelancers.show', compact('profile'));
    }
}