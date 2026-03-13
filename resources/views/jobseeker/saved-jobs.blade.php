@extends('layouts.app')
@section('title', 'Saved Jobs - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <h1 class="text-2xl font-bold">Saved Jobs</h1>
        <p class="text-up-muted mt-1">Jobs you've bookmarked for later</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    <div class="space-y-4">
        @forelse($savedJobs as $job)
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover">
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">

                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-bold text-up-dark">{{ $job->title }}</h3>
                    <p class="text-up-text text-sm mt-1">
                        <i class="fas fa-building text-up-muted mr-1.5"></i>
                        {{ $job->employer->employerProfile->company_name ?? $job->employer->name }}
                        &middot; {{ $job->location }}
                    </p>
                    <p class="text-up-green text-sm font-semibold mt-2">
                        ${{ number_format($job->salary_min) }}&ndash;${{ number_format($job->salary_max) }}/mo
                    </p>
                </div>

                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="{{ route('jobs.show', $job->id) }}" class="btn-primary px-5 py-2 text-sm font-medium">
                        View Job
                    </a>
                    <form action="{{ route('jobseeker.save-job', $job->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2 text-sm font-medium rounded-pill border border-red-300 text-red-500 hover:bg-red-50 transition-all">
                            <i class="fas fa-trash-can mr-1.5"></i>Remove
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @empty
        <div class="bg-white border border-up-border rounded-2xl text-center py-20">
            <div class="w-20 h-20 bg-up-bg rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-bookmark text-up-muted text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-up-dark mb-2">No saved jobs</h3>
            <p class="text-up-text text-sm mb-6">Save jobs you're interested in so you can apply later.</p>
            <a href="{{ route('jobs.index') }}" class="btn-primary px-8 py-3 text-sm font-semibold inline-block">
                <i class="fas fa-search mr-2"></i>Browse Jobs
            </a>
        </div>
        @endforelse
    </div>

    @if($savedJobs->hasPages())
    <div class="mt-8">
        {{ $savedJobs->links() }}
    </div>
    @endif

</div>
@endsection
