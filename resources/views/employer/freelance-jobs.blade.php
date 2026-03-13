@extends('layouts.app')
@section('title', 'My Freelance Projects - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-up-muted text-sm font-medium uppercase tracking-widest mb-1">Employer</p>
            <h1 class="text-3xl font-bold text-white">My Freelance Projects</h1>
            <p class="text-up-muted mt-1">Manage your posted freelance projects</p>
        </div>
        <a href="{{ route('employer.freelance.create') }}"
            class="btn-primary inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold self-start sm:self-auto">
            <i class="fa-solid fa-plus"></i> Post New Project
        </a>
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
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Project</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Budget</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Proposals</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Posted</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-up-text uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr class="border-b border-up-border last:border-0 hover:bg-up-bg-light transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-up-dark">{{ $job->title }}</div>
                            <div class="text-xs text-up-muted mt-0.5">
                                {{ $job->category }}
                                <span class="mx-1">&middot;</span>
                                {{ ucfirst($job->budget_type) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-up-dark text-sm">
                                ${{ number_format($job->budget_min) }}&ndash;${{ number_format($job->budget_max) }}
                            </span>
                            @if($job->budget_type === 'hourly')
                            <span class="text-up-muted text-xs">/hr</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('employer.freelance.proposals', $job->id) }}"
                                class="inline-flex items-center gap-1.5 text-up-green hover:text-up-green-hover text-sm font-medium hover:underline">
                                <i class="fa-regular fa-file-lines"></i>
                                {{ $job->proposals_count }} proposal{{ $job->proposals_count !== 1 ? 's' : '' }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            @if($job->status === 'active')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-up-green/10 text-up-green">
                                    <span class="w-1.5 h-1.5 rounded-full bg-up-green"></span> Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-up-light text-up-text">
                                    <span class="w-1.5 h-1.5 rounded-full bg-up-muted"></span> {{ ucfirst($job->status) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-up-muted">
                            {{ $job->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('employer.freelance.edit', $job->id) }}"
                                    class="text-up-green hover:text-up-green-hover text-sm font-medium hover:underline">
                                    Edit
                                </a>
                                <a href="{{ route('employer.freelance.proposals', $job->id) }}"
                                    class="text-up-green hover:text-up-green-hover text-sm font-medium hover:underline">
                                    Proposals
                                </a>
                                <form action="{{ route('employer.freelance.destroy', $job->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="w-14 h-14 bg-up-bg rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-laptop-code text-up-muted text-2xl"></i>
                            </div>
                            <p class="text-up-text font-medium mb-1">No freelance projects yet</p>
                            <p class="text-up-muted text-sm mb-5">Post your first project to receive proposals from talented freelancers.</p>
                            <a href="{{ route('employer.freelance.create') }}"
                                class="btn-primary inline-block px-6 py-2.5 text-sm font-semibold">
                                Post Your First Project
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
