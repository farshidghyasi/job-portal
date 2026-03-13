@extends('layouts.app')
@section('title', 'Jobseeker Dashboard - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h1 class="text-2xl font-bold">Welcome back, {{ session('user_name') }}!</h1>
        <p class="text-up-muted mt-1">Manage your job applications and profile</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="text-3xl font-bold text-up-dark">{{ $stats['total_applications'] }}</div>
            <div class="text-up-text text-sm mt-1 font-medium">Applications</div>
        </div>
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="text-3xl font-bold text-yellow-500">{{ $stats['pending'] }}</div>
            <div class="text-up-text text-sm mt-1 font-medium">Pending</div>
        </div>
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="text-3xl font-bold text-up-green">{{ $stats['shortlisted'] }}</div>
            <div class="text-up-text text-sm mt-1 font-medium">Shortlisted</div>
        </div>
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="text-3xl font-bold text-up-dark">{{ $stats['saved_jobs'] }}</div>
            <div class="text-up-text text-sm mt-1 font-medium">Saved Jobs</div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('jobs.index') }}" class="bg-white border border-up-border rounded-2xl p-5 text-center card-hover group">
            <div class="w-12 h-12 bg-up-bg rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-up-green/10 transition-colors">
                <i class="fas fa-search text-up-green text-lg"></i>
            </div>
            <div class="text-sm font-semibold text-up-dark">Find Jobs</div>
        </a>
        <a href="{{ route('resume.create') }}" class="bg-white border border-up-border rounded-2xl p-5 text-center card-hover group">
            <div class="w-12 h-12 bg-up-bg rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-up-green/10 transition-colors">
                <i class="fas fa-file-lines text-up-green text-lg"></i>
            </div>
            <div class="text-sm font-semibold text-up-dark">Build Resume</div>
        </a>
        <a href="{{ route('jobseeker.applications') }}" class="bg-white border border-up-border rounded-2xl p-5 text-center card-hover group">
            <div class="w-12 h-12 bg-up-bg rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-up-green/10 transition-colors">
                <i class="fas fa-clipboard-list text-up-green text-lg"></i>
            </div>
            <div class="text-sm font-semibold text-up-dark">My Applications</div>
        </a>
        <a href="{{ route('jobseeker.profile') }}" class="bg-white border border-up-border rounded-2xl p-5 text-center card-hover group">
            <div class="w-12 h-12 bg-up-bg rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-up-green/10 transition-colors">
                <i class="fas fa-user-pen text-up-green text-lg"></i>
            </div>
            <div class="text-sm font-semibold text-up-dark">Edit Profile</div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Applications --}}
        <div class="bg-white border border-up-border rounded-2xl p-6">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-bold text-up-dark">Recent Applications</h2>
                <a href="{{ route('jobseeker.applications') }}" class="text-up-green text-sm font-medium hover:text-up-green-hover transition-colors">
                    View all <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
            @forelse($applications as $app)
            <div class="border-b border-up-border py-4 last:border-0 last:pb-0 first:pt-0">
                <div class="flex justify-between items-start gap-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-up-dark truncate">{{ $app->job->title }}</h3>
                        <p class="text-up-text text-sm mt-0.5">{{ $app->job->employer->employerProfile->company_name ?? $app->job->employer->name }}</p>
                        <p class="text-up-muted text-xs mt-1">{{ $app->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="flex-shrink-0 px-3 py-1 text-xs font-semibold rounded-pill
                        {{ $app->status === 'pending'    ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $app->status === 'shortlisted'? 'bg-up-bg text-up-green'        : '' }}
                        {{ $app->status === 'rejected'   ? 'bg-red-100 text-red-700'       : '' }}
                        {{ $app->status === 'hired'      ? 'bg-up-light text-up-dark'      : '' }}
                        {{ $app->status === 'reviewed'   ? 'bg-up-light text-up-text'      : '' }}">
                        {{ ucfirst($app->status) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center py-10">
                <div class="w-16 h-16 bg-up-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clipboard-list text-up-muted text-2xl"></i>
                </div>
                <p class="text-up-text text-sm">No applications yet.</p>
                <a href="{{ route('jobs.index') }}" class="text-up-green text-sm font-medium hover:underline mt-2 inline-block">Browse jobs &rarr;</a>
            </div>
            @endforelse
        </div>

        {{-- Saved Jobs --}}
        <div class="bg-white border border-up-border rounded-2xl p-6">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-bold text-up-dark">Saved Jobs</h2>
                <a href="{{ route('jobseeker.saved-jobs') }}" class="text-up-green text-sm font-medium hover:text-up-green-hover transition-colors">
                    View all <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
            @forelse($savedJobs as $job)
            <div class="border-b border-up-border py-4 last:border-0 last:pb-0 first:pt-0">
                <h3 class="font-semibold">
                    <a href="{{ route('jobs.show', $job->id) }}" class="text-up-dark hover:text-up-green transition-colors">
                        {{ $job->title }}
                    </a>
                </h3>
                <p class="text-up-text text-sm mt-0.5">
                    {{ $job->employer->employerProfile->company_name ?? $job->employer->name }}
                    &middot; {{ $job->location }}
                </p>
                <p class="text-up-green text-sm font-semibold mt-1">
                    ${{ number_format($job->salary_min) }}&ndash;${{ number_format($job->salary_max) }}/mo
                </p>
            </div>
            @empty
            <div class="text-center py-10">
                <div class="w-16 h-16 bg-up-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bookmark text-up-muted text-2xl"></i>
                </div>
                <p class="text-up-text text-sm">No saved jobs yet.</p>
                <a href="{{ route('jobs.index') }}" class="text-up-green text-sm font-medium hover:underline mt-2 inline-block">Browse jobs &rarr;</a>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
