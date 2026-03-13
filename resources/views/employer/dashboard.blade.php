@extends('layouts.app')
@section('title', 'Employer Dashboard - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <p class="text-up-muted text-sm font-medium uppercase tracking-widest mb-1">Employer Dashboard</p>
        <h1 class="text-3xl font-bold text-white">Welcome back</h1>
        <p class="text-up-muted mt-1">Manage your job postings and review applications</p>
    </div>
</div>

<div class="bg-up-bg border-b border-up-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6">

        {{-- Stats Row --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white border border-up-border rounded-2xl p-5">
                <div class="text-3xl font-bold text-up-green">{{ $stats['active_jobs'] }}</div>
                <div class="text-up-text text-sm mt-1">Active Jobs</div>
            </div>
            <div class="bg-white border border-up-border rounded-2xl p-5">
                <div class="text-3xl font-bold text-up-dark">{{ $stats['total_applications'] }}</div>
                <div class="text-up-text text-sm mt-1">Total Applications</div>
            </div>
            <div class="bg-white border border-up-border rounded-2xl p-5">
                <div class="text-3xl font-bold text-yellow-600">{{ $stats['pending_reviews'] }}</div>
                <div class="text-up-text text-sm mt-1">Pending Review</div>
            </div>
            <div class="bg-white border border-up-border rounded-2xl p-5">
                <div class="text-3xl font-bold text-up-dark">{{ $stats['hired'] }}</div>
                <div class="text-up-text text-sm mt-1">Hired</div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('employer.jobs.create') }}"
                class="bg-white border border-up-border rounded-2xl p-5 flex flex-col items-center text-center hover:border-up-green hover:shadow-md transition-all group">
                <div class="w-11 h-11 bg-up-bg rounded-xl flex items-center justify-center mb-3 group-hover:bg-up-green/10 transition-colors">
                    <i class="fa-solid fa-plus text-up-green text-lg"></i>
                </div>
                <span class="text-sm font-semibold text-up-dark">Post a Job</span>
            </a>
            <a href="{{ route('employer.jobs') }}"
                class="bg-white border border-up-border rounded-2xl p-5 flex flex-col items-center text-center hover:border-up-green hover:shadow-md transition-all group">
                <div class="w-11 h-11 bg-up-bg rounded-xl flex items-center justify-center mb-3 group-hover:bg-up-green/10 transition-colors">
                    <i class="fa-solid fa-briefcase text-up-green text-lg"></i>
                </div>
                <span class="text-sm font-semibold text-up-dark">My Jobs</span>
            </a>
            <a href="{{ route('employer.freelance.create') }}"
                class="bg-white border border-up-border rounded-2xl p-5 flex flex-col items-center text-center hover:border-up-green hover:shadow-md transition-all group">
                <div class="w-11 h-11 bg-up-bg rounded-xl flex items-center justify-center mb-3 group-hover:bg-up-green/10 transition-colors">
                    <i class="fa-solid fa-laptop-code text-up-green text-lg"></i>
                </div>
                <span class="text-sm font-semibold text-up-dark">Post Freelance</span>
            </a>
            <a href="{{ route('employer.profile') }}"
                class="bg-white border border-up-border rounded-2xl p-5 flex flex-col items-center text-center hover:border-up-green hover:shadow-md transition-all group">
                <div class="w-11 h-11 bg-up-bg rounded-xl flex items-center justify-center mb-3 group-hover:bg-up-green/10 transition-colors">
                    <i class="fa-solid fa-building text-up-green text-lg"></i>
                </div>
                <span class="text-sm font-semibold text-up-dark">Company Profile</span>
            </a>
        </div>
    </div>
</div>

{{-- Recent Jobs --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
    <div class="bg-white border border-up-border rounded-2xl overflow-hidden">
        <div class="flex justify-between items-center px-6 py-5 border-b border-up-border">
            <h2 class="text-lg font-bold text-up-dark">Recent Job Postings</h2>
            <a href="{{ route('employer.jobs') }}" class="text-up-green text-sm font-medium hover:text-up-green-hover transition-colors">
                View all <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
            </a>
        </div>

        @forelse($recentJobs as $job)
        <div class="border-b border-up-border last:border-0 px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-up-bg-light transition-colors">
            <div class="flex-1 min-w-0">
                <h3 class="font-semibold text-up-dark truncate">{{ $job->title }}</h3>
                <p class="text-up-muted text-sm mt-0.5">
                    {{ $job->applications->count() }} application{{ $job->applications->count() !== 1 ? 's' : '' }}
                    <span class="mx-1.5">&middot;</span>
                    {{ $job->created_at->diffForHumans() }}
                </p>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                @if($job->status === 'active')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-up-green/10 text-up-green">
                        <span class="w-1.5 h-1.5 rounded-full bg-up-green"></span> Active
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-up-light text-up-text">
                        <span class="w-1.5 h-1.5 rounded-full bg-up-muted"></span> {{ ucfirst($job->status) }}
                    </span>
                @endif
                <a href="{{ route('employer.jobs.applications', $job->id) }}"
                    class="btn-outline text-xs font-semibold px-4 py-1.5">
                    View Apps
                </a>
            </div>
        </div>
        @empty
        <div class="px-6 py-16 text-center">
            <div class="w-14 h-14 bg-up-bg rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-briefcase text-up-muted text-2xl"></i>
            </div>
            <p class="text-up-text font-medium mb-1">No jobs posted yet</p>
            <p class="text-up-muted text-sm mb-5">Start attracting candidates by posting your first job.</p>
            <a href="{{ route('employer.jobs.create') }}" class="btn-primary inline-block px-6 py-2.5 text-sm font-semibold">
                Post Your First Job
            </a>
        </div>
        @endforelse
    </div>
</div>

@endsection
