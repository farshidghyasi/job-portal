<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
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
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function show($id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $user = User::with('employerProfile', 'freelancerProfile', 'resumes', 'jobListings', 'applications')->findOrFail($id);
        return view('admin.user-show', compact('user'));
    }

    public function updateStatus(Request $request, $id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        User::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'User status updated!');
    }

    public function destroy($id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted!');
    }
}