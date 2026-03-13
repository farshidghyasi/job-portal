@extends('layouts.app')
@section('title', $job->title . ' - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex items-start justify-between">
            <div>
                <div class="flex flex-wrap gap-2 mb-3">
                    @if($job->is_featured)<span class="bg-yellow-400 text-yellow-900 text-xs px-2 py-1 rounded-full font-semibold">⭐ Featured</span>@endif
                    <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ $job->category }}</span>
                    <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
                </div>
                <h1 class="text-3xl font-bold mb-2">{{ $job->title }}</h1>
                <p class="text-green-100 text-lg">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }}</p>
                <div class="flex flex-wrap gap-4 mt-3 text-sm text-green-100">
                    <span>📍 {{ $job->location }}</span>
                    <span>💰 ${{ number_format($job->salary_min) }}-${{ number_format($job->salary_max) }}/mo</span>
                    <span>📅 Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open' }}</span>
                    <span>👁 {{ $job->views_count }} views</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="flex-1">
            <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Job Description</h2>
                <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $job->description }}</div>
            </div>

            @if($job->requirements)
            <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Requirements</h2>
                <div class="text-gray-600 whitespace-pre-line">{{ $job->requirements }}</div>
            </div>
            @endif

            @if($job->benefits)
            <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Benefits</h2>
                <div class="text-gray-600 whitespace-pre-line">{{ $job->benefits }}</div>
            </div>
            @endif

            <!-- Related Jobs -->
            @if($relatedJobs->count() > 0)
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Similar Jobs</h2>
                <div class="space-y-4">
                    @foreach($relatedJobs as $related)
                    <a href="{{ route('jobs.show', $related->id) }}" class="flex justify-between items-center p-4 border rounded-lg hover:bg-gray-50 transition-all">
                        <div>
                            <div class="font-semibold text-gray-800">{{ $related->title }}</div>
                            <div class="text-sm text-gray-500">{{ $related->employer->employerProfile->company_name ?? $related->employer->name }} · {{ $related->location }}</div>
                        </div>
                        <div class="text-green-600 font-medium text-sm">${{ number_format($related->salary_min) }}/mo</div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:w-72 flex-shrink-0">
            <!-- Apply Box -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6 sticky top-20">
                @if($hasApplied)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                        <div class="text-2xl mb-2">✅</div>
                        <p class="text-green-700 font-semibold">Already Applied</p>
                        <p class="text-green-600 text-sm mt-1">We'll notify you of updates</p>
                    </div>
                @elseif(session('logged_in') && session('user_role') === 'jobseeker')
                    <a href="{{ route('jobs.apply', $job->id) }}" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 rounded-xl font-semibold transition-all">Apply Now</a>
                @elseif(!session('logged_in'))
                    <a href="{{ route('login') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 rounded-xl font-semibold transition-all">Login to Apply</a>
                    <a href="{{ route('register') }}" class="block w-full border border-green-600 text-green-600 hover:bg-green-50 text-center py-3 rounded-xl font-semibold transition-all mt-3">Create Account</a>
                @endif

                @if(session('logged_in') && session('user_role') === 'jobseeker')
                <form action="{{ route('jobseeker.save-job', $job->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full border border-gray-300 text-gray-600 hover:bg-gray-50 py-2 rounded-xl text-sm transition-all">🔖 Save Job</button>
                </form>
                @endif

                <div class="mt-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Experience:</span>
                        <span class="font-medium text-gray-700">{{ ucfirst($job->experience_level) }} Level</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Job Type:</span>
                        <span class="font-medium text-gray-700">{{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
                    </div>
                    @if($job->education_level)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Education:</span>
                        <span class="font-medium text-gray-700">{{ $job->education_level }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-500">Posted:</span>
                        <span class="font-medium text-gray-700">{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Company Box -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4">About the Company</h3>
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-white text-2xl font-bold mx-auto">
                        {{ strtoupper(substr($job->employer->employerProfile->company_name ?? $job->employer->name, 0, 1)) }}
                    </div>
                    <h4 class="font-semibold mt-2">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }}</h4>
                    @if($job->employer->employerProfile)
                    <p class="text-gray-500 text-sm">{{ $job->employer->employerProfile->industry }}</p>
                    @endif
                </div>
                @if($job->employer->employerProfile)
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($job->employer->employerProfile->company_description, 120) }}</p>
                <a href="{{ route('companies.show', $job->employer->employerProfile->id) }}" class="text-green-600 hover:underline text-sm font-medium">View Company Profile →</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
