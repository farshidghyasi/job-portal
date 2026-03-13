<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreelanceJob;
use Illuminate\Http\Request;

class AdminFreelanceController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $jobs = FreelanceJob::with('employer.employerProfile')->withCount('proposals')->latest()->paginate(15);
        return view('admin.freelance', compact('jobs'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        FreelanceJob::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Status updated!');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        FreelanceJob::findOrFail($id)->delete();
        return back()->with('success', 'Job deleted!');
    }
}