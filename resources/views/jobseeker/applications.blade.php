@extends('layouts.app')
@section('title', 'My Applications - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-8">
    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-2xl font-bold">My Applications</h1>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="space-y-4">
        @forelse($applications as $app)
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col md:flex-row justify-between items-start">
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-800">{{ $app->job->title }}</h3>
                    <p class="text-gray-500">{{ $app->job->employer->employerProfile->company_name ?? $app->job->employer->name }} · {{ $app->job->location }}</p>
                    <p class="text-gray-400 text-sm mt-1">Applied {{ $app->created_at->diffForHumans() }}</p>
                    @if($app->cover_letter)
                    <p class="text-gray-500 text-sm mt-2 italic">&quot;{{ Str::limit($app->cover_letter, 120) }}&quot;</p>
                    @endif
                </div>
                <div class="mt-4 md:mt-0 md:ml-6">
                    <span class="px-4 py-2 rounded-full text-sm font-medium
                        {{ $app->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $app->status === 'reviewed' ? 'bg-purple-100 text-purple-700' : '' }}
                        {{ $app->status === 'shortlisted' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $app->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $app->status === 'hired' ? 'bg-blue-100 text-blue-700' : '' }}">
                        {{ ucfirst($app->status) }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16">
            <div class="text-6xl mb-4">📋</div>
            <h3 class="text-xl text-gray-600">No applications yet</h3>
            <a href="{{ route('jobs.index') }}" class="mt-4 inline-block bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700">Browse Jobs</a>
        </div>
        @endforelse
    </div>
    <div class="mt-6">{{ $applications->links() }}</div>
</div>
@endsection
