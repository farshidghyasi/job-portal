@extends('layouts.app')
@section('title', $profile->user->name . ' - Freelancer Profile')
@section('content')
<div class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white py-12">
    <div class="max-w-5xl mx-auto px-4 flex items-center gap-6">
        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center text-4xl font-bold">
            {{ strtoupper(substr($profile->user->name, 0, 1)) }}
        </div>
        <div>
            <h1 class="text-3xl font-bold">{{ $profile->user->name }}</h1>
            <p class="text-indigo-200 text-lg">{{ $profile->title ?? $profile->category }}</p>
            <div class="flex items-center mt-2 text-yellow-400">
                @for($i = 0; $i < 5; $i++)
                <span>{{ $i < round($profile->rating) ? '★' : '☆' }}</span>
                @endfor
                <span class="text-indigo-200 text-sm ml-2">({{ $profile->total_reviews }} reviews)</span>
            </div>
        </div>
        <div class="ml-auto text-right">
            <div class="text-3xl font-bold">${{ $profile->hourly_rate }}/hr</div>
            <div class="text-indigo-200">{{ ucfirst($profile->availability) }}</div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-1">
            <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">About Me</h2>
                <p class="text-gray-600 leading-relaxed">{{ $profile->bio ?? 'No bio provided.' }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(($profile->skills ?? []) as $skill)
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="lg:w-72">
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="font-bold text-gray-800 mb-4">Details</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Category:</span><span class="font-medium">{{ $profile->category }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Experience:</span><span class="font-medium">{{ $profile->experience_years }} years</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Location:</span><span class="font-medium">{{ $profile->user->location }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Rate:</span><span class="font-medium text-green-600">${{ $profile->hourly_rate }}/hr</span></div>
                </div>
                @if(session('logged_in') && session('user_role') === 'employer')
                <a href="{{ route('employer.freelance.create') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 rounded-xl font-semibold mt-4 transition-all">Post a Project</a>
                @elseif(!session('logged_in'))
                <a href="{{ route('register') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-3 rounded-xl font-semibold mt-4 transition-all">Hire This Freelancer</a>
                @endif
                @if($profile->portfolio_url)
                <a href="{{ $profile->portfolio_url }}" target="_blank" class="block w-full border border-purple-600 text-purple-600 text-center py-2 rounded-xl mt-2 text-sm hover:bg-purple-50">View Portfolio</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
