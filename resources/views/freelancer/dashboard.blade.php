@extends('layouts.app')
@section('title', 'Freelancer Dashboard - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h1 class="text-2xl font-bold">Welcome back, {{ session('user_name') }}!</h1>
        <p class="text-up-muted mt-1">Manage your proposals and freelance profile</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

    {{-- Incomplete Profile Banner --}}
    @if(!$profile)
    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4 mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-triangle-exclamation text-yellow-500"></i>
            </div>
            <p class="text-yellow-800 font-medium text-sm">
                Your freelancer profile is incomplete. Complete it to attract more clients.
            </p>
        </div>
        <a href="{{ route('freelancer.profile') }}"
            class="flex-shrink-0 bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-pill text-sm font-semibold transition-all">
            Complete Profile
        </a>
    </div>
    @endif

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="text-3xl font-bold text-up-dark">{{ $stats['total_proposals'] }}</div>
            <div class="text-up-text text-sm mt-1 font-medium">Total Proposals</div>
        </div>
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="text-3xl font-bold text-up-green">{{ $stats['accepted'] }}</div>
            <div class="text-up-text text-sm mt-1 font-medium">Accepted</div>
        </div>
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="text-3xl font-bold text-yellow-500">{{ $stats['pending'] }}</div>
            <div class="text-up-text text-sm mt-1 font-medium">Pending</div>
        </div>
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            @if($stats['rating'] > 0)
            <div class="text-3xl font-bold text-up-dark flex items-center gap-2">
                {{ number_format($stats['rating'], 1) }}
                <i class="fas fa-star text-yellow-400 text-2xl"></i>
            </div>
            @else
            <div class="text-3xl font-bold text-up-muted">&ndash;&ndash;</div>
            @endif
            <div class="text-up-text text-sm mt-1 font-medium">Rating</div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <a href="{{ route('freelance.index') }}" class="bg-white border border-up-border rounded-2xl p-5 text-center card-hover group">
            <div class="w-12 h-12 bg-up-bg rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-up-green/10 transition-colors">
                <i class="fas fa-magnifying-glass text-up-green text-lg"></i>
            </div>
            <div class="text-sm font-semibold text-up-dark">Browse Projects</div>
        </a>
        <a href="{{ route('freelancer.proposals') }}" class="bg-white border border-up-border rounded-2xl p-5 text-center card-hover group">
            <div class="w-12 h-12 bg-up-bg rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-up-green/10 transition-colors">
                <i class="fas fa-file-alt text-up-green text-lg"></i>
            </div>
            <div class="text-sm font-semibold text-up-dark">My Proposals</div>
        </a>
        <a href="{{ route('freelancer.profile') }}" class="bg-white border border-up-border rounded-2xl p-5 text-center card-hover group">
            <div class="w-12 h-12 bg-up-bg rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-up-green/10 transition-colors">
                <i class="fas fa-user-pen text-up-green text-lg"></i>
            </div>
            <div class="text-sm font-semibold text-up-dark">Edit Profile</div>
        </a>
    </div>

    {{-- Recent Proposals --}}
    <div class="bg-white border border-up-border rounded-2xl p-6">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-lg font-bold text-up-dark">Recent Proposals</h2>
            <a href="{{ route('freelancer.proposals') }}" class="text-up-green text-sm font-medium hover:text-up-green-hover transition-colors">
                View all <i class="fas fa-arrow-right ml-1 text-xs"></i>
            </a>
        </div>

        @forelse($proposals as $proposal)
        <div class="border-b border-up-border py-4 last:border-0 last:pb-0 first:pt-0">
            <div class="flex flex-col md:flex-row justify-between items-start gap-3">
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-up-dark">
                        <a href="{{ route('freelance.show', $proposal->freelance_job_id) }}"
                            class="hover:text-up-green transition-colors">
                            {{ $proposal->freelanceJob->title ?? 'N/A' }}
                        </a>
                    </h3>
                    <p class="text-up-text text-sm mt-0.5">
                        {{ $proposal->freelanceJob->employer->employerProfile->company_name ?? ($proposal->freelanceJob->employer->name ?? 'Unknown Client') }}
                    </p>
                    <p class="text-up-muted text-xs mt-1">{{ $proposal->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0">
                    <span class="text-up-dark font-bold text-sm">${{ number_format($proposal->bid_amount) }}</span>
                    <span class="px-3 py-1 text-xs rounded-pill font-semibold
                        {{ $proposal->status === 'pending'  ? 'bg-yellow-100 text-yellow-700'  : '' }}
                        {{ $proposal->status === 'accepted' ? 'bg-up-bg text-up-green'         : '' }}
                        {{ $proposal->status === 'rejected' ? 'bg-red-100 text-red-700'        : '' }}">
                        {{ ucfirst($proposal->status) }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-up-bg rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-inbox text-up-muted text-2xl"></i>
            </div>
            <p class="text-up-text text-sm">No proposals yet.</p>
            <a href="{{ route('freelance.index') }}" class="text-up-green text-sm font-medium hover:underline mt-2 inline-block">
                Browse available projects &rarr;
            </a>
        </div>
        @endforelse
    </div>

</div>
@endsection
