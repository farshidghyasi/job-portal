@extends('layouts.app')
@section('title', 'Apply — ' . $job->title . ' - Jobs.AF')
@section('content')

{{-- ── Dark header strip ── --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 text-up-muted text-xs mb-4">
            <a href="{{ route('jobs.index') }}" class="hover:text-up-green transition-colors">Jobs</a>
            <span>/</span>
            <a href="{{ route('jobs.show', $job->id) }}" class="hover:text-up-green transition-colors">{{ Str::limit($job->title, 40) }}</a>
            <span>/</span>
            <span class="text-white/60">Apply</span>
        </div>
        <h1 class="text-2xl font-extrabold leading-snug mb-1">Apply for: {{ $job->title }}</h1>
        <p class="text-up-muted text-[15px]">
            {{ $job->employer->employerProfile->company_name ?? $job->employer->name }}
            @if($job->location)
                &middot; {{ $job->location }}
            @endif
        </p>
    </div>
</div>

{{-- ── Content ── --}}
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ── Application form ── --}}
        <div class="flex-1">
            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-lg font-bold text-up-dark mb-6">Your Application</h2>

                <form action="{{ route('jobs.apply.store', $job->id) }}" method="POST" novalidate>
                    @csrf

                    {{-- Resume selector --}}
                    @if($resumes->count() > 0)
                    <div class="mb-6">
                        <label class="block text-up-dark font-medium text-sm mb-1.5" for="resume_id">
                            Select Resume
                            <span class="text-up-muted font-normal">(optional)</span>
                        </label>
                        <select
                            id="resume_id"
                            name="resume_id"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition bg-white"
                        >
                            <option value="">-- No resume (cover letter only) --</option>
                            @foreach($resumes as $resume)
                            <option value="{{ $resume->id }}">{{ $resume->title }}</option>
                            @endforeach
                        </select>
                        <p class="text-up-muted text-xs mt-1.5">
                            Or <a href="{{ route('resume.create') }}" class="text-up-green hover:text-up-green-hover font-medium">create a new resume</a>
                        </p>
                    </div>
                    @else
                    <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-2xl p-4 flex items-start gap-3">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-0.5 flex-shrink-0"></i>
                        <p class="text-yellow-800 text-sm">
                            You don't have a resume yet.
                            <a href="{{ route('resume.create') }}" class="font-semibold underline underline-offset-2 hover:text-yellow-900">Create one now</a>
                            or continue with just a cover letter.
                        </p>
                    </div>
                    @endif

                    {{-- Cover letter --}}
                    <div class="mb-7">
                        <label class="block text-up-dark font-medium text-sm mb-1.5" for="cover_letter">
                            Cover Letter <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="cover_letter"
                            name="cover_letter"
                            rows="9"
                            placeholder="Tell the employer why you are the perfect candidate for this position. Mention your relevant experience, skills, and why you want to work at this company…"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition resize-y @error('cover_letter') border-red-400 @enderror"
                        >{{ old('cover_letter') }}</textarea>
                        @error('cover_letter')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                        <p class="text-up-muted text-xs mt-1.5">Minimum 50 characters</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn-outline flex-1 py-3 text-center font-semibold text-[15px]">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary flex-1 py-3 font-semibold text-[15px]">
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ── Job summary sidebar ── --}}
        <div class="lg:w-64 flex-shrink-0">
            <div class="bg-white border border-up-border rounded-2xl p-6 sticky top-[88px]">
                <h3 class="font-bold text-up-dark text-[15px] mb-4">Job Summary</h3>

                <div class="w-12 h-12 rounded-xl bg-up-dark flex items-center justify-center text-white font-extrabold text-lg mb-3">
                    {{ strtoupper(substr($job->employer->employerProfile->company_name ?? $job->employer->name, 0, 1)) }}
                </div>

                <p class="font-semibold text-up-dark text-sm mb-0.5">{{ $job->title }}</p>
                <p class="text-up-text text-xs mb-4">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }}</p>

                <div class="space-y-2.5 text-xs">
                    @if($job->country || $job->province || $job->location)
                    <div class="flex items-start gap-2 text-up-text">
                        <i class="fas fa-map-marker-alt text-up-muted mt-0.5 w-3 flex-shrink-0"></i>
                        <span>{{ implode(', ', array_filter([$job->country, $job->province, $job->location])) }}</span>
                    </div>
                    @endif
                    <div class="flex items-start gap-2 text-up-text">
                        <i class="fas fa-briefcase text-up-muted mt-0.5 w-3 flex-shrink-0"></i>
                        <span>{{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
                    </div>
                    @if($job->salary_min && $job->salary_max)
                    <div class="flex items-start gap-2 text-up-green font-semibold">
                        <i class="fas fa-dollar-sign text-up-green mt-0.5 w-3 flex-shrink-0"></i>
                        <span>{{ $job->salary_currency ?? 'USD' }} {{ number_format($job->salary_min) }}&ndash;{{ number_format($job->salary_max) }}/mo</span>
                    </div>
                    @endif
                    <div class="flex items-start gap-2 text-up-text">
                        <i class="fas fa-calendar-alt text-up-muted mt-0.5 w-3 flex-shrink-0"></i>
                        <span>Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}</span>
                    </div>
                </div>

                <hr class="border-up-border my-4">

                <a href="{{ route('jobs.show', $job->id) }}" class="text-up-green hover:text-up-green-hover text-xs font-medium flex items-center gap-1">
                    <i class="fas fa-arrow-left text-[10px]"></i> Back to job listing
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
