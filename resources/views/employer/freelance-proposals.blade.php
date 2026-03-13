@extends('layouts.app')
@section('title', 'Proposals for ' . $job->title . ' - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <a href="{{ route('employer.freelance.index') }}" class="inline-flex items-center gap-2 text-up-muted hover:text-white text-sm mb-3 transition-colors">
            <i class="fa-solid fa-arrow-left text-xs"></i> My Projects
        </a>
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white">{{ $job->title }}</h1>
                <p class="text-up-muted mt-1">
                    {{ $proposals->total() }} proposal{{ $proposals->total() !== 1 ? 's' : '' }} received
                </p>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-2xl px-5 py-3 flex-shrink-0">
                <p class="text-up-muted text-xs font-semibold uppercase tracking-wide mb-0.5">Budget</p>
                <p class="text-white font-bold text-lg">
                    ${{ number_format($job->budget_min) }}&ndash;${{ number_format($job->budget_max) }}{{ $job->budget_type === 'hourly' ? '/hr' : '' }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="bg-up-bg min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        @if(session('success'))
        <div class="bg-white border border-up-green/30 rounded-2xl p-4 mb-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-up-green/10 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-circle-check text-up-green"></i>
            </div>
            <p class="text-up-dark font-medium">{{ session('success') }}</p>
        </div>
        @endif

        <div class="bg-white border border-up-border rounded-2xl overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-up-border bg-up-bg-light">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Freelancer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Bid</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Delivery</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Cover Letter</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proposals as $proposal)
                    <tr class="border-b border-up-border last:border-0 hover:bg-up-bg-light transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-up-green rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                    {{ strtoupper(substr($proposal->freelancer->name, 0, 1)) }}
                                </div>
                                <div>
                                    @if($proposal->freelancer->freelancerProfile)
                                    <a href="{{ route('freelancers.show', $proposal->freelancer->id) }}"
                                        class="font-semibold text-up-dark hover:text-up-green hover:underline text-sm">
                                        {{ $proposal->freelancer->name }}
                                    </a>
                                    @else
                                    <span class="font-semibold text-up-dark text-sm">{{ $proposal->freelancer->name }}</span>
                                    @endif
                                    @if($proposal->freelancer->freelancerProfile && $proposal->freelancer->freelancerProfile->title)
                                    <div class="text-xs text-up-muted">{{ $proposal->freelancer->freelancerProfile->title }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-up-dark">${{ number_format($proposal->bid_amount) }}</span>
                            @if($job->budget_type === 'hourly')
                            <span class="text-up-muted text-xs">/hr</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-up-text">
                            {{ $proposal->delivery_time ?? '-' }}
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <p class="text-sm text-up-text truncate" title="{{ $proposal->cover_letter }}">
                                {{ Str::limit($proposal->cover_letter, 80) }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusMap = [
                                    'pending'  => ['bg-yellow-50 text-yellow-700', 'fa-clock'],
                                    'accepted' => ['bg-up-green/10 text-up-green', 'fa-check'],
                                    'rejected' => ['bg-red-50 text-red-600', 'fa-xmark'],
                                ];
                                $sVal = $proposal->status ?? 'pending';
                                [$sCls, $sIcon] = $statusMap[$sVal] ?? ['bg-up-light text-up-text', 'fa-circle'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $sCls }}">
                                <i class="fa-solid {{ $sIcon }} text-[10px]"></i>
                                {{ ucfirst($sVal) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-up-muted">
                            {{ $proposal->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="w-14 h-14 bg-up-bg rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fa-regular fa-file-lines text-up-muted text-2xl"></i>
                            </div>
                            <p class="text-up-text font-medium mb-1">No proposals yet</p>
                            <p class="text-up-muted text-sm">Proposals from freelancers will appear here once submitted.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($proposals->hasPages())
        <div class="mt-6">{{ $proposals->links() }}</div>
        @endif

        <div class="mt-6">
            <a href="{{ route('employer.freelance.index') }}" class="inline-flex items-center gap-2 text-up-green hover:text-up-green-hover text-sm font-medium hover:underline">
                <i class="fa-solid fa-arrow-left text-xs"></i> Back to My Projects
            </a>
        </div>

    </div>
</div>

@endsection
