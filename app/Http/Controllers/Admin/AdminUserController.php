<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $user = User::with('employerProfile', 'freelancerProfile', 'resumes', 'jobListings', 'applications')->findOrFail($id);
        return view('admin.user-show', compact('user'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        User::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'User status updated!');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted!');
    }
}