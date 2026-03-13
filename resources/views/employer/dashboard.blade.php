@extends('layouts.app')
@section('title', 'Employer Dashboard - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-600 text-white py-8">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl font-bold">Employer Dashboard 🏢</h1>
        <p class="text-blue-100">Manage your job postings and applications</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-sm"><div class="text-2xl font-bold text-blue-600">{{ $stats['active_jobs'] }}</div><div class="text-gray-500 text-sm">Active Jobs</div></div>
        <div class="bg-white rounded-xl p-5 shadow-sm"><div class="text-2xl font-bold text-gray-800">{{ $stats['total_applications'] }}</div><div class="text-gray-500 text-sm">Total Applications</div></div>
        <div class="bg-white rounded-xl p-5 shadow-sm"><div class="text-2xl font-bold text-yellow-600">{{ $stats['pending_reviews'] }}</div><div class="text-gray-500 text-sm">Pending Review</div></div>
        <div class="bg-white rounded-xl p-5 shadow-sm"><div class="text-2xl font-bold text-green-600">{{ $stats['hired'] }}</div><div class="text-gray-500 text-sm">Hired</div></div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('employer.jobs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-4 text-center transition-all"><div class="text-2xl mb-1">➕</div><div class="text-sm font-medium">Post a Job</div></a>
        <a href="{{ route('employer.jobs') }}" class="bg-green-600 hover:bg-green-700 text-white rounded-xl p-4 text-center transition-all"><div class="text-2xl mb-1">📋</div><div class="text-sm font-medium">My Jobs</div></a>
        <a href="{{ route('employer.freelance.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white rounded-xl p-4 text-center transition-all"><div class="text-2xl mb-1">💻</div><div class="text-sm font-medium">Post Freelance</div></a>
        <a href="{{ route('employer.profile') }}" class="bg-gray-600 hover:bg-gray-700 text-white rounded-xl p-4 text-center transition-all"><div class="text-2xl mb-1">🏢</div><div class="text-sm font-medium">Company Profile</div></a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-800">Recent Job Postings</h2>
            <a href="{{ route('employer.jobs') }}" class="text-blue-600 text-sm">View all →</a>
        </div>
        @forelse($recentJobs as $job)
        <div class="border-b border-gray-100 py-4 last:border-0 flex justify-between items-center">
            <div>
                <h3 class="font-semibold text-gray-800">{{ $job->title }}</h3>
                <p class="text-gray-400 text-sm">{{ $job->applications->count() }} applications · {{ $job->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-2 py-1 text-xs rounded-full {{ $job->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ ucfirst($job->status) }}</span>
                <a href="{{ route('employer.jobs.applications', $job->id) }}" class="text-blue-600 text-sm hover:underline">View Apps</a>
            </div>
        </div>
        @empty
        <p class="text-gray-400 text-center py-8">No jobs posted yet. <a href="{{ route('employer.jobs.create') }}" class="text-blue-600">Post your first job →</a></p>
        @endforelse
    </div>
</div>
@endsection
