@extends('layouts.app')
@section('title', 'Browse Jobs - Jobs.AF')
@section('content')

{{-- Page header --}}
<div class="bg-up-dark text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h1 class="text-3xl font-bold mb-1">Browse Jobs in Afghanistan</h1>
        <p class="text-up-muted text-[15px]">
            <span class="text-up-green font-semibold">{{ $jobs->total() }}</span> jobs found
            @if(request()->hasAny(['search','category','type','experience','work_arrangement','gender','location']))
                &mdash; filtered results
            @endif
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ── Sidebar Filters ── --}}
        <aside class="lg:w-72 flex-shrink-0">
            <div class="bg-white border border-up-border rounded-2xl p-6 sticky top-[88px]">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-bold text-up-dark text-[15px]">Filters</h3>
                    <a href="{{ route('jobs.index') }}" class="text-up-text hover:text-up-green text-xs font-medium">Clear all</a>
                </div>

                <form action="{{ route('jobs.index') }}" method="GET" id="filter-form">

                    {{-- Keywords --}}
                    <div class="mb-5">
                        <label class="block text-up-dark text-xs font-semibold uppercase tracking-wide mb-2">Keywords</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-up-muted text-sm pointer-events-none">
                                <i class="fas fa-search"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Job title or skill…"
                                class="w-full border border-up-border rounded-xl pl-9 pr-3 py-2.5 text-sm text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition"
                            >
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="mb-5">
                        <label class="block text-up-dark text-xs font-semibold uppercase tracking-wide mb-2">Category</label>
                        <select name="category" class="w-full border border-up-border rounded-xl px-3 py-2.5 text-sm text-up-dark focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition bg-white">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Job Type --}}
                    <div class="mb-5">
                        <label class="block text-up-dark text-xs font-semibold uppercase tracking-wide mb-2">Job Type</label>
                        <select name="type" class="w-full border border-up-border rounded-xl px-3 py-2.5 text-sm text-up-dark focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition bg-white">
                            <option value="">All Types</option>
                            <option value="full-time"  {{ request('type') === 'full-time'  ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time"  {{ request('type') === 'part-time'  ? 'selected' : '' }}>Part Time</option>
                            <option value="contract"   {{ request('type') === 'contract'   ? 'selected' : '' }}>Contract</option>
                            <option value="internship" {{ request('type') === 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>

                    {{-- Experience Level --}}
                    <div class="mb-5">
                        <label class="block text-up-dark text-xs font-semibold uppercase tracking-wide mb-2">Experience Level</label>
                        <select name="experience" class="w-full border border-up-border rounded-xl px-3 py-2.5 text-sm text-up-dark focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition bg-white">
                            <option value="">All Levels</option>
                            <option value="entry"     {{ request('experience') === 'entry'     ? 'selected' : '' }}>Entry Level</option>
                            <option value="mid"       {{ request('experience') === 'mid'       ? 'selected' : '' }}>Mid Level</option>
                            <option value="senior"    {{ request('experience') === 'senior'    ? 'selected' : '' }}>Senior Level</option>
                            <option value="executive" {{ request('experience') === 'executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                    </div>

                    {{-- Work Arrangement --}}
                    <div class="mb-5">
                        <label class="block text-up-dark text-xs font-semibold uppercase tracking-wide mb-2">Work Arrangement</label>
                        <select name="work_arrangement" class="w-full border border-up-border rounded-xl px-3 py-2.5 text-sm text-up-dark focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition bg-white">
                            <option value="">All Arrangements</option>
                            <option value="onsite" {{ request('work_arrangement') === 'onsite'  ? 'selected' : '' }}>On-site</option>
                            <option value="remote" {{ request('work_arrangement') === 'remote'  ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ request('work_arrangement') === 'hybrid'  ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    {{-- Gender --}}
                    <div class="mb-5">
                        <label class="block text-up-dark text-xs font-semibold uppercase tracking-wide mb-2">Gender</label>
                        <select name="gender" class="w-full border border-up-border rounded-xl px-3 py-2.5 text-sm text-up-dark focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition bg-white">
                            <option value="">Any Gender</option>
                            <option value="male"   {{ request('gender') === 'male'   ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ request('gender') === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    {{-- Location --}}
                    <div class="mb-6">
                        <label class="block text-up-dark text-xs font-semibold uppercase tracking-wide mb-2">Location</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-up-muted text-sm pointer-events-none">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input
                                type="text"
                                name="location"
                                value="{{ request('location') }}"
                                placeholder="Kabul, Herat…"
                                class="w-full border border-up-border rounded-xl pl-9 pr-3 py-2.5 text-sm text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition"
                            >
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full py-2.5 text-sm font-semibold">
                        Apply Filters
                    </button>
                </form>
            </div>
        </aside>

        {{-- ── Job Listings ── --}}
        <div class="flex-1 min-w-0">

            @if($jobs->count() > 0)

                <div class="space-y-4">
                    @foreach($jobs as $job)
                    <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
                        <div class="flex flex-col md:flex-row md:items-start gap-4">

                            {{-- Company avatar --}}
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-xl bg-up-dark flex items-center justify-center text-white font-bold text-lg">
                                    {{ strtoupper(substr($job->employer->employerProfile->company_name ?? $job->employer->name, 0, 1)) }}
                                </div>
                            </div>

                            {{-- Job info --}}
                            <div class="flex-1 min-w-0">
                                {{-- Badges row --}}
                                <div class="flex flex-wrap gap-1.5 mb-2">
                                    @if($job->is_featured)
                                        <span class="bg-yellow-100 text-yellow-700 text-[11px] font-semibold px-2.5 py-0.5 rounded-pill">
                                            <i class="fas fa-star text-[10px] mr-0.5"></i> Featured
                                        </span>
                                    @endif
                                    <span class="bg-up-green/10 text-up-green text-[11px] font-medium px-2.5 py-0.5 rounded-pill">{{ $job->category }}</span>
                                    <span class="bg-up-light text-up-text text-[11px] font-medium px-2.5 py-0.5 rounded-pill">{{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
                                    <span class="bg-up-light text-up-text text-[11px] font-medium px-2.5 py-0.5 rounded-pill">{{ ucfirst($job->work_arrangement ?? 'onsite') }}</span>
                                    <span class="bg-up-light text-up-text text-[11px] font-medium px-2.5 py-0.5 rounded-pill">{{ ucfirst($job->experience_level) }}</span>
                                    @if($job->gender_preference && $job->gender_preference !== 'any')
                                        <span class="bg-purple-50 text-purple-600 text-[11px] font-medium px-2.5 py-0.5 rounded-pill">{{ ucfirst($job->gender_preference) }}</span>
                                    @endif
                                    @if($job->num_vacancies && $job->num_vacancies > 1)
                                        <span class="bg-sky-50 text-sky-600 text-[11px] font-medium px-2.5 py-0.5 rounded-pill">{{ $job->num_vacancies }} Vacancies</span>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h2 class="text-[17px] font-bold text-up-dark mb-0.5 leading-snug">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="hover:text-up-green transition-colors">{{ $job->title }}</a>
                                </h2>

                                {{-- Company name --}}
                                <p class="text-up-text text-sm font-medium mb-2">
                                    {{ $job->employer->employerProfile->company_name ?? $job->employer->name }}
                                </p>

                                {{-- Meta row --}}
                                <div class="flex flex-wrap items-center gap-3 text-up-muted text-xs">
                                    @if($job->country || $job->province || $job->location)
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-map-marker-alt text-[10px]"></i>
                                        {{ implode(', ', array_filter([$job->country, $job->province, $job->location])) }}
                                    </span>
                                    @endif
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock text-[10px]"></i>
                                        Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-eye text-[10px]"></i>
                                        {{ $job->views_count }} views
                                    </span>
                                </div>
                            </div>

                            {{-- Salary + CTA --}}
                            <div class="flex flex-col items-start md:items-end gap-2 flex-shrink-0">
                                <div class="text-right">
                                    <div class="text-up-dark font-bold text-[17px]">
                                        {{ $job->salary_currency ?? 'USD' }} {{ number_format($job->salary_min) }}&ndash;{{ number_format($job->salary_max) }}
                                    </div>
                                    <div class="text-up-muted text-xs">/ month</div>
                                </div>
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn-primary px-5 py-2 text-sm font-semibold whitespace-nowrap">
                                    View &amp; Apply
                                </a>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $jobs->withQueryString()->links() }}
                </div>

            @else
                {{-- Empty state --}}
                <div class="bg-white border border-up-border rounded-2xl p-16 text-center">
                    <div class="w-16 h-16 bg-up-light rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-up-muted text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-up-dark mb-2">No jobs found</h3>
                    <p class="text-up-text text-sm mb-6">Try adjusting your filters or broadening your search terms.</p>
                    <a href="{{ route('jobs.index') }}" class="btn-outline px-6 py-2.5 text-sm font-semibold inline-block">
                        Clear all filters
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
