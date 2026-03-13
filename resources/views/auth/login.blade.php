@extends('layouts.app')
@section('title', 'Login - Jobs.AF')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-50 py-12">
    <div class="max-w-md mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Welcome Back</h1>
            <p class="text-gray-500 mt-2">Login to your Jobs.AF account</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <!-- Demo Credentials -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                <p class="text-blue-800 font-semibold text-sm mb-2">🔑 Demo Credentials:</p>
                <div class="text-xs text-blue-700 space-y-1">
                    <p><strong>Job Seeker:</strong> khalid@gmail.com / password</p>
                    <p><strong>Employer:</strong> ahmad@techcorp.af / password</p>
                    <p><strong>Freelancer:</strong> bilal@gmail.com / password</p>
                    <p><strong>Admin:</strong> admin@jobs.af / password → <a href="{{ route('admin.login') }}" class="underline">Admin Panel</a></p>
                </div>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('email') border-red-500 @enderror">
                    @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition-all">Login</button>
            </form>
            <p class="text-center text-gray-500 mt-4 text-sm">Don't have an account? <a href="{{ route('register') }}" class="text-green-600 hover:underline font-medium">Register</a></p>
        </div>
    </div>
</div>
@endsection
