@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your platform activity')

@section('content')

{{-- ===== STATS GRID ===== --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-8">

    {{-- Total Users --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-up-light flex items-center justify-center shrink-0">
            <i class="fas fa-users text-up-badge text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Total Users</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['total_users']) }}</p>
        </div>
    </div>

    {{-- Jobseekers --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-up-light flex items-center justify-center shrink-0">
            <i class="fas fa-user-tie text-up-badge text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Jobseekers</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['jobseekers']) }}</p>
        </div>
    </div>

    {{-- Employers --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
            <i class="fas fa-building text-amber-600 text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Employers</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['employers']) }}</p>
        </div>
    </div>

    {{-- Freelancers --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-up-light flex items-center justify-center shrink-0">
            <i class="fas fa-laptop-code text-up-green text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Freelancers</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['freelancers']) }}</p>
        </div>
    </div>

    {{-- Active Jobs --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-up-light flex items-center justify-center shrink-0">
            <i class="fas fa-briefcase text-up-dark text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Active Jobs</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['active_jobs']) }}</p>
        </div>
    </div>

    {{-- Total Applications --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center shrink-0">
            <i class="fas fa-file-alt text-red-500 text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Applications</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['total_applications']) }}</p>
        </div>
    </div>

    {{-- Freelance Jobs --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-teal-50 flex items-center justify-center shrink-0">
            <i class="fas fa-tasks text-teal-600 text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Freelance Jobs</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['freelance_jobs']) }}</p>
        </div>
    </div>

    {{-- Total Proposals --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center shrink-0">
            <i class="fas fa-paper-plane text-orange-500 text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Proposals</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['total_proposals']) }}</p>
        </div>
    </div>

    {{-- Total Resumes --}}
    <div class="bg-white rounded-2xl border border-up-border p-6 flex items-center gap-4 card-hover">
        <div class="w-12 h-12 rounded-xl bg-pink-50 flex items-center justify-center shrink-0">
            <i class="fas fa-id-card text-pink-500 text-lg"></i>
        </div>
        <div>
            <p class="text-up-muted text-xs font-medium uppercase tracking-wide">Resumes</p>
            <p class="text-2xl font-bold text-up-dark mt-0.5">{{ number_format($stats['total_resumes']) }}</p>
        </div>
    </div>

</div>

{{-- ===== RECENT ACTIVITY ===== --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Recent Users --}}
    <div class="bg-white rounded-2xl border border-up-border overflow-hidden">
        <div class="px-6 py-4 border-b border-up-border flex items-center justify-between">
            <h2 class="text-sm font-bold text-up-dark flex items-center gap-2">
                <i class="fas fa-user-plus text-up-green"></i>
                Recent Users
            </h2>
            <a href="{{ route('admin.users.index') }}"
               class="text-up-green hover:text-up-green-hover text-xs font-semibold flex items-center gap-1">
                View all <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-up-bg-light border-b border-up-border">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-up-border">
                    @forelse($recentUsers as $user)
                    <tr class="hover:bg-up-bg-light transition-colors">
                        <td class="px-6 py-3.5">
                            <div class="font-semibold text-up-dark text-sm">{{ $user->name }}</div>
                            <div class="text-up-muted text-xs">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-3.5">
                            @php
                                $roleColors = [
                                    'admin'      => 'bg-red-100 text-red-700',
                                    'employer'   => 'bg-amber-100 text-amber-700',
                                    'jobseeker'  => 'bg-up-light text-up-badge',
                                    'freelancer' => 'bg-up-light text-up-badge',
                                ];
                                $color = $roleColors[$user->role] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="px-2.5 py-1 rounded-pill text-xs font-semibold {{ $color }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-up-muted text-xs">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center">
                            <i class="fas fa-users text-2xl text-up-border mb-2 block"></i>
                            <p class="text-up-muted text-sm">No users found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Jobs --}}
    <div class="bg-white rounded-2xl border border-up-border overflow-hidden">
        <div class="px-6 py-4 border-b border-up-border flex items-center justify-between">
            <h2 class="text-sm font-bold text-up-dark flex items-center gap-2">
                <i class="fas fa-briefcase text-up-green"></i>
                Recent Job Listings
            </h2>
            <a href="{{ route('admin.jobs.index') }}"
               class="text-up-green hover:text-up-green-hover text-xs font-semibold flex items-center gap-1">
                View all <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-up-bg-light border-b border-up-border">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Posted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-up-border">
                    @forelse($recentJobs as $job)
                    <tr class="hover:bg-up-bg-light transition-colors">
                        <td class="px-6 py-3.5">
                            <div class="font-semibold text-up-dark text-sm">{{ $job->title }}</div>
                            <div class="text-up-muted text-xs">
                                {{ optional(optional($job->employer)->employerProfile)->company_name ?? optional($job->employer)->name ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="px-6 py-3.5">
                            @php
                                $statusColors = [
                                    'active' => 'bg-[#dff5d8] text-up-badge',
                                    'closed' => 'bg-red-100 text-red-700',
                                    'draft'  => 'bg-gray-100 text-gray-600',
                                ];
                                $sColor = $statusColors[$job->status] ?? 'bg-gray-100 text-gray-600';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-pill text-xs font-semibold {{ $sColor }}">
                                @if($job->status === 'active')
                                    <span class="w-1.5 h-1.5 rounded-full bg-up-green inline-block"></span>
                                @elseif($job->status === 'closed')
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>
                                @else
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 inline-block"></span>
                                @endif
                                {{ ucfirst($job->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-up-muted text-xs">
                            {{ $job->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center">
                            <i class="fas fa-briefcase text-2xl text-up-border mb-2 block"></i>
                            <p class="text-up-muted text-sm">No jobs found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
