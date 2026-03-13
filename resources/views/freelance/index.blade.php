@extends('layouts.app')
@section('title', 'Freelance Jobs - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-purple-700 to-indigo-700 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Freelance Jobs & Projects</h1>
        <p class="text-purple-200">{{ $jobs->total() }} projects available</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Filters -->
        <div class="lg:w-72 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-20">
                <h3 class="font-bold text-gray-800 mb-4">Filter Projects</h3>
                <form action="{{ route('freelance.index') }}" method="GET">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keywords</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="w-full border rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="category" class="w-full border rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Budget Type</label>
                        <select name="budget_type" class="w-full border rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Any</option>
                            <option value="fixed" {{ request('budget_type') === 'fixed' ? 'selected' : '' }}>Fixed Price</option>
                            <option value="hourly" {{ request('budget_type') === 'hourly' ? 'selected' : '' }}>Hourly Rate</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-lg text-sm">Apply Filters</button>
                    <a href="{{ route('freelance.index') }}" class="block text-center text-gray-500 text-sm mt-2 hover:text-gray-700">Clear Filters</a>
                </form>
            </div>
        </div>

        <!-- Listings -->
        <div class="flex-1">
            @forelse($jobs as $job)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-4 hover:shadow-md transition-all">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex flex-wrap gap-2">
                        @if($job->is_featured)<span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">⭐ Featured</span>@endif
                        <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full">{{ $job->category }}</span>
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ ucfirst($job->budget_type) }} Price</span>
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">{{ ucfirst($job->location_type) }}</span>
                    </div>
                    <div class="text-green-600 font-bold text-lg">${{ number_format($job->budget_min) }}-${{ number_format($job->budget_max) }}{{ $job->budget_type === 'hourly' ? '/hr' : '' }}</div>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    <a href="{{ route('freelance.show', $job->id) }}" class="hover:text-purple-600">{{ $job->title }}</a>
                </h2>
                <p class="text-gray-500 text-sm mb-3">{{ Str::limit($job->description, 150) }}</p>
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach(($job->skills_required ?? []) as $skill)
                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $skill }}</span>
                    @endforeach
                </div>
                <div class="flex justify-between items-center text-sm text-gray-400">
                    <span>⏱ Duration: {{ $job->duration ?? 'TBD' }} · Posted {{ $job->created_at->diffForHumans() }}</span>
                    <a href="{{ route('freelance.show', $job->id) }}" class="text-purple-600 hover:text-purple-700 font-medium">View Project →</a>
                </div>
            </div>
            @empty
            <div class="text-center py-16">
                <div class="text-6xl mb-4">💼</div>
                <h3 class="text-xl font-semibold text-gray-600">No projects found</h3>
                <a href="{{ route('freelance.index') }}" class="text-purple-600 hover:underline mt-2 block">Clear filters</a>
            </div>
            @endforelse
            <div class="mt-6">{{ $jobs->withQueryString()->links() }}</div>
        </div>
    </div>
</div>
@endsection
