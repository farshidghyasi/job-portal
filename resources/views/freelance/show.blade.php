@extends('layouts.app')
@section('title', $job->title . ' - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex flex-wrap gap-2 mb-4">
            <span class="bg-white/10 text-up-muted text-xs px-3 py-1 rounded-pill">{{ $job->category }}</span>
            <span class="bg-white/10 text-up-muted text-xs px-3 py-1 rounded-pill">{{ ucfirst($job->budget_type) }} Price</span>
            <span class="bg-white/10 text-up-muted text-xs px-3 py-1 rounded-pill">{{ ucfirst($job->location_type) }}</span>
        </div>
        <h1 class="text-3xl font-bold mb-3">{{ $job->title }}</h1>
        <div class="flex flex-wrap gap-5 text-up-muted text-sm">
            <span><i class="fas fa-dollar-sign mr-1"></i>${{ number_format($job->budget_min) }}&ndash;${{ number_format($job->budget_max) }}{{ $job->budget_type === 'hourly' ? '/hr' : '' }}</span>
            <span><i class="fas fa-clock mr-1"></i>{{ $job->duration ?? 'Flexible' }}</span>
            <span><i class="fas fa-calendar-alt mr-1"></i>Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}</span>
            <span><i class="fas fa-paper-plane mr-1"></i>{{ $job->proposals->count() }} proposals</span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Main Content --}}
        <div class="flex-1">
            <div class="bg-white border border-up-border rounded-2xl p-8 mb-6">
                <h2 class="text-xl font-bold text-up-dark mb-4">Project Description</h2>
                <p class="text-up-text leading-relaxed">{{ $job->description }}</p>
            </div>

            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-xl font-bold text-up-dark mb-4">Required Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(($job->skills_required ?? []) as $skill)
                    <span class="bg-up-light text-up-text text-sm px-3 py-1 rounded-pill font-medium">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="lg:w-72">
            {{-- Apply / Budget Card --}}
            <div class="bg-white border border-up-border rounded-2xl p-6 sticky top-20 mb-6">
                <div class="text-center mb-5">
                    <div class="text-3xl font-bold text-up-dark">
                        ${{ number_format($job->budget_min) }}&ndash;${{ number_format($job->budget_max) }}
                    </div>
                    <div class="text-up-muted text-sm mt-1">{{ $job->budget_type === 'hourly' ? 'Per Hour' : 'Fixed Price' }}</div>
                </div>

                @if($hasApplied)
                <div class="bg-up-bg border border-up-border rounded-xl p-4 text-center">
                    <i class="fas fa-check-circle text-up-green text-xl mb-1"></i>
                    <p class="text-up-dark font-semibold text-sm">Proposal Submitted</p>
                </div>
                @elseif(session('logged_in') && session('user_role') === 'freelancer')
                <a href="{{ route('freelance.apply', $job->id) }}" class="btn-primary block w-full text-center py-3 font-semibold">
                    Submit Proposal
                </a>
                @elseif(!session('logged_in'))
                <a href="{{ route('login') }}" class="btn-primary block w-full text-center py-3 font-semibold">
                    Login to Apply
                </a>
                @endif

                <div class="mt-5 space-y-3 text-sm border-t border-up-border pt-5">
                    <div class="flex justify-between">
                        <span class="text-up-muted">Duration</span>
                        <span class="font-semibold text-up-dark">{{ $job->duration ?? 'Flexible' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-up-muted">Location</span>
                        <span class="font-semibold text-up-dark">{{ ucfirst($job->location_type) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-up-muted">Proposals</span>
                        <span class="font-semibold text-up-dark">{{ $job->proposals->count() }}</span>
                    </div>
                </div>
            </div>

            {{-- Client Card --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <h3 class="font-bold text-up-dark mb-4">About the Client</h3>
                <div class="text-center">
                    <div class="w-14 h-14 bg-up-dark rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-3">
                        {{ strtoupper(substr($job->employer->employerProfile->company_name ?? $job->employer->name, 0, 1)) }}
                    </div>
                    <h4 class="font-semibold text-up-dark">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }}</h4>
                    @if($job->employer->employerProfile)
                    <p class="text-up-muted text-sm mt-1">{{ $job->employer->employerProfile->city }}, Afghanistan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
