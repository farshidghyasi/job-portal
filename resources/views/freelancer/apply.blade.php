@extends('layouts.app')
@section('title', 'Submit Proposal - ' . $job->title . ' - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <a href="{{ route('freelance.show', $job->id) }}"
            class="inline-flex items-center gap-2 text-up-muted hover:text-white text-sm mb-4 transition-colors">
            <i class="fas fa-arrow-left text-xs"></i> Back to project
        </a>
        <h1 class="text-2xl font-bold">Submit a Proposal</h1>
        <p class="text-up-muted mt-1">{{ $job->title }}</p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">

    {{-- Project Overview Card --}}
    <div class="bg-white border border-up-border rounded-2xl p-6 mb-6 border-l-4 border-l-up-green">
        <h2 class="text-base font-bold text-up-dark mb-4">Project Overview</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <p class="text-up-muted text-xs font-medium uppercase tracking-wide mb-1">Project</p>
                <p class="font-semibold text-up-dark text-sm">{{ $job->title }}</p>
            </div>
            <div>
                <p class="text-up-muted text-xs font-medium uppercase tracking-wide mb-1">Client</p>
                <p class="font-semibold text-up-dark text-sm">
                    {{ $job->employer->employerProfile->company_name ?? $job->employer->name }}
                </p>
            </div>
            <div>
                <p class="text-up-muted text-xs font-medium uppercase tracking-wide mb-1">Budget Range</p>
                <p class="font-bold text-up-green text-sm">
                    ${{ number_format($job->budget_min) }}&ndash;${{ number_format($job->budget_max) }}
                    @if($job->budget_type === 'hourly')<span class="text-up-text font-normal">/hr</span>@endif
                </p>
            </div>
            <div>
                <p class="text-up-muted text-xs font-medium uppercase tracking-wide mb-1">Deadline</p>
                <p class="font-semibold text-up-dark text-sm">
                    {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}
                </p>
            </div>
        </div>
    </div>

    {{-- Proposal Form --}}
    <div class="bg-white border border-up-border rounded-2xl p-8">
        <h2 class="text-lg font-bold text-up-dark mb-6">Your Proposal</h2>

        <form action="{{ route('freelance.apply.store', $job->id) }}" method="POST">
            @csrf

            {{-- Cover Letter --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-up-dark mb-2">
                    Cover Letter <span class="text-red-500">*</span>
                </label>
                <textarea name="cover_letter" rows="8"
                    placeholder="Introduce yourself and explain why you are the best fit for this project. Highlight relevant experience, your approach, and what makes you stand out..."
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('cover_letter') border-red-400 @enderror">{{ old('cover_letter') }}</textarea>
                @error('cover_letter')
                    <p class="text-red-500 text-sm mt-1">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
                <p class="text-up-muted text-xs mt-1.5">Minimum 50 characters. Be specific and professional.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                {{-- Bid Amount --}}
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">
                        Your Bid Amount (USD) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-up-muted font-medium">$</span>
                        <input type="number" name="bid_amount" min="1" step="0.01"
                            value="{{ old('bid_amount') }}"
                            placeholder="0.00"
                            class="w-full border border-up-border rounded-xl pl-8 pr-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('bid_amount') border-red-400 @enderror">
                    </div>
                    @error('bid_amount')
                        <p class="text-red-500 text-sm mt-1">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                    <p class="text-up-muted text-xs mt-1.5">
                        Client budget: ${{ number_format($job->budget_min) }}&ndash;${{ number_format($job->budget_max) }}
                    </p>
                </div>

                {{-- Delivery Time --}}
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">
                        Estimated Delivery Time <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="delivery_time"
                        value="{{ old('delivery_time') }}"
                        placeholder="e.g. 2 weeks, 10 days"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('delivery_time') border-red-400 @enderror">
                    @error('delivery_time')
                        <p class="text-red-500 text-sm mt-1">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                    <p class="text-up-muted text-xs mt-1.5">How long will you need to complete this project?</p>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex gap-3">
                <a href="{{ route('freelance.show', $job->id) }}" class="btn-outline flex-1 text-center py-3 text-sm font-semibold">
                    Cancel
                </a>
                <button type="submit" class="btn-primary flex-1 py-3 text-sm font-semibold">
                    <i class="fas fa-paper-plane mr-2"></i>Submit Proposal
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
