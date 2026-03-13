@extends('layouts.app')
@section('title', $profile->user->name . ' - Freelancer Profile')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-12">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
            {{-- Avatar --}}
            <div class="w-24 h-24 bg-white/10 border-2 border-white/20 rounded-full flex items-center justify-center text-4xl font-bold flex-shrink-0">
                {{ strtoupper(substr($profile->user->name, 0, 1)) }}
            </div>

            {{-- Info --}}
            <div class="flex-1 text-center sm:text-left">
                <h1 class="text-3xl font-bold mb-1">{{ $profile->user->name }}</h1>
                <p class="text-up-green text-lg font-medium mb-2">{{ $profile->title ?? $profile->category }}</p>
                <div class="flex items-center justify-center sm:justify-start gap-1">
                    @for($i = 0; $i < 5; $i++)
                    <span class="{{ $i < round($profile->rating) ? 'text-yellow-400' : 'text-white/30' }} text-lg">&#9733;</span>
                    @endfor
                    <span class="text-up-muted text-sm ml-2">({{ $profile->total_reviews }} reviews)</span>
                </div>
            </div>

            {{-- Rate --}}
            <div class="text-center sm:text-right">
                <div class="text-3xl font-bold">${{ $profile->hourly_rate }}/hr</div>
                <div class="text-up-muted mt-1">{{ ucfirst($profile->availability) }}</div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Main Content --}}
        <div class="flex-1">
            <div class="bg-white border border-up-border rounded-2xl p-8 mb-6">
                <h2 class="text-xl font-bold text-up-dark mb-4">About Me</h2>
                <p class="text-up-text leading-relaxed">{{ $profile->bio ?? 'No bio provided.' }}</p>
            </div>

            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-xl font-bold text-up-dark mb-4">Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(($profile->skills ?? []) as $skill)
                    <span class="bg-up-light text-up-text text-sm px-3 py-1 rounded-pill font-medium">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="lg:w-72">
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <h3 class="font-bold text-up-dark mb-4">Details</h3>
                <div class="space-y-3 text-sm mb-5">
                    <div class="flex justify-between">
                        <span class="text-up-muted">Category</span>
                        <span class="font-semibold text-up-dark">{{ $profile->category }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-up-muted">Experience</span>
                        <span class="font-semibold text-up-dark">{{ $profile->experience_years }} years</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-up-muted">Location</span>
                        <span class="font-semibold text-up-dark">{{ $profile->user->location }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-up-muted">Rate</span>
                        <span class="font-bold text-up-dark">${{ $profile->hourly_rate }}/hr</span>
                    </div>
                </div>

                <div class="border-t border-up-border pt-5 space-y-3">
                    @if(session('logged_in') && session('user_role') === 'employer')
                    <a href="{{ route('employer.freelance.create') }}" class="btn-primary block w-full text-center py-3 font-semibold">
                        Post a Project
                    </a>
                    @elseif(!session('logged_in'))
                    <a href="{{ route('register') }}" class="btn-primary block w-full text-center py-3 font-semibold">
                        Hire This Freelancer
                    </a>
                    @endif

                    @if($profile->portfolio_url)
                    <a href="{{ $profile->portfolio_url }}" target="_blank"
                       class="btn-outline block w-full text-center py-2.5 text-sm font-medium">
                        <i class="fas fa-external-link-alt mr-1"></i> View Portfolio
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
