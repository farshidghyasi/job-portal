@extends('layouts.app')
@section('title', $profile->company_name . ' - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-12">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
            {{-- Logo --}}
            <div class="w-24 h-24 bg-white/10 border-2 border-white/20 rounded-xl flex items-center justify-center text-4xl font-bold flex-shrink-0">
                {{ strtoupper(substr($profile->company_name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-3xl font-bold mb-1">{{ $profile->company_name }}</h1>
                <p class="text-up-muted">{{ $profile->industry }} &middot; {{ $profile->city }}, {{ $profile->country }}</p>
                <p class="text-up-muted text-sm mt-1">
                    {{ $profile->company_size }} employees
                    @if($profile->founded_year)&middot; Founded {{ $profile->founded_year }}@endif
                </p>
            </div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main Content --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-up-border rounded-2xl p-8 mb-6">
                <h2 class="text-xl font-bold text-up-dark mb-4">About {{ $profile->company_name }}</h2>
                <p class="text-up-text leading-relaxed">{{ $profile->company_description ?? 'No description available.' }}</p>
            </div>

            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-xl font-bold text-up-dark mb-6">Open Positions ({{ $jobs->count() }})</h2>
                <div class="space-y-3">
                    @forelse($jobs as $job)
                    <a href="{{ route('jobs.show', $job->id) }}"
                       class="flex justify-between items-center p-4 border border-up-border rounded-xl hover:border-up-green hover:bg-up-bg transition-all group">
                        <div>
                            <div class="font-semibold text-up-dark group-hover:text-up-green transition-colors">{{ $job->title }}</div>
                            <div class="text-sm text-up-muted mt-0.5">{{ $job->location }} &middot; {{ ucfirst(str_replace('-', ' ', $job->type)) }}</div>
                        </div>
                        <div class="text-up-dark font-semibold text-sm">${{ number_format($job->salary_min) }}/mo</div>
                    </a>
                    @empty
                    <p class="text-up-muted text-sm text-center py-6">No open positions at this time.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <h3 class="font-bold text-up-dark mb-4">Company Details</h3>
                <div class="space-y-4 text-sm">
                    @if($profile->website)
                    <div>
                        <span class="text-up-muted block mb-0.5">Website</span>
                        <a href="{{ $profile->website }}" target="_blank" class="text-up-green hover:text-up-green-hover break-all transition-colors">{{ $profile->website }}</a>
                    </div>
                    @endif
                    @if($profile->phone)
                    <div>
                        <span class="text-up-muted block mb-0.5">Phone</span>
                        <span class="text-up-dark font-medium">{{ $profile->phone }}</span>
                    </div>
                    @endif
                    @if($profile->address)
                    <div>
                        <span class="text-up-muted block mb-0.5">Address</span>
                        <span class="text-up-dark font-medium">{{ $profile->address }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
