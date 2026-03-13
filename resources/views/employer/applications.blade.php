@extends('layouts.app')
@section('title', 'Applications for ' . $job->title)
@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-600 text-white py-8">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-2xl font-bold">Applications: {{ $job->title }}</h1>
        <p class="text-blue-100">{{ $applications->total() }} total applications</p>
    </div>
</div>
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="space-y-6">
        @forelse($applications as $app)
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col md:flex-row justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($app->jobseeker->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">{{ $app->jobseeker->name }}</h3>
                            <p class="text-gray-400 text-sm">{{ $app->jobseeker->email }} · {{ $app->jobseeker->location }}</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <p class="text-sm text-gray-600 font-medium mb-1">Cover Letter:</p>
                        <p class="text-gray-600 text-sm">{{ Str::limit($app->cover_letter, 300) }}</p>
                    </div>
                    @if($app->resume)
                    <a href="{{ route('resume.view', $app->resume->id) }}" target="_blank" class="text-blue-600 hover:underline text-sm">📄 View Resume: {{ $app->resume->title }}</a>
                    @endif
                    <p class="text-gray-400 text-xs mt-2">Applied {{ $app->created_at->diffForHumans() }}</p>
                </div>
                <div class="mt-4 md:mt-0 md:ml-6">
                    <form action="{{ route('employer.applications.status', $app->id) }}" method="POST">
                        @csrf @method('PUT')
                        <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm mb-2 w-full outline-none" onchange="this.form.submit()">
                            <option value="pending" {{ $app->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="reviewed" {{ $app->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            <option value="shortlisted" {{ $app->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="rejected" {{ $app->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="hired" {{ $app->status === 'hired' ? 'selected' : '' }}>Hired</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16"><div class="text-6xl mb-4">📭</div><p class="text-gray-400">No applications yet for this position.</p></div>
        @endforelse
    </div>
    <div class="mt-6">{{ $applications->links() }}</div>
</div>
@endsection
