@extends('layouts.app')
@section('title', 'Jobs.AF - Find Work & Talent in Afghanistan')
@section('content')

<!-- Hero Section -->
<section class="relative min-h-[600px] flex items-center overflow-hidden">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero.jpg') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-24 md:py-32 w-full">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-[1.1] tracking-tight max-w-3xl">
            Find your next job or hire top talent in <span class="text-up-green">Afghanistan</span>
        </h1>

        <!-- Tab Buttons + Search -->
        <div class="mt-10 max-w-2xl">
            <div class="bg-up-dark/80 backdrop-blur-md rounded-2xl p-5 border border-white/10">
                <!-- Find Talent / Browse Jobs Tabs -->
                <div class="flex mb-4">
                    <a href="{{ route('jobs.index') }}" class="flex-1 text-center py-2.5 rounded-pill border border-white/30 text-white font-semibold text-sm hover:bg-white/10 transition-all">Find Job</a>
                    <a href="{{ route('freelancers.index') }}" class="flex-1 text-center py-2.5 rounded-pill text-white/60 font-semibold text-sm hover:text-white transition-all">Hire Talents</a>
                </div>

                <!-- Search Bar -->
                <form action="{{ route('jobs.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="Search jobs by title, skill, or company" class="flex-1 px-4 py-3 rounded-xl bg-white text-up-dark text-sm outline-none border-2 border-transparent focus:border-up-green transition-colors">
                    <button type="submit" class="bg-up-dark text-white hover:bg-up-green px-6 py-3 rounded-xl font-semibold text-sm flex items-center gap-2 transition-colors whitespace-nowrap">
                        <i class="fas fa-search text-xs"></i> Search
                    </button>
                </form>

                <!-- Trusted By -->
                <div class="mt-4 flex items-center justify-between px-1">
                    <span class="text-white/30 text-xs font-medium tracking-wider uppercase">Trusted by</span>
                    <div class="flex items-center gap-6">
                        <span class="text-white/30 text-xs font-bold tracking-wide">ROSHAN</span>
                        <span class="text-white/30 text-xs font-bold tracking-wide">NETLINKS</span>
                        <span class="text-white/30 text-xs font-bold tracking-wide">AWCC</span>
                        <span class="text-white/30 text-xs font-bold tracking-wide hidden sm:inline">ETISALAT</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Browse by Category -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-up-dark">Browse jobs by category</h2>
                <p class="text-up-text mt-2">Explore opportunities in your field of expertise</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="hidden md:inline-flex items-center text-up-green hover:text-up-green-hover font-medium text-[15px] group">
                All categories <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($categories as $cat)
            <a href="{{ route('jobs.index') }}?category={{ urlencode($cat['name']) }}" class="bg-white card-hover rounded-2xl p-6 border border-up-border group">
                <div class="text-4xl mb-4">{{ $cat['icon'] }}</div>
                <div class="font-semibold text-up-dark group-hover:text-up-green transition-colors">{{ $cat['name'] }}</div>
                <div class="text-up-green text-sm font-medium mt-1">{{ $cat['count'] }} jobs available</div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Jobs -->
