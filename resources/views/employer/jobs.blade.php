@extends('layouts.app')
@section('title', 'My Jobs - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-up-muted text-sm font-medium uppercase tracking-widest mb-1">Employer</p>
            <h1 class="text-3xl font-bold text-white">My Job Postings</h1>
        </div>
        <a href="{{ route('employer.jobs.create') }}" class="btn-primary inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold self-start sm:self-auto">
            <i class="fa-solid fa-plus"></i> Post New Job
        </a>
    </div>
</div>

<div class="bg-up-bg min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <div class="bg-white border border-up-border rounded-2xl overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-up-border bg-up-bg-light">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Job Title</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Applications</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr class="border-b border-up-border last:border-0 hover:bg-up-bg-light transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-up-dark">{{ $job->title }}</div>
                            <div class="text-xs text-up-muted mt-0.5">{{ $job->location }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-up-light text-up-text text-xs font-medium px-2.5 py-1 rounded-full">
                                {{ ucfirst(str_replace('-', ' ', $job->type)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('employer.jobs.applications', $job->id) }}"
                                class="text-up-green hover:text-up-green-hover text-sm font-medium hover:underline">
                                {{ $job->applications_count }} application{{ $job->applications_count !== 1 ? 's' : '' }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            @if($job->status === 'active')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-up-green/10 text-up-green">
                                    <span class="w-1.5 h-1.5 rounded-full bg-up-green"></span> Active
                                </span>
                            @elseif($job->status === 'draft')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Draft
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-up-light text-up-text">
                                    <span class="w-1.5 h-1.5 rounded-full bg-up-muted"></span> {{ ucfirst($job->status) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('employer.jobs.edit', $job->id) }}"
                                    class="text-up-green hover:text-up-green-hover text-sm font-medium hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this job?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="w-14 h-14 bg-up-bg rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-briefcase text-up-muted text-2xl"></i>
                            </div>
                            <p class="text-up-text font-medium mb-1">No jobs posted yet</p>
                            <p class="text-up-muted text-sm mb-5">Post your first job to start receiving applications.</p>
                            <a href="{{ route('employer.jobs.create') }}" class="btn-primary inline-block px-6 py-2.5 text-sm font-semibold">
                                Post a Job
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($jobs->hasPages())
        <div class="mt-6">{{ $jobs->links() }}</div>
        @endif

    </div>
</div>

@endsection
