@extends('layouts.app')
@section('title', $job->title . ' - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-purple-700 to-indigo-700 text-white py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex flex-wrap gap-2 mb-3">
            <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ $job->category }}</span>
            <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ ucfirst($job->budget_type) }} Price</span>
            <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ ucfirst($job->location_type) }}</span>
        </div>
        <h1 class="text-3xl font-bold mb-2">{{ $job->title }}</h1>
        <div class="flex flex-wrap gap-4 text-purple-200 text-sm">
            <span>💰 ${{ number_format($job->budget_min) }}-${{ number_format($job->budget_max) }}{{ $job->budget_type === 'hourly' ? '/hr' : '' }}</span>
            <span>⏱ {{ $job->duration ?? 'Flexible' }}</span>
            <span>📅 Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}</span>
            <span>📨 {{ $job->proposals->count() }} proposals</span>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-1">
            <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Project Description</h2>
                <p class="text-gray-600 leading-relaxed">{{ $job->description }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Required Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(($job->skills_required ?? []) as $skill)
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="lg:w-72">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-20 mb-6">
                <div class="text-center mb-4">
                    <div class="text-3xl font-bold text-green-600">${{ number_format($job->budget_min) }}-${{ number_format($job->budget_max) }}</div>
                    <div class="text-gray-400 text-sm">{{ $job->budget_type === 'hourly' ? 'Per Hour' : 'Fixed Price' }}</div>
                </div>
                @if($hasApplied)
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                    <p class="text-green-700 font-semibold">✅ Proposal Submitted</p>
                </div>
                @elseif(session('logged_in') && session('user_role') === 'freelancer')
                <a href="{{ route('freelance.apply', $job->id) }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 rounded-xl font-semibold transition-all">Submit Proposal</a>
                @elseif(!session('logged_in'))
                <a href="{{ route('login') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 rounded-xl font-semibold transition-all">Login to Apply</a>
                @endif

                <div class="mt-4 space-y-3 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Duration:</span><span class="font-medium">{{ $job->duration ?? 'Flexible' }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Location:</span><span class="font-medium">{{ ucfirst($job->location_type) }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Proposals:</span><span class="font-medium">{{ $job->proposals->count() }}</span></div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-3">About the Client</h3>
                <div class="text-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mx-auto mb-2">
                        {{ strtoupper(substr($job->employer->employerProfile->company_name ?? $job->employer->name, 0, 1)) }}
                    </div>
                    <h4 class="font-semibold">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }}</h4>
                    @if($job->employer->employerProfile)
                    <p class="text-gray-400 text-sm">{{ $job->employer->employerProfile->city }}, Afghanistan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
