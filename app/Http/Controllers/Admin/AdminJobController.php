<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    private function checkAdmin()
    {
        if (session('admin_logged_in')) return null;
        if (session('logged_in') && session('user_role') === 'admin') return null;
        return redirect()->route('admin.login');
    }

    public function index()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $jobs = JobListing::with('employer.employerProfile')->latest()->paginate(15);
        return view('admin.jobs', compact('jobs'));
    }

    public function updateStatus(Request $request, $id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        JobListing::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Job status updated!');
    }

    public function destroy($id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        JobListing::findOrFail($id)->delete();
        return back()->with('success', 'Job deleted!');
    }
}