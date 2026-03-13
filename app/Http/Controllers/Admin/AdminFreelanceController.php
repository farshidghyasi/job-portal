<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreelanceJob;
use Illuminate\Http\Request;

class AdminFreelanceController extends Controller
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
        $jobs = FreelanceJob::with('employer.employerProfile')->withCount('proposals')->latest()->paginate(15);
        return view('admin.freelance', compact('jobs'));
    }

    public function updateStatus(Request $request, $id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        FreelanceJob::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Status updated!');
    }

    public function destroy($id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        FreelanceJob::findOrFail($id)->delete();
        return back()->with('success', 'Job deleted!');
    }
}