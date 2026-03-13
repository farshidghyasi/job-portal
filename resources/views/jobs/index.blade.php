@extends('layouts.app')
@section('title', 'Browse Jobs - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Browse Jobs in Afghanistan</h1>
        <p class="text-green-100">{{ $jobs->total() }} jobs found</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:w-72 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-20">
                <h3 class="font-bold text-gray-800 mb-4">Filter Jobs</h3>
                <form action="{{ route('jobs.index') }}" method="GET">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keywords</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Job title..." class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Job Type</label>
                        <select name="type" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                            <option value="">All Types</option>
                            <option value="full-time" {{ request('type') === 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ request('type') === 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ request('type') === 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="internship" {{ request('type') === 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Experience Level</label>
                        <select name="experience" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                            <option value="">All Levels</option>
                            <option value="entry" {{ request('experience') === 'entry' ? 'selected' : '' }}>Entry Level</option>
                            <option value="mid" {{ request('experience') === 'mid' ? 'selected' : '' }}>Mid Level</option>
                            <option value="senior" {{ request('experience') === 'senior' ? 'selected' : '' }}>Senior Level</option>
                            <option value="executive" {{ request('experience') === 'executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" value="{{ request('location') }}" placeholder="Kabul, Herat..." class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 outline-none">
                    </div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg text-sm font-medium transition-all">Apply Filters</button>
                    <a href="{{ route('jobs.index') }}" class="block text-center text-gray-500 hover:text-gray-700 mt-2 text-sm">Clear Filters</a>
                </form>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="flex-1">
            @if($jobs->count() > 0)
                <div class="space-y-4">
                    @foreach($jobs as $job)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="flex-1">
                                <div class="flex flex-wrap gap-2 mb-2">
                                    @if($job->is_featured)<span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">⭐ Featured</span>@endif
                                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ $job->category }}</span>
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">{{ ucfirst($job->experience_level) }} Level</span>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 mb-1">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="hover:text-green-600">{{ $job->title }}</a>
                                </h2>
                                <p class="text-gray-500 mb-2">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }}</p>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400">
                                    <span>📍 {{ $job->location }}</span>
                                    <span>📅 Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}</span>
                                    <span>👁 {{ $job->views_count }} views</span>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-6 md:text-right flex-shrink-0">
                                <div class="text-green-600 font-bold text-lg">${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}</div>
                                <div class="text-gray-400 text-xs mb-3">per month</div>
                                <a href="{{ route('jobs.show', $job->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition-all">View & Apply</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-8">{{ $jobs->withQueryString()->links() }}</div>
            @else
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-xl font-semibold text-gray-600">No jobs found</h3>
                    <p class="text-gray-400 mt-2">Try adjusting your filters or search terms</p>
                    <a href="{{ route('jobs.index') }}" class="mt-4 inline-block text-green-600 hover:underline">Clear all filters</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
