<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) return redirect()->route('admin.dashboard');
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $user = User::where('email', $request->email)->where('role', 'admin')->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['admin_logged_in' => true, 'admin_user' => $user->name, 'admin_email' => $user->email, 'admin_id' => $user->id]);
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Invalid admin credentials.']);
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_user', 'admin_email', 'admin_id']);
        return redirect()->route('admin.login');
    }
}