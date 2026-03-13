@extends('layouts.app')
@section('title', 'Freelance Jobs - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-1">Freelance Jobs & Projects</h1>
        <p class="text-up-muted">{{ $jobs->total() }} projects available</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Sidebar Filters --}}
        <div class="lg:w-72 flex-shrink-0">
            <div class="bg-white border border-up-border rounded-2xl p-6 sticky top-20">
                <h3 class="font-bold text-up-dark mb-5 text-base">Filter Projects</h3>
                <form action="{{ route('freelance.index') }}" method="GET">

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-up-dark mb-2">Keywords</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm"
                               placeholder="Search projects...">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-up-dark mb-2">Category</label>
                        <select name="category"
                                class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm bg-white">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-up-dark mb-2">Budget Type</label>
                        <select name="budget_type"
                                class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 text-sm bg-white">
                            <option value="">Any</option>
                            <option value="fixed" {{ request('budget_type') === 'fixed' ? 'selected' : '' }}>Fixed Price</option>
                            <option value="hourly" {{ request('budget_type') === 'hourly' ? 'selected' : '' }}>Hourly Rate</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-primary w-full py-3 text-sm font-semibold">Apply Filters</button>
                    <a href="{{ route('freelance.index') }}"
                       class="block text-center text-up-muted text-sm mt-3 hover:text-up-green transition-colors">Clear Filters</a>
                </form>
            </div>
        </div>

        {{-- Listings --}}
        <div class="flex-1">
            @forelse($jobs as $job)
            <div class="bg-white border border-up-border rounded-2xl p-6 mb-4 card-hover transition-all">
                <div class="flex flex-wrap justify-between items-start gap-3 mb-3">
                    <div class="flex flex-wrap gap-2">
                        @if($job->is_featured)
                        <span class="bg-yellow-50 text-yellow-700 border border-yellow-200 text-xs px-3 py-1 rounded-pill font-medium">Featured</span>
                        @endif
                        <span class="bg-up-light text-up-text text-xs px-3 py-1 rounded-pill">{{ $job->category }}</span>
                        <span class="bg-up-light text-up-text text-xs px-3 py-1 rounded-pill">{{ ucfirst($job->budget_type) }} Price</span>
                        <span class="bg-up-light text-up-text text-xs px-3 py-1 rounded-pill">{{ ucfirst($job->location_type) }}</span>
                    </div>
                    <div class="text-up-dark font-bold text-lg">
                        ${{ number_format($job->budget_min) }}&ndash;${{ number_format($job->budget_max) }}{{ $job->budget_type === 'hourly' ? '/hr' : '' }}
                    </div>
                </div>

                <h2 class="text-xl font-bold text-up-dark mb-2">
                    <a href="{{ route('freelance.show', $job->id) }}" class="hover:text-up-green transition-colors">{{ $job->title }}</a>
                </h2>
                <p class="text-up-text text-sm mb-3 leading-relaxed">{{ Str::limit($job->description, 150) }}</p>

                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach(($job->skills_required ?? []) as $skill)
                    <span class="bg-up-light text-up-text text-xs px-3 py-1 rounded-pill">{{ $skill }}</span>
                    @endforeach
                </div>

                <div class="border-t border-up-border pt-4 flex justify-between items-center text-sm">
                    <span class="text-up-muted">Duration: {{ $job->duration ?? 'TBD' }} &middot; Posted {{ $job->created_at->diffForHumans() }}</span>
                    <a href="{{ route('freelance.show', $job->id) }}" class="text-up-green hover:text-up-green-hover font-semibold transition-colors">
                        View Project &rarr;
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white border border-up-border rounded-2xl p-16 text-center">
                <div class="w-16 h-16 bg-up-light rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-up-muted text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-up-dark mb-2">No projects found</h3>
                <p class="text-up-text mb-5">Try adjusting your filters to see more results.</p>
                <a href="{{ route('freelance.index') }}" class="btn-outline px-6 py-2.5 text-sm">Clear Filters</a>
            </div>
            @endforelse

            <div class="mt-6">{{ $jobs->withQueryString()->links() }}</div>
        </div>
    </div>
</div>
@endsection
