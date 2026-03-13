@extends('layouts.app')
@section('title', 'Register - Jobs.AF')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-50 py-12">
    <div class="max-w-lg mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Create Your Account</h1>
            <p class="text-gray-500 mt-2">Join Afghanistan's largest job portal</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Account Type -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-3">I am a...</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="jobseeker" class="sr-only peer" {{ old('role', 'jobseeker') === 'jobseeker' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 rounded-xl p-4 text-center transition-all">
                                <div class="text-2xl mb-1">💼</div>
                                <div class="text-sm font-medium text-gray-700">Job Seeker</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="employer" class="sr-only peer" {{ old('role') === 'employer' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 rounded-xl p-4 text-center transition-all">
                                <div class="text-2xl mb-1">🏢</div>
                                <div class="text-sm font-medium text-gray-700">Employer</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="freelancer" class="sr-only peer" {{ old('role') === 'freelancer' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 rounded-xl p-4 text-center transition-all">
                                <div class="text-2xl mb-1">🖥️</div>
                                <div class="text-sm font-medium text-gray-700">Freelancer</div>
                            </div>
                        </label>
                    </div>
                    @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('name') border-red-500 @enderror">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('email') border-red-500 @enderror">
                    @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+93 700 000 000" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Kabul, Afghanistan" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 @error('password') border-red-500 @enderror">
                    @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition-all">Create Account</button>
            </form>
            <p class="text-center text-gray-500 mt-4 text-sm">Already have an account? <a href="{{ route('login') }}" class="text-green-600 hover:underline font-medium">Login</a></p>
        </div>
    </div>
</div>
@endsection
