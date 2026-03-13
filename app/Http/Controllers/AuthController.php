<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployerProfile;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|confirmed',
            'role'      => 'required|in:jobseeker,employer,freelancer',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'phone'    => $request->phone,
            'location' => $request->location,
            'status'   => 'active',
        ]);

        if ($request->role === 'employer') {
            EmployerProfile::create([
                'user_id'      => $user->id,
                'company_name' => $request->company_name ?? $user->name . '\'s Company',
                'country'      => 'Afghanistan',
            ]);
        }

        if ($request->role === 'freelancer') {
            FreelancerProfile::create([
                'user_id'      => $user->id,
                'availability' => 'available',
            ]);
        }

        $this->setUserSession($user);

        return redirect()->route($user->role . '.dashboard')
            ->with('success', 'Welcome to Jobs.AF!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
        }

        if ($user->status === 'suspended') {
            return back()->withErrors(['email' => 'Your account has been suspended. Please contact support.'])->withInput();
        }

        $this->setUserSession($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome, ' . $user->name . '!');
        }

        return redirect()->route($user->role . '.dashboard')
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home')->with('success', 'You have been logged out.');
    }

    private function setUserSession(User $user)
    {
        session([
            'user_id'         => $user->id,
            'user_name'       => $user->name,
            'user_email'      => $user->email,
            'user_role'       => $user->role,
            'logged_in'       => true,
            // Also set admin keys so admin panel works seamlessly
            'admin_logged_in' => $user->role === 'admin',
            'admin_user'      => $user->role === 'admin' ? $user->name : null,
            'admin_email'     => $user->role === 'admin' ? $user->email : null,
            'admin_id'        => $user->role === 'admin' ? $user->id : null,
        ]);
    }
}