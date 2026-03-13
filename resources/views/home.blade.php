@extends('layouts.app')
@section('title', 'Jobs.AF - Find Jobs in Afghanistan')
@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-green-700 via-green-600 to-emerald-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <div class="inline-flex items-center bg-white/20 rounded-full px-4 py-2 text-sm mb-6">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></span>
            Afghanistan's #1 Job Portal
        </div>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">Find Your Dream Job<br><span class="text-yellow-300">in Afghanistan</span></h1>
        <p class="text-xl text-green-100 mb-10 max-w-2xl mx-auto">Connect with top employers, build your resume, and discover freelance opportunities across Afghanistan.</p>

        <!-- Search Bar -->
        <div class="bg-white rounded-2xl p-2 max-w-3xl mx-auto shadow-2xl">
            <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                <input type="text" name="search" placeholder="Job title, keywords..." class="flex-1 px-4 py-3 text-gray-800 rounded-xl outline-none">
                <input type="text" name="location" placeholder="Location (Kabul, Herat...)" class="flex-1 px-4 py-3 text-gray-800 rounded-xl outline-none">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-semibold transition-all">Search Jobs</button>
            </form>
        </div>

        <!-- Quick Links -->
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <span class="text-green-200 text-sm">Popular:</span>
            <a href="{{ route('jobs.index') }}?category=Information+Technology" class="bg-white/20 hover:bg-white/30 text-sm px-4 py-1 rounded-full transition-all">IT & Tech</a>
            <a href="{{ route('jobs.index') }}?category=Healthcare" class="bg-white/20 hover:bg-white/30 text-sm px-4 py-1 rounded-full transition-all">Healthcare</a>
            <a href="{{ route('jobs.index') }}?category=Engineering" class="bg-white/20 hover:bg-white/30 text-sm px-4 py-1 rounded-full transition-all">Engineering</a>
            <a href="{{ route('jobs.index') }}?category=Education" class="bg-white/20 hover:bg-white/30 text-sm px-4 py-1 rounded-full transition-all">Education</a>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="bg-white py-10 shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <div class="text-3xl font-bold text-green-600">{{ number_format($stats['total_jobs']) }}+</div>
                <div class="text-gray-500 text-sm mt-1">Active Jobs</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-green-600">{{ number_format($stats['total_companies']) }}+</div>
                <div class="text-gray-500 text-sm mt-1">Companies</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-green-600">{{ number_format($stats['total_jobseekers']) }}+</div>
                <div class="text-gray-500 text-sm mt-1">Job Seekers</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-green-600">{{ number_format($stats['total_freelancers']) }}+</div>
                <div class="text-gray-500 text-sm mt-1">Freelancers</div>
            </div>
        </div>
    </div>
</section>

<!-- Job Categories -->
<section class="py-16 max-w-7xl mx-auto px-4">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Browse by Category</h2>
        <p class="text-gray-500 mt-2">Find jobs in your field of expertise</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($categories as $cat)
        <a href="{{ route('jobs.index') }}?category={{ urlencode($cat['name']) }}" class="bg-white card-hover rounded-xl p-6 text-center shadow-sm border border-gray-100">
            <div class="text-4xl mb-3">{{ $cat['icon'] }}</div>
            <div class="font-semibold text-gray-800">{{ $cat['name'] }}</div>
            <div class="text-green-600 text-sm mt-1">{{ $cat['count'] }} Jobs</div>
        </a>
        @endforeach
    </div>
</section>

<!-- Featured Jobs -->
@if($featuredJobs->count() > 0)
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Featured Jobs</h2>
                <p class="text-gray-500 mt-1">Top opportunities from leading employers</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="text-green-600 hover:text-green-700 font-medium">View all jobs →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredJobs as $job)
            <a href="{{ route('jobs.show', $job->id) }}" class="bg-white card-hover rounded-xl p-6 shadow-sm border border-gray-100 block">
                <div class="flex justify-between items-start mb-3">
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-medium">⭐ Featured</span>
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">{{ ucfirst($job->type) }}</span>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $job->title }}</h3>
                <p class="text-gray-500 text-sm mb-3">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }}</p>
                <div class="flex items-center text-gray-400 text-sm space-x-4">
                    <span>📍 {{ $job->location }}</span>
                    <span>💰 ${{ number_format($job->salary_min) }}-${{ number_format($job->salary_max) }}</span>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-xs text-gray-400">{{ $job->created_at->diffForHumans() }}</span>
                    <span class="text-green-600 text-sm font-medium">Apply Now →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Jobs -->
