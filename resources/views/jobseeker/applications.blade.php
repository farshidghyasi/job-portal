@extends('layouts.app')
@section('title', 'My Applications - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <h1 class="text-2xl font-bold">My Applications</h1>
        <p class="text-up-muted mt-1">Track every job you've applied to</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    <div class="space-y-4">
        @forelse($applications as $app)
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">

                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-bold text-up-dark">{{ $app->job->title }}</h3>
                    <p class="text-up-text text-sm mt-1">
                        <i class="fas fa-building text-up-muted mr-1.5"></i>
                        {{ $app->job->employer->employerProfile->company_name ?? $app->job->employer->name }}
                        &middot; {{ $app->job->location }}
                    </p>
                    <p class="text-up-muted text-xs mt-1.5">
                        <i class="fas fa-clock mr-1"></i>Applied {{ $app->created_at->diffForHumans() }}
                    </p>
                    @if($app->cover_letter)
                    <p class="text-up-text text-sm mt-3 italic border-l-2 border-up-border pl-3">
                        &ldquo;{{ Str::limit($app->cover_letter, 120) }}&rdquo;
                    </p>
                    @endif
                </div>

                <div class="flex-shrink-0">
                    <span class="px-4 py-1.5 rounded-pill text-sm font-semibold
                        {{ $app->status === 'pending'    ? 'bg-yellow-100 text-yellow-700'  : '' }}
                        {{ $app->status === 'reviewed'   ? 'bg-up-light text-up-text'       : '' }}
                        {{ $app->status === 'shortlisted'? 'bg-up-bg text-up-green'         : '' }}
                        {{ $app->status === 'rejected'   ? 'bg-red-100 text-red-700'        : '' }}
                        {{ $app->status === 'hired'      ? 'bg-up-green text-white'         : '' }}">
                        {{ ucfirst($app->status) }}
                    </span>
                </div>

            </div>
        </div>
        @empty
        <div class="bg-white border border-up-border rounded-2xl text-center py-20">
            <div class="w-20 h-20 bg-up-bg rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-clipboard-list text-up-muted text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-up-dark mb-2">No applications yet</h3>
            <p class="text-up-text text-sm mb-6">Start applying to jobs that match your skills.</p>
            <a href="{{ route('jobs.index') }}" class="btn-primary px-8 py-3 text-sm font-semibold inline-block">
                <i class="fas fa-search mr-2"></i>Browse Jobs
            </a>
        </div>
        @endforelse
    </div>

    @if($applications->hasPages())
    <div class="mt-8">
        {{ $applications->links() }}
    </div>
    @endif

</div>
@endsection