@if($featuredJobs->count() > 0)
<section class="bg-up-bg-light py-20 border-y border-up-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-up-dark">Featured jobs</h2>
                <p class="text-up-text mt-2">Top opportunities from leading employers</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="hidden md:inline-flex items-center text-up-green hover:text-up-green-hover font-medium text-[15px] group">
                View all <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($featuredJobs as $job)
            <a href="{{ route('jobs.show', $job->id) }}" class="bg-white card-hover rounded-2xl p-6 border border-up-border block">
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-up-green/10 text-up-green text-xs px-3 py-1 rounded-pill font-semibold">Featured</span>
                    <span class="text-up-muted text-xs">{{ $job->created_at->diffForHumans() }}</span>
                </div>
                <h3 class="font-bold text-up-dark text-lg mb-1 line-clamp-1">{{ $job->title }}</h3>
                <p class="text-up-text text-sm mb-3">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }}</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-up-light text-up-text text-xs px-2.5 py-1 rounded-md font-medium">{{ ucfirst($job->type) }}</span>
                    <span class="bg-up-light text-up-text text-xs px-2.5 py-1 rounded-md font-medium">{{ $job->location }}</span>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-up-border">
                    <span class="font-bold text-up-dark">${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}<span class="text-up-muted text-xs font-normal">/mo</span></span>
                    <span class="text-up-green text-sm font-semibold">Apply &rarr;</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Jobs -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-up-dark">Latest jobs</h2>
                <p class="text-up-text mt-2">Recently posted opportunities</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="hidden md:inline-flex items-center text-up-green hover:text-up-green-hover font-medium text-[15px] group">
                Browse all <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="space-y-4">
            @foreach($latestJobs as $job)
            <a href="{{ route('jobs.show', $job->id) }}" class="bg-white card-hover rounded-2xl p-6 border border-up-border flex flex-col md:flex-row md:items-center justify-between block">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap gap-2 mb-2">
                        <span class="bg-up-green/10 text-up-green text-xs px-2.5 py-1 rounded-md font-semibold">{{ $job->category }}</span>
                        <span class="bg-up-light text-up-text text-xs px-2.5 py-1 rounded-md font-medium">{{ ucfirst($job->type) }}</span>
                    </div>
                    <h3 class="font-bold text-up-dark text-lg truncate">{{ $job->title }}</h3>
                    <p class="text-up-text text-sm mt-1">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }} &middot; {{ $job->location }}</p>
                </div>
                <div class="mt-3 md:mt-0 md:ml-6 md:text-right flex-shrink-0">
                    <div class="font-bold text-up-dark text-lg">${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}<span class="text-up-muted text-xs font-normal">/mo</span></div>
                    <div class="text-up-muted text-xs mt-1">{{ $job->created_at->diffForHumans() }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Freelance Section -->
<section class="bg-up-dark text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold">Browse freelance projects</h2>
                <p class="text-up-muted mt-2">Browse freelance projects or hire talent for your next project</p>
            </div>
            <a href="{{ route('freelance.index') }}" class="hidden md:inline-flex items-center text-up-green hover:text-up-green-hover font-medium text-[15px] group">
                All projects <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-10">
            @foreach($featuredFreelance as $job)
            <a href="{{ route('freelance.show', $job->id) }}" class="bg-white/5 hover:bg-white/10 rounded-2xl p-6 block transition-all border border-white/10 hover:border-up-green/50">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-white/10 text-white text-xs px-3 py-1 rounded-md font-medium">{{ $job->category }}</span>
                    <span class="text-up-green font-bold">${{ number_format($job->budget_min) }}-${{ number_format($job->budget_max) }}{{ $job->budget_type === 'hourly' ? '/hr' : '' }}</span>
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $job->title }}</h3>
                <p class="text-[#9aaa97] text-sm leading-relaxed">{{ Str::limit($job->description, 100) }}</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach(($job->skills_required ?? []) as $skill)
                    <span class="bg-white/10 text-xs px-3 py-1 rounded-pill text-white/70">{{ $skill }}</span>
                    @endforeach
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('freelance.index') }}" class="btn-primary px-8 py-3.5 font-semibold text-[15px] inline-block">Browse All Projects</a>
        </div>
    </div>
</section>

<!-- Top Freelancers -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-up-dark">Top freelancers</h2>
                <p class="text-up-text mt-2">Skilled professionals available for hire</p>
            </div>
            <a href="{{ route('freelancers.index') }}" class="hidden md:inline-flex items-center text-up-green hover:text-up-green-hover font-medium text-[15px] group">
                View all <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($topFreelancers as $fl)
            <a href="{{ route('freelancers.show', $fl->id) }}" class="bg-white card-hover rounded-2xl p-6 border border-up-border text-center block">
                <div class="w-16 h-16 bg-up-dark rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">
                    {{ strtoupper(substr($fl->user->name, 0, 1)) }}
                </div>
                <h3 class="font-bold text-up-dark">{{ $fl->user->name }}</h3>
                <p class="text-up-green text-sm font-medium mt-1">{{ $fl->title ?? $fl->category }}</p>
                <div class="flex justify-center items-center mt-2">
                    <span class="text-up-green font-bold text-sm">{{ number_format($fl->rating, 1) }}</span>
                    <span class="text-yellow-400 ml-1">&#9733;</span>
                    <span class="text-up-muted text-xs ml-1">({{ $fl->total_reviews }})</span>
                </div>
                <div class="mt-3 font-bold text-up-dark">${{ $fl->hourly_rate }}<span class="text-up-muted text-xs font-normal">/hr</span></div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-up-green py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4 leading-tight">Ready to get started?</h2>
        <p class="text-white/80 text-lg mb-10 max-w-2xl mx-auto">Join thousands of professionals and companies already using Jobs.AF to connect, collaborate, and grow.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register') }}" class="btn-dark px-8 py-4 font-semibold text-base">Post a Job</a>
            <a href="{{ route('jobs.index') }}" class="bg-white text-up-dark hover:bg-up-bg px-8 py-4 rounded-pill font-semibold text-base transition-all">Find Job</a>
        </div>
    </div>
</section>

@endsection
