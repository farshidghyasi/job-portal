@extends('layouts.app')
@section('title', 'My Proposals - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <h1 class="text-2xl font-bold">My Proposals</h1>
        <p class="text-up-muted mt-1">Track the status of all your submitted proposals</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    <div class="space-y-4">
        @forelse($proposals as $proposal)
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">

                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-bold text-up-dark">
                        <a href="{{ route('freelance.show', $proposal->freelance_job_id) }}"
                            class="hover:text-up-green transition-colors">
                            {{ $proposal->freelanceJob->title ?? 'N/A' }}
                        </a>
                    </h3>
                    <p class="text-up-text text-sm mt-1">
                        <i class="fas fa-building text-up-muted mr-1.5"></i>
                        {{ $proposal->freelanceJob->employer->employerProfile->company_name ?? ($proposal->freelanceJob->employer->name ?? 'Unknown Client') }}
                    </p>
                    <div class="flex flex-wrap gap-4 mt-3 text-sm text-up-text">
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-dollar-sign text-up-muted text-xs"></i>
                            Bid: <span class="font-bold text-up-dark ml-0.5">${{ number_format($proposal->bid_amount) }}</span>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-clock text-up-muted text-xs"></i>
                            Delivery: <span class="font-semibold text-up-dark ml-0.5">{{ $proposal->delivery_time }}</span>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-calendar-alt text-up-muted text-xs"></i>
                            {{ $proposal->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>

                <div class="flex-shrink-0">
                    <span class="px-4 py-1.5 rounded-pill text-sm font-semibold
                        {{ $proposal->status === 'pending'  ? 'bg-yellow-100 text-yellow-700'  : '' }}
                        {{ $proposal->status === 'accepted' ? 'bg-up-bg text-up-green'         : '' }}
                        {{ $proposal->status === 'rejected' ? 'bg-red-100 text-red-700'        : '' }}">
                        {{ ucfirst($proposal->status) }}
                    </span>
                </div>

            </div>
        </div>
        @empty
        <div class="bg-white border border-up-border rounded-2xl text-center py-20">
            <div class="w-20 h-20 bg-up-bg rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-file-alt text-up-muted text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-up-dark mb-2">No proposals yet</h3>
            <p class="text-up-text text-sm mb-6">You haven't submitted any proposals. Browse open projects and start bidding.</p>
            <a href="{{ route('freelance.index') }}" class="btn-primary px-8 py-3 text-sm font-semibold inline-block">
                <i class="fas fa-search mr-2"></i>Browse Projects
            </a>
        </div>
        @endforelse
    </div>

    @if($proposals->hasPages())
    <div class="mt-8">
        {{ $proposals->links() }}
    </div>
    @endif

</div>
@endsection
