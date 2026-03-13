@extends('layouts.app')
@section('title', $job->title . ' - Jobs.AF')
@section('content')

{{-- ── Dark hero header ── --}}
<div class="bg-up-dark text-white py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-up-muted text-xs mb-5">
            <a href="{{ route('jobs.index') }}" class="hover:text-up-green transition-colors">Jobs</a>
            <span>/</span>
            <span class="text-white/70">{{ $job->category }}</span>
        </div>

        {{-- Badge row --}}
        <div class="flex flex-wrap gap-2 mb-4">
            @if($job->is_featured)
                <span class="bg-yellow-400 text-yellow-900 text-[11px] font-bold px-3 py-1 rounded-pill">
                    <i class="fas fa-star text-[10px] mr-0.5"></i> Featured
                </span>
            @endif
            <span class="bg-white/10 text-white text-[11px] font-medium px-3 py-1 rounded-pill">{{ $job->category }}</span>
            <span class="bg-white/10 text-white text-[11px] font-medium px-3 py-1 rounded-pill">{{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
            <span class="bg-white/10 text-white text-[11px] font-medium px-3 py-1 rounded-pill">{{ ucfirst($job->work_arrangement ?? 'onsite') }}</span>
            @if($job->gender_preference && $job->gender_preference !== 'any')
                <span class="bg-white/10 text-white text-[11px] font-medium px-3 py-1 rounded-pill">{{ ucfirst($job->gender_preference) }} Only</span>
            @endif
        </div>

        <h1 class="text-3xl font-extrabold mb-2 leading-tight">{{ $job->title }}</h1>
        <p class="text-up-muted text-lg font-medium mb-4">
            {{ $job->employer->employerProfile->company_name ?? $job->employer->name }}
        </p>

        <div class="flex flex-wrap items-center gap-5 text-sm text-up-muted">
            @if($job->country || $job->province || $job->location)
            <span class="flex items-center gap-1.5">
                <i class="fas fa-map-marker-alt text-up-green text-xs"></i>
                {{ implode(', ', array_filter([$job->country, $job->province, $job->location])) }}
            </span>
            @endif
            @if($job->salary_min && $job->salary_max)
            <span class="flex items-center gap-1.5">
                <i class="fas fa-dollar-sign text-up-green text-xs"></i>
                {{ $job->salary_currency ?? 'USD' }} {{ number_format($job->salary_min) }}&ndash;{{ number_format($job->salary_max) }}/mo
            </span>
            @endif
            <span class="flex items-center gap-1.5">
                <i class="fas fa-calendar-alt text-up-green text-xs"></i>
                Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}
            </span>
            <span class="flex items-center gap-1.5">
                <i class="fas fa-eye text-up-green text-xs"></i>
                {{ $job->views_count }} views
            </span>
        </div>
    </div>
</div>

{{-- ── Main layout ── --}}
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-10">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ── Main content ── --}}
        <div class="flex-1 min-w-0 space-y-6">

            {{-- Job Description --}}
            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-lg font-bold text-up-dark mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 bg-up-green rounded-full inline-block"></span>
                    Job Description
                </h2>
                <div class="text-up-text leading-relaxed whitespace-pre-line text-[15px]">{{ $job->description }}</div>
            </div>

            {{-- Responsibilities --}}
            @if($job->responsibilities)
            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-lg font-bold text-up-dark mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 bg-up-green rounded-full inline-block"></span>
                    Responsibilities
                </h2>
                <div class="text-up-text whitespace-pre-line text-[15px] leading-relaxed">{{ $job->responsibilities }}</div>
            </div>
            @endif

            {{-- Requirements --}}
            @if($job->requirements)
            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-lg font-bold text-up-dark mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 bg-up-green rounded-full inline-block"></span>
                    Requirements
                </h2>
                <div class="text-up-text whitespace-pre-line text-[15px] leading-relaxed">{{ $job->requirements }}</div>
            </div>
            @endif

            {{-- Skills --}}
            @if($job->skills_required || $job->skills_preferred)
            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-lg font-bold text-up-dark mb-5 flex items-center gap-2">
                    <span class="w-1 h-5 bg-up-green rounded-full inline-block"></span>
                    Skills
                </h2>
                @if($job->skills_required && count($job->skills_required) > 0)
                <div class="mb-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-up-muted mb-3">Required</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($job->skills_required as $skill)
                        <span class="bg-up-green/10 text-up-green text-sm font-medium px-3 py-1.5 rounded-pill border border-up-green/20">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($job->skills_preferred && count($job->skills_preferred) > 0)
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-up-muted mb-3">Preferred</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($job->skills_preferred as $skill)
                        <span class="bg-up-light text-up-text text-sm font-medium px-3 py-1.5 rounded-pill border border-up-border">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endif

            {{-- Benefits --}}
            @if($job->benefits)
            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-lg font-bold text-up-dark mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 bg-up-green rounded-full inline-block"></span>
                    Benefits
                </h2>
                <div class="text-up-text whitespace-pre-line text-[15px] leading-relaxed">{{ $job->benefits }}</div>
            </div>
            @endif

            {{-- Similar Jobs --}}
            @if($relatedJobs->count() > 0)
            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-lg font-bold text-up-dark mb-5 flex items-center gap-2">
                    <span class="w-1 h-5 bg-up-green rounded-full inline-block"></span>
                    Similar Jobs
                </h2>
                <div class="space-y-3">
                    @foreach($relatedJobs as $related)
                    <a href="{{ route('jobs.show', $related->id) }}" class="flex justify-between items-center p-4 border border-up-border rounded-xl hover:border-up-green hover:bg-up-bg transition-all group">
                        <div>
                            <div class="font-semibold text-up-dark text-sm group-hover:text-up-green transition-colors">{{ $related->title }}</div>
                            <div class="text-up-muted text-xs mt-0.5">
                                {{ $related->employer->employerProfile->company_name ?? $related->employer->name }}
                                @if($related->location) &middot; {{ $related->location }} @endif
                            </div>
                        </div>
                        <div class="text-up-green font-semibold text-sm flex-shrink-0 ml-4">
                            {{ $related->salary_currency ?? 'USD' }} {{ number_format($related->salary_min) }}/mo
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- ── Sidebar ── --}}
        <div class="lg:w-80 flex-shrink-0">

            {{-- Apply box --}}
            <div class="bg-white border border-up-border rounded-2xl p-6 sticky top-[88px] space-y-4">

                @if($hasApplied)
                    <div class="bg-[#dff5d8] border border-[#b4e6a5] rounded-xl p-4 text-center">
                        <div class="w-10 h-10 bg-up-green/10 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-check text-up-green"></i>
                        </div>
                        <p class="text-up-dark font-semibold text-sm">Application Submitted</p>
                        <p class="text-up-text text-xs mt-1">We'll notify you of any updates</p>
                    </div>

                @elseif(session('logged_in') && session('user_role') === 'jobseeker')
                    <a href="{{ route('jobs.apply', $job->id) }}" class="btn-primary block w-full py-3 text-center font-semibold text-[15px]">
                        Apply Now
                    </a>

                @elseif(!session('logged_in'))
                    <a href="{{ route('login') }}" class="btn-primary block w-full py-3 text-center font-semibold text-[15px]">
                        Log In to Apply
                    </a>
                    <a href="{{ route('register') }}" class="btn-outline block w-full py-3 text-center font-semibold text-[15px]">
                        Create Account
                    </a>
                @endif

                @if(session('logged_in') && session('user_role') === 'jobseeker')
                <form action="{{ route('jobseeker.save-job', $job->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full border border-up-border text-up-text hover:border-up-green hover:text-up-green py-2.5 rounded-pill text-sm font-medium transition-all">
                        <i class="far fa-bookmark mr-1.5"></i> Save Job
                    </button>
                </form>
                @endif

                {{-- Divider --}}
                <hr class="border-up-border">

                {{-- Job detail list --}}
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Job Type</span>
                        <span class="font-medium text-up-dark text-right">{{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
                    </div>
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Arrangement</span>
                        <span class="font-medium text-up-dark text-right">{{ ucfirst($job->work_arrangement ?? 'onsite') }}</span>
                    </div>
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Experience</span>
                        <span class="font-medium text-up-dark text-right">{{ ucfirst($job->experience_level) }} Level</span>
                    </div>
                    @if($job->years_of_experience)
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Years Required</span>
                        <span class="font-medium text-up-dark text-right">{{ $job->years_of_experience }}</span>
                    </div>
                    @endif
                    @if($job->education_level)
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Education</span>
                        <span class="font-medium text-up-dark text-right">{{ $job->education_level }}</span>
                    </div>
                    @endif
                    @if($job->num_vacancies && $job->num_vacancies > 1)
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Vacancies</span>
                        <span class="font-medium text-up-dark text-right">{{ $job->num_vacancies }}</span>
                    </div>
                    @endif
                    @if($job->gender_preference && $job->gender_preference !== 'any')
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Gender</span>
                        <span class="font-medium text-up-dark text-right">{{ ucfirst($job->gender_preference) }}</span>
                    </div>
                    @endif
                    @if($job->country)
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Country</span>
                        <span class="font-medium text-up-dark text-right">{{ $job->country }}</span>
                    </div>
                    @endif
                    @if($job->province)
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Province</span>
                        <span class="font-medium text-up-dark text-right">{{ $job->province }}</span>
                    </div>
                    @endif
                    @if($job->salary_min && $job->salary_max)
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Salary</span>
                        <span class="font-medium text-up-green text-right">{{ $job->salary_currency ?? 'USD' }} {{ number_format($job->salary_min) }}&ndash;{{ number_format($job->salary_max) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Posted</span>
                        <span class="font-medium text-up-dark text-right">{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex justify-between items-start gap-2">
                        <span class="text-up-muted flex-shrink-0">Deadline</span>
                        <span class="font-medium text-up-dark text-right">{{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}</span>
                    </div>
                </div>
            </div>

            {{-- Company box --}}
            <div class="bg-white border border-up-border rounded-2xl p-6 mt-5">
                <h3 class="font-bold text-up-dark text-[15px] mb-4">About the Company</h3>
                <div class="flex flex-col items-center text-center mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-up-dark flex items-center justify-center text-white text-xl font-extrabold mb-3">
                        {{ strtoupper(substr($job->employer->employerProfile->company_name ?? $job->employer->name, 0, 1)) }}
                    </div>
                    <h4 class="font-semibold text-up-dark text-[15px]">
                        {{ $job->employer->employerProfile->company_name ?? $job->employer->name }}
                    </h4>
                    @if($job->employer->employerProfile)
                    <p class="text-up-muted text-sm mt-0.5">{{ $job->employer->employerProfile->industry }}</p>
                    @endif
                </div>
                @if($job->employer->employerProfile)
                <p class="text-up-text text-sm leading-relaxed mb-4">
                    {{ Str::limit($job->employer->employerProfile->company_description, 120) }}
                </p>
                <a href="{{ route('companies.show', $job->employer->employerProfile->id) }}" class="btn-outline block w-full py-2.5 text-center text-sm font-semibold">
                    View Company Profile
                </a>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection
