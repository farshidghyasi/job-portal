@extends('layouts.app')
@section('title', 'Applications for ' . $job->title)
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <a href="{{ route('employer.jobs') }}" class="inline-flex items-center gap-2 text-up-muted hover:text-white text-sm mb-3 transition-colors">
            <i class="fa-solid fa-arrow-left text-xs"></i> My Jobs
        </a>
        <h1 class="text-3xl font-bold text-white">{{ $job->title }}</h1>
        <p class="text-up-muted mt-1">{{ $applications->total() }} application{{ $applications->total() !== 1 ? 's' : '' }} received</p>
    </div>
</div>

<div class="bg-up-bg min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <div class="space-y-4">
            @forelse($applications as $app)
            <div class="bg-white border border-up-border rounded-2xl p-6 hover:border-up-green transition-colors">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">

                    {{-- Applicant Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 bg-up-green rounded-full flex items-center justify-center text-white font-bold text-base flex-shrink-0">
                                {{ strtoupper(substr($app->jobseeker->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-bold text-up-dark truncate">{{ $app->jobseeker->name }}</h3>
                                <p class="text-up-muted text-sm truncate">
                                    {{ $app->jobseeker->email }}
                                    @if($app->jobseeker->location)
                                    <span class="mx-1">&middot;</span>{{ $app->jobseeker->location }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Cover Letter --}}
                        <div class="bg-up-bg border border-up-border rounded-xl p-4 mb-4">
                            <p class="text-xs font-semibold text-up-text uppercase tracking-wide mb-2">Cover Letter</p>
                            <p class="text-up-text text-sm leading-relaxed">{{ Str::limit($app->cover_letter, 300) }}</p>
                        </div>

                        {{-- Resume Link --}}
                        @if($app->resume)
                        <a href="{{ route('resume.view', $app->resume->id) }}" target="_blank"
                            class="inline-flex items-center gap-2 text-up-green hover:text-up-green-hover text-sm font-medium hover:underline">
                            <i class="fa-solid fa-file-pdf"></i> View Resume: {{ $app->resume->title }}
                        </a>
                        @endif

                        <p class="text-up-muted text-xs mt-3">
                            <i class="fa-regular fa-clock mr-1"></i>Applied {{ $app->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- Status Selector --}}
                    <div class="flex-shrink-0 w-full md:w-44">
                        <p class="text-xs font-semibold text-up-text uppercase tracking-wide mb-2">Update Status</p>
                        <form action="{{ route('employer.applications.status', $app->id) }}" method="POST">
                            @csrf @method('PUT')
                            <select name="status"
                                class="w-full border border-up-border rounded-xl px-3 py-2.5 text-sm text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                                onchange="this.form.submit()">
                                <option value="pending" {{ $app->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="reviewed" {{ $app->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                <option value="shortlisted" {{ $app->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                <option value="rejected" {{ $app->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="hired" {{ $app->status === 'hired' ? 'selected' : '' }}>Hired</option>
                            </select>
                        </form>

                        {{-- Current Badge --}}
                        <div class="mt-2">
                            @if($app->status === 'hired')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-up-green/10 text-up-green">
                                    <i class="fa-solid fa-check"></i> Hired
                                </span>
                            @elseif($app->status === 'shortlisted')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-sky-50 text-up-badge">
                                    <i class="fa-solid fa-star"></i> Shortlisted
                                </span>
                            @elseif($app->status === 'rejected')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600">
                                    <i class="fa-solid fa-xmark"></i> Rejected
                                </span>
                            @elseif($app->status === 'reviewed')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700">
                                    <i class="fa-solid fa-eye"></i> Reviewed
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700">
                                    <i class="fa-regular fa-clock"></i> Pending
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white border border-up-border rounded-2xl px-6 py-20 text-center">
                <div class="w-16 h-16 bg-up-bg rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-regular fa-envelope-open text-up-muted text-2xl"></i>
                </div>
                <p class="text-up-text font-semibold mb-1">No applications yet</p>
                <p class="text-up-muted text-sm">Applications for this position will appear here once submitted.</p>
            </div>
            @endforelse
        </div>

        @if($applications->hasPages())
        <div class="mt-6">{{ $applications->links() }}</div>
        @endif

    </div>
</div>

@endsection
