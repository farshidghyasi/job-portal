<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployerProfile;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:jobseeker,employer,freelancer',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'location' => $request->location,
            'status' => 'active',
        ]);

        if ($request->role === 'employer') {
            EmployerProfile::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name ?? $user->name . '\'s Company',
                'country' => 'Afghanistan',
            ]);
        }

        if ($request->role === 'freelancer') {
            FreelancerProfile::create([
                'user_id' => $user->id,
                'availability' => 'available',
            ]);
        }

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role,
            'logged_in' => true,
        ]);

        return redirect()->route($user->role . '.dashboard')->with('success', 'Welcome to Jobs.AF!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->status === 'suspended') {
                return back()->withErrors(['email' => 'Your account has been suspended. Please contact support.']);
            }

            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_role' => $user->role,
                'logged_in' => true,
            ]);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route($user->role . '.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_email', 'user_role', 'logged_in']);
        return redirect()->route('home')->with('success', 'You have been logged out.');
    }
}