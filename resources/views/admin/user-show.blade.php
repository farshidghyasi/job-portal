@extends('layouts.admin')

@section('title', 'User: ' . $user->name . ' - Admin Panel')
@section('page-title', 'User Details')
@section('page-subtitle', 'Viewing profile for ' . $user->name)

@section('content')

{{-- Back Link --}}
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}"
       class="inline-flex items-center gap-2 text-sm text-up-muted hover:text-up-green font-medium transition-colors">
        <i class="fas fa-arrow-left text-xs"></i> Back to Users
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ===== LEFT COLUMN ===== --}}
    <div class="lg:col-span-1 space-y-5">

        {{-- User Card --}}
        <div class="bg-white rounded-2xl border border-up-border p-6">

            {{-- Avatar + Core Info --}}
            <div class="text-center mb-6">
                <div class="w-18 h-18 mx-auto mb-3">
                    <div class="w-16 h-16 rounded-full bg-up-light border-2 border-up-border flex items-center justify-center mx-auto">
                        <span class="text-up-badge font-bold text-2xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                </div>
                <h2 class="text-lg font-bold text-up-dark">{{ $user->name }}</h2>
                <p class="text-up-muted text-sm mt-0.5">{{ $user->email }}</p>

                {{-- Role + Status Badges --}}
                <div class="flex items-center justify-center gap-2 mt-3 flex-wrap">
                    @php
                        $roleColors = [
                            'admin'      => 'bg-red-100 text-red-700',
                            'employer'   => 'bg-amber-100 text-amber-700',
                            'jobseeker'  => 'bg-up-light text-up-badge',
                            'freelancer' => 'bg-up-light text-up-badge',
                        ];
                        $rColor = $roleColors[$user->role] ?? 'bg-gray-100 text-gray-600';
                    @endphp
                    <span class="px-2.5 py-1 rounded-pill text-xs font-semibold {{ $rColor }}">
                        {{ ucfirst($user->role) }}
                    </span>
                    @if($user->status === 'active')
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-pill text-xs font-semibold bg-[#dff5d8] text-up-badge">
                            <span class="w-1.5 h-1.5 rounded-full bg-up-green inline-block"></span>Active
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-pill text-xs font-semibold bg-red-100 text-red-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>Inactive
                        </span>
                    @endif
                </div>
            </div>

            {{-- Details --}}
            <div class="space-y-3 text-sm border-t border-up-border pt-5">
                @if($user->phone)
                <div class="flex items-center gap-3 text-up-text">
                    <i class="fas fa-phone text-up-muted w-4 text-center text-xs"></i>
                    <span>{{ $user->phone }}</span>
                </div>
                @endif

                @if($user->location)
                <div class="flex items-center gap-3 text-up-text">
                    <i class="fas fa-map-marker-alt text-up-muted w-4 text-center text-xs"></i>
                    <span>{{ $user->location }}</span>
                </div>
                @endif

                <div class="flex items-center gap-3 text-up-text">
                    <i class="fas fa-calendar-alt text-up-muted w-4 text-center text-xs"></i>
                    <span>Joined {{ $user->created_at->format('M d, Y') }}</span>
                </div>

                <div class="flex items-center gap-3 text-up-text">
                    <i class="fas fa-id-badge text-up-muted w-4 text-center text-xs"></i>
                    <span>User ID: #{{ $user->id }}</span>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="mt-5 space-y-2 border-t border-up-border pt-5">
                <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="{{ $user->status === 'active' ? 'inactive' : 'active' }}">
                    <button type="submit"
                        class="w-full py-2.5 rounded-xl text-sm font-semibold transition-colors flex items-center justify-center gap-2
                            {{ $user->status === 'active'
                                ? 'bg-orange-50 hover:bg-orange-100 text-orange-700'
                                : 'bg-[#dff5d8] hover:bg-up-light text-up-badge' }}">
                        @if($user->status === 'active')
                            <i class="fas fa-ban"></i> Deactivate Account
                        @else
                            <i class="fas fa-check-circle"></i> Activate Account
                        @endif
                    </button>
                </form>

                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                      onsubmit="return confirm('Permanently delete {{ addslashes($user->name) }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full py-2.5 rounded-xl text-sm font-semibold bg-red-50 hover:bg-red-100 text-red-700 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-trash"></i> Delete User
                    </button>
                </form>
            </div>
        </div>

        {{-- Employer Profile --}}
        @if($user->role === 'employer' && $user->employerProfile)
        <div class="bg-white rounded-2xl border border-up-border p-6">
            <h3 class="text-sm font-bold text-up-dark mb-4 flex items-center gap-2">
                <i class="fas fa-building text-amber-500"></i> Company Profile
            </h3>
            <div class="space-y-4 text-sm">
                @if($user->employerProfile->company_name)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Company Name</p>
                    <p class="font-semibold text-up-dark">{{ $user->employerProfile->company_name }}</p>
                </div>
                @endif
                @if($user->employerProfile->industry)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Industry</p>
                    <p class="font-medium text-up-text">{{ $user->employerProfile->industry }}</p>
                </div>
                @endif
                @if($user->employerProfile->company_size)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Company Size</p>
                    <p class="font-medium text-up-text">{{ $user->employerProfile->company_size }}</p>
                </div>
                @endif
                @if($user->employerProfile->website)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Website</p>
                    <a href="{{ $user->employerProfile->website }}" target="_blank"
                       class="text-up-green hover:text-up-green-hover text-xs underline break-all">
                       {{ $user->employerProfile->website }}
                    </a>
                </div>
                @endif
                @if($user->employerProfile->city || $user->employerProfile->country)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Location</p>
                    <p class="font-medium text-up-text">
                        {{ implode(', ', array_filter([$user->employerProfile->city, $user->employerProfile->country])) }}
                    </p>
                </div>
                @endif
                @if($user->employerProfile->company_description)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Description</p>
                    <p class="text-up-text text-xs leading-relaxed">{{ Str::limit($user->employerProfile->company_description, 150) }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- Freelancer Profile --}}
        @if($user->role === 'freelancer' && $user->freelancerProfile)
        <div class="bg-white rounded-2xl border border-up-border p-6">
            <h3 class="text-sm font-bold text-up-dark mb-4 flex items-center gap-2">
                <i class="fas fa-laptop-code text-up-green"></i> Freelancer Profile
            </h3>
            <div class="space-y-4 text-sm">
                @if($user->freelancerProfile->title)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Title</p>
                    <p class="font-semibold text-up-dark">{{ $user->freelancerProfile->title }}</p>
                </div>
                @endif
                @if($user->freelancerProfile->category)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Category</p>
                    <p class="font-medium text-up-text">{{ $user->freelancerProfile->category }}</p>
                </div>
                @endif
                @if($user->freelancerProfile->hourly_rate)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Hourly Rate</p>
                    <p class="font-bold text-up-green">${{ number_format($user->freelancerProfile->hourly_rate, 2) }}/hr</p>
                </div>
                @endif
                @if($user->freelancerProfile->experience_years)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Experience</p>
                    <p class="font-medium text-up-text">{{ $user->freelancerProfile->experience_years }} years</p>
                </div>
                @endif
                @if($user->freelancerProfile->availability)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Availability</p>
                    <p class="font-medium text-up-text">{{ ucfirst($user->freelancerProfile->availability) }}</p>
                </div>
                @endif
                @if($user->freelancerProfile->skills && count($user->freelancerProfile->skills) > 0)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-1.5">Skills</p>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(array_slice($user->freelancerProfile->skills, 0, 8) as $skill)
                        <span class="px-2 py-0.5 bg-up-light text-up-badge rounded-pill text-xs font-medium">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($user->freelancerProfile->rating)
                <div>
                    <p class="text-up-muted text-xs font-medium mb-0.5">Rating</p>
                    <p class="font-semibold text-up-dark flex items-center gap-1">
                        <i class="fas fa-star text-amber-400 text-xs"></i>
                        {{ number_format($user->freelancerProfile->rating, 1) }}
                        @if($user->freelancerProfile->total_reviews)
                            <span class="text-up-muted font-normal text-xs">({{ $user->freelancerProfile->total_reviews }} reviews)</span>
                        @endif
                    </p>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>

    {{-- ===== RIGHT COLUMN ===== --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Job Listings (employers) --}}
        @if($user->role === 'employer')
        <div class="bg-white rounded-2xl border border-up-border overflow-hidden">
            <div class="px-6 py-4 border-b border-up-border flex items-center gap-3">
                <i class="fas fa-briefcase text-up-green"></i>
                <h3 class="text-sm font-bold text-up-dark">Job Listings</h3>
                <span class="ml-auto px-2.5 py-1 bg-up-light text-up-badge rounded-pill text-xs font-semibold">
                    {{ $user->jobListings->count() }}
                </span>
            </div>
            @if($user->jobListings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-up-bg-light border-b border-up-border">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Posted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-up-border">
                        @foreach($user->jobListings as $job)
                        <tr class="hover:bg-up-bg-light transition-colors">
                            <td class="px-6 py-3.5 font-semibold text-up-dark">{{ $job->title }}</td>
                            <td class="px-6 py-3.5 text-up-text capitalize text-xs">{{ str_replace('-', ' ', $job->type) }}</td>
                            <td class="px-6 py-3.5">
                                @php
                                    $sColors = [
                                        'active' => 'bg-[#dff5d8] text-up-badge',
                                        'closed' => 'bg-red-100 text-red-700',
                                        'draft'  => 'bg-gray-100 text-gray-600'
                                    ];
                                    $sc = $sColors[$job->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="px-2.5 py-1 rounded-pill text-xs font-semibold {{ $sc }}">{{ ucfirst($job->status) }}</span>
                            </td>
                            <td class="px-6 py-3.5 text-up-muted text-xs">{{ $job->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-6 py-10 text-center">
                <i class="fas fa-briefcase text-2xl text-up-border mb-2 block"></i>
                <p class="text-up-muted text-sm">No job listings posted yet</p>
            </div>
            @endif
        </div>
        @endif

        {{-- Resumes (jobseekers) --}}
        @if($user->role === 'jobseeker')
        <div class="bg-white rounded-2xl border border-up-border overflow-hidden">
            <div class="px-6 py-4 border-b border-up-border flex items-center gap-3">
                <i class="fas fa-id-card text-pink-500"></i>
                <h3 class="text-sm font-bold text-up-dark">Resumes</h3>
                <span class="ml-auto px-2.5 py-1 bg-pink-100 text-pink-700 rounded-pill text-xs font-semibold">
                    {{ $user->resumes->count() }}
                </span>
            </div>
            @if($user->resumes->count() > 0)
            <div class="divide-y divide-up-border">
                @foreach($user->resumes as $resume)
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-up-dark text-sm">{{ $resume->title }}</p>
                        <p class="text-up-muted text-xs mt-0.5">
                            {{ $resume->is_public ? 'Public' : 'Private' }} &bull; Created {{ $resume->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    <span class="px-2.5 py-1 rounded-pill text-xs font-semibold
                        {{ $resume->is_public ? 'bg-[#dff5d8] text-up-badge' : 'bg-gray-100 text-gray-600' }}">
                        {{ $resume->is_public ? 'Public' : 'Private' }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
            <div class="px-6 py-10 text-center">
                <i class="fas fa-id-card text-2xl text-up-border mb-2 block"></i>
                <p class="text-up-muted text-sm">No resumes created yet</p>
            </div>
            @endif
        </div>

        {{-- Applications --}}
        <div class="bg-white rounded-2xl border border-up-border overflow-hidden">
            <div class="px-6 py-4 border-b border-up-border flex items-center gap-3">
                <i class="fas fa-paper-plane text-up-green"></i>
                <h3 class="text-sm font-bold text-up-dark">Job Applications</h3>
                <span class="ml-auto px-2.5 py-1 bg-up-light text-up-badge rounded-pill text-xs font-semibold">
                    {{ $user->applications->count() }}
                </span>
            </div>
            @if($user->applications->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-up-bg-light border-b border-up-border">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Job</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Applied</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-up-border">
                        @foreach($user->applications as $application)
                        <tr class="hover:bg-up-bg-light transition-colors">
                            <td class="px-6 py-3.5 font-semibold text-up-dark">
                                {{ optional($application->job)->title ?? 'Job Removed' }}
                            </td>
                            <td class="px-6 py-3.5">
                                @php
                                    $appColors = [
                                        'pending'     => 'bg-amber-100 text-amber-700',
                                        'reviewed'    => 'bg-up-light text-up-badge',
                                        'shortlisted' => 'bg-up-light text-up-badge',
                                        'rejected'    => 'bg-red-100 text-red-700',
                                        'hired'       => 'bg-[#dff5d8] text-up-badge',
                                    ];
                                    $ac = $appColors[$application->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="px-2.5 py-1 rounded-pill text-xs font-semibold {{ $ac }}">{{ ucfirst($application->status) }}</span>
                            </td>
                            <td class="px-6 py-3.5 text-up-muted text-xs">{{ $application->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-6 py-10 text-center">
                <i class="fas fa-paper-plane text-2xl text-up-border mb-2 block"></i>
                <p class="text-up-muted text-sm">No applications submitted yet</p>
            </div>
            @endif
        </div>
        @endif

        {{-- Freelancer Activity --}}
        @if($user->role === 'freelancer')
        <div class="bg-white rounded-2xl border border-up-border overflow-hidden">
            <div class="px-6 py-4 border-b border-up-border flex items-center gap-3">
                <i class="fas fa-paper-plane text-up-green"></i>
                <h3 class="text-sm font-bold text-up-dark">Recent Activity</h3>
            </div>
            <div class="px-6 py-10 text-center">
                <div class="w-14 h-14 rounded-full bg-up-bg flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-laptop-code text-xl text-up-border"></i>
                </div>
                <p class="text-up-muted text-sm">Freelancer activity tracked via proposals</p>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection
