@extends('layouts.app')
@section('title', 'My Profile - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-8">
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-2xl font-bold">My Profile</h1>
    </div>
</div>
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ route('jobseeker.profile.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                <input type="email" value="{{ $user->email }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50" disabled>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Phone Number</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Location</label>
                <input type="text" name="location" value="{{ $user->location }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
            </div>
            <div class="flex gap-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-semibold transition-all">Save Changes</button>
                <a href="{{ route('resume.index') }}" class="border border-gray-300 text-gray-600 px-8 py-3 rounded-xl hover:bg-gray-50 transition-all">Manage Resumes</a>
            </div>
        </form>
    </div>
</div>
@endsection
