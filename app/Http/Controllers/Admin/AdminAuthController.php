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
        if (session('admin_logged_in') || (session('logged_in') && session('user_role') === 'admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'admin')
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'admin_logged_in' => true,
                'admin_user'      => $user->name,
                'admin_email'     => $user->email,
                'admin_id'        => $user->id,
                'logged_in'       => true,
                'user_id'         => $user->id,
                'user_name'       => $user->name,
                'user_email'      => $user->email,
                'user_role'       => 'admin',
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials.'])->withInput();
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login');
    }
}