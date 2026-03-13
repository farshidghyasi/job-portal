@extends('layouts.app')
@section('title', 'Jobseeker Dashboard - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-8">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl font-bold">Welcome back, {{ session('user_name') }}! 👋</h1>
        <p class="text-green-100">Manage your job applications and profile</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-sm"><div class="text-2xl font-bold text-gray-800">{{ $stats['total_applications'] }}</div><div class="text-gray-500 text-sm">Applications</div></div>
        <div class="bg-white rounded-xl p-5 shadow-sm"><div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div><div class="text-gray-500 text-sm">Pending</div></div>
        <div class="bg-white rounded-xl p-5 shadow-sm"><div class="text-2xl font-bold text-green-600">{{ $stats['shortlisted'] }}</div><div class="text-gray-500 text-sm">Shortlisted</div></div>
        <div class="bg-white rounded-xl p-5 shadow-sm"><div class="text-2xl font-bold text-blue-600">{{ $stats['saved_jobs'] }}</div><div class="text-gray-500 text-sm">Saved Jobs</div></div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('jobs.index') }}" class="bg-green-600 hover:bg-green-700 text-white rounded-xl p-4 text-center transition-all"><div class="text-2xl mb-1">🔍</div><div class="text-sm font-medium">Find Jobs</div></a>
        <a href="{{ route('resume.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-4 text-center transition-all"><div class="text-2xl mb-1">📄</div><div class="text-sm font-medium">Build Resume</div></a>
        <a href="{{ route('jobseeker.applications') }}" class="bg-purple-600 hover:bg-purple-700 text-white rounded-xl p-4 text-center transition-all"><div class="text-2xl mb-1">📋</div><div class="text-sm font-medium">My Applications</div></a>
        <a href="{{ route('jobseeker.profile') }}" class="bg-gray-600 hover:bg-gray-700 text-white rounded-xl p-4 text-center transition-all"><div class="text-2xl mb-1">👤</div><div class="text-sm font-medium">Edit Profile</div></a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Applications -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800">Recent Applications</h2>
                <a href="{{ route('jobseeker.applications') }}" class="text-green-600 text-sm">View all →</a>
            </div>
            @forelse($applications as $app)
            <div class="border-b border-gray-100 py-4 last:border-0">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-gray-800">{{ $app->job->title }}</h3>
                        <p class="text-gray-500 text-sm">{{ $app->job->employer->employerProfile->company_name ?? $app->job->employer->name }}</p>
                        <p class="text-gray-400 text-xs mt-1">{{ $app->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full
                        {{ $app->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $app->status === 'shortlisted' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $app->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $app->status === 'hired' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $app->status === 'reviewed' ? 'bg-purple-100 text-purple-700' : '' }}">
                        {{ ucfirst($app->status) }}
                    </span>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-center py-8">No applications yet. <a href="{{ route('jobs.index') }}" class="text-green-600">Browse jobs →</a></p>
            @endforelse
        </div>

        <!-- Saved Jobs -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800">Saved Jobs</h2>
                <a href="{{ route('jobseeker.saved-jobs') }}" class="text-green-600 text-sm">View all →</a>
            </div>
            @forelse($savedJobs as $job)
            <div class="border-b border-gray-100 py-4 last:border-0">
                <h3 class="font-semibold"><a href="{{ route('jobs.show', $job->id) }}" class="hover:text-green-600">{{ $job->title }}</a></h3>
                <p class="text-gray-500 text-sm">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }} · {{ $job->location }}</p>
                <p class="text-green-600 text-sm font-medium">${{ number_format($job->salary_min) }}-${{ number_format($job->salary_max) }}/mo</p>
            </div>
            @empty
            <p class="text-gray-400 text-center py-8">No saved jobs yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
