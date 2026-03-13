@extends('layouts.app')
@section('title', 'Jobs.AF - Find Work & Talent in Afghanistan')
@section('content')

<!-- Hero Section -->
<section class="bg-up-dark text-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-20 md:py-28">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-extrabold leading-[1.1] tracking-tight">
                How work<br>should <span class="text-up-green">work</span>
            </h1>
            <p class="text-xl text-[#9aaa97] mt-6 max-w-xl leading-relaxed">
                Forget the old rules. You can find the best talent, the best jobs, and the best projects — all in Afghanistan.
            </p>

            <!-- Search Bar -->
            <div class="mt-10 flex flex-col sm:flex-row gap-3 max-w-2xl">
                <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 flex-1">
                    <div class="relative flex-1">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-up-muted"></i>
                        <input type="text" name="search" placeholder='Try "Software Engineer" or "Marketing"' class="w-full pl-11 pr-4 py-4 rounded-xl bg-white text-up-dark text-[15px] outline-none border-2 border-transparent focus:border-up-green transition-colors">
                    </div>
                    <button type="submit" class="btn-primary px-8 py-4 font-semibold text-[15px] whitespace-nowrap rounded-xl">Search Jobs</button>
                </form>
            </div>

            <!-- Quick Links -->
            <div class="mt-8 flex flex-wrap gap-2">
                <span class="text-up-muted text-sm mr-1">Popular:</span>
                <a href="{{ route('jobs.index') }}?category=Information+Technology" class="text-sm text-white/70 hover:text-up-green border border-white/20 hover:border-up-green px-4 py-1.5 rounded-pill transition-all">Tech</a>
                <a href="{{ route('jobs.index') }}?category=Healthcare" class="text-sm text-white/70 hover:text-up-green border border-white/20 hover:border-up-green px-4 py-1.5 rounded-pill transition-all">Healthcare</a>
                <a href="{{ route('jobs.index') }}?category=Engineering" class="text-sm text-white/70 hover:text-up-green border border-white/20 hover:border-up-green px-4 py-1.5 rounded-pill transition-all">Engineering</a>
                <a href="{{ route('jobs.index') }}?category=Education" class="text-sm text-white/70 hover:text-up-green border border-white/20 hover:border-up-green px-4 py-1.5 rounded-pill transition-all">Education</a>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By / Stats -->
<section class="bg-up-bg-light border-b border-up-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-3xl font-extrabold text-up-dark">{{ number_format($stats['total_jobs']) }}+</div>
                <div class="text-up-text text-sm mt-1 font-medium">Jobs Posted</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-up-dark">{{ number_format($stats['total_companies']) }}+</div>
                <div class="text-up-text text-sm mt-1 font-medium">Companies</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-up-dark">{{ number_format($stats['total_jobseekers']) }}+</div>
                <div class="text-up-text text-sm mt-1 font-medium">Job Seekers</div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-up-dark">{{ number_format($stats['total_freelancers']) }}+</div>
                <div class="text-up-text text-sm mt-1 font-medium">Freelancers</div>
            </div>
        </div>
    </div>
</section>

<!-- Browse by Category -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-up-dark">Browse talent by category</h2>
                <p class="text-up-text mt-2">Find jobs in your field of expertise</p>
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
                <h2 class="text-3xl font-bold">Browse projects</h2>
                <p class="text-up-muted mt-2">Find flexible freelance projects and remote work</p>
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
                <h2 class="text-3xl font-bold text-up-dark">Top rated talent</h2>
                <p class="text-up-text mt-2">Hire skilled professionals for your projects</p>
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
            <a href="{{ route('register') }}" class="btn-dark px-8 py-4 font-semibold text-base">Find Talent</a>
            <a href="{{ route('register') }}" class="bg-white text-up-dark hover:bg-up-bg px-8 py-4 rounded-pill font-semibold text-base transition-all">Find Work</a>
        </div>
    </div>
</section>

@endsection
