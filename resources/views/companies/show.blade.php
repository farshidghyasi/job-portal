@extends('layouts.app')
@section('title', $profile->company_name . ' - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-12">
    <div class="max-w-5xl mx-auto px-4 flex items-center gap-6">
        <div class="w-24 h-24 bg-white/20 rounded-xl flex items-center justify-center text-4xl font-bold">
            {{ strtoupper(substr($profile->company_name, 0, 1)) }}
        </div>
        <div>
            <h1 class="text-3xl font-bold">{{ $profile->company_name }}</h1>
            <p class="text-green-100">{{ $profile->industry }} · {{ $profile->city }}, {{ $profile->country }}</p>
            <p class="text-green-200 text-sm mt-1">{{ $profile->company_size }} employees @if($profile->founded_year) · Founded {{ $profile->founded_year }} @endif</p>
        </div>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">About {{ $profile->company_name }}</h2>
                <p class="text-gray-600 leading-relaxed">{{ $profile->company_description ?? 'No description available.' }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Open Positions ({{ $jobs->count() }})</h2>
                <div class="space-y-4">
                    @forelse($jobs as $job)
                    <a href="{{ route('jobs.show', $job->id) }}" class="flex justify-between items-center p-4 border border-gray-100 rounded-xl hover:bg-green-50 transition-all">
                        <div>
                            <div class="font-semibold text-gray-800">{{ $job->title }}</div>
                            <div class="text-sm text-gray-400">{{ $job->location }} · {{ ucfirst(str_replace('-', ' ', $job->type)) }}</div>
                        </div>
                        <div class="text-green-600 font-semibold">${{ number_format($job->salary_min) }}/mo</div>
                    </a>
                    @empty
                    <p class="text-gray-400">No open positions at this time.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4">Company Details</h3>
                <div class="space-y-3 text-sm">
                    @if($profile->website)<div><span class="text-gray-500">Website:</span><br><a href="{{ $profile->website }}" target="_blank" class="text-green-600 hover:underline">{{ $profile->website }}</a></div>@endif
                    @if($profile->phone)<div><span class="text-gray-500">Phone:</span><br><span class="text-gray-800">{{ $profile->phone }}</span></div>@endif
                    @if($profile->address)<div><span class="text-gray-500">Address:</span><br><span class="text-gray-800">{{ $profile->address }}</span></div>@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
