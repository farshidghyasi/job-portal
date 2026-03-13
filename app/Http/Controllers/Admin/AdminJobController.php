<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $jobs = JobListing::with('employer.employerProfile')->latest()->paginate(15);
        return view('admin.jobs', compact('jobs'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        JobListing::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Job status updated!');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        JobListing::findOrFail($id)->delete();
        return back()->with('success', 'Job deleted!');
    }
}