<section class="py-16 max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Latest Jobs</h2>
            <p class="text-gray-500 mt-1">Recently posted opportunities</p>
        </div>
        <a href="{{ route('jobs.index') }}" class="text-green-600 font-medium">View all →</a>
    </div>
    <div class="space-y-4">
        @foreach($latestJobs as $job)
        <a href="{{ route('jobs.show', $job->id) }}" class="bg-white card-hover rounded-xl p-5 shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center justify-between block">
            <div class="flex-1">
                <div class="flex flex-wrap gap-2 mb-2">
                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded">{{ $job->category }}</span>
                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ ucfirst($job->type) }}</span>
                </div>
                <h3 class="font-bold text-gray-800 text-lg">{{ $job->title }}</h3>
                <p class="text-gray-500 text-sm">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }} · {{ $job->location }}</p>
            </div>
            <div class="mt-3 md:mt-0 md:text-right">
                <div class="text-green-600 font-semibold">${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}/mo</div>
                <div class="text-gray-400 text-xs mt-1">{{ $job->created_at->diffForHumans() }}</div>
            </div>
        </a>
        @endforeach
    </div>
</section>

<!-- Freelance Section -->
<section class="bg-gradient-to-r from-purple-700 to-indigo-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold">Freelance Opportunities</h2>
            <p class="text-purple-200 mt-2">Find flexible projects and remote work</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            @foreach($featuredFreelance as $job)
            <a href="{{ route('freelance.show', $job->id) }}" class="bg-white/10 hover:bg-white/20 rounded-xl p-5 block transition-all">
                <div class="flex justify-between items-start mb-3">
                    <span class="bg-purple-500/50 text-white text-xs px-2 py-1 rounded">{{ $job->category }}</span>
                    <span class="text-yellow-300 font-semibold">${{ number_format($job->budget_min) }}-${{ number_format($job->budget_max) }}{{ $job->budget_type === 'hourly' ? '/hr' : '' }}</span>
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $job->title }}</h3>
                <p class="text-purple-200 text-sm">{{ Str::limit($job->description, 80) }}</p>
                <div class="mt-3 flex flex-wrap gap-1">
                    @foreach(($job->skills_required ?? []) as $skill)
                    <span class="bg-white/20 text-xs px-2 py-1 rounded">{{ $skill }}</span>
                    @endforeach
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('freelance.index') }}" class="bg-white text-purple-700 hover:bg-gray-100 px-8 py-3 rounded-xl font-semibold transition-all">Browse All Freelance Jobs</a>
        </div>
    </div>
</section>

<!-- Top Freelancers -->
<section class="py-16 max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Top Freelancers</h2>
            <p class="text-gray-500 mt-1">Hire skilled professionals for your projects</p>
        </div>
        <a href="{{ route('freelancers.index') }}" class="text-green-600 font-medium">View all →</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($topFreelancers as $fl)
        <a href="{{ route('freelancers.show', $fl->id) }}" class="bg-white card-hover rounded-xl p-6 text-center shadow-sm border border-gray-100 block">
            <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
                {{ strtoupper(substr($fl->user->name, 0, 1)) }}
            </div>
            <h3 class="font-bold text-gray-800">{{ $fl->user->name }}</h3>
            <p class="text-green-600 text-sm">{{ $fl->title ?? $fl->category }}</p>
            <div class="flex justify-center items-center mt-2 text-yellow-500">
                @for($i = 0; $i < 5; $i++)
                <span class="text-sm">{{ $i < round($fl->rating) ? '★' : '☆' }}</span>
                @endfor
                <span class="text-gray-400 text-xs ml-1">({{ $fl->total_reviews }})</span>
            </div>
            <div class="mt-3 text-green-600 font-semibold">${{ $fl->hourly_rate }}/hr</div>
        </a>
        @endforeach
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Start Your Journey?</h2>
        <p class="text-green-100 mb-8 text-lg">Join thousands of professionals and companies already using Jobs.AF</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-white text-green-600 hover:bg-gray-100 px-8 py-3 rounded-xl font-semibold transition-all">Find a Job</a>
            <a href="{{ route('register') }}" class="border-2 border-white hover:bg-white hover:text-green-600 px-8 py-3 rounded-xl font-semibold transition-all">Post a Job</a>
        </div>
    </div>
</section>

@endsection
