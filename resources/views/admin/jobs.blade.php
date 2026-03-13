@extends('layouts.admin')

@section('title', 'Job Listings - Admin Panel')
@section('page-title', 'Manage Job Listings')
@section('page-subtitle', 'Review, update status, and remove job listings')

@section('content')

<div class="bg-white rounded-2xl border border-up-border overflow-hidden">

    {{-- Table Header --}}
    <div class="px-6 py-5 border-b border-up-border flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-up-dark">All Job Listings</h2>
            <p class="text-up-muted text-xs mt-0.5">{{ $jobs->total() }} total listings &mdash; Page {{ $jobs->currentPage() }} of {{ $jobs->lastPage() }}</p>
        </div>
        <span class="inline-flex items-center gap-1.5 bg-up-light text-up-badge text-xs font-semibold px-3 py-1.5 rounded-pill">
            <i class="fas fa-briefcase text-[10px]"></i>
            {{ $jobs->total() }} Listings
        </span>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-up-bg-light border-b border-up-border">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Job</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Company</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Posted</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-up-border">
                @forelse($jobs as $job)
                <tr class="hover:bg-up-bg-light transition-colors">

                    {{-- Job Title --}}
                    <td class="px-6 py-4">
                        <div class="font-semibold text-up-dark">{{ $job->title }}</div>
                        @if($job->location)
                        <div class="text-up-muted text-xs mt-0.5 flex items-center gap-1">
                            <i class="fas fa-map-marker-alt text-[10px]"></i>{{ $job->location }}
                        </div>
                        @endif
                    </td>

                    {{-- Company --}}
                    <td class="px-6 py-4 text-up-text text-sm">
                        {{ optional(optional($job->employer)->employerProfile)->company_name ?? optional($job->employer)->name ?? 'N/A' }}
                    </td>

                    {{-- Category --}}
                    <td class="px-6 py-4 text-up-muted text-xs">
                        {{ $job->category ?? '—' }}
                    </td>

                    {{-- Type --}}
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 bg-up-bg text-up-text rounded-pill text-xs font-medium capitalize border border-up-border">
                            {{ str_replace('-', ' ', $job->type ?? '—') }}
                        </span>
                    </td>

                    {{-- Status Badge --}}
                    <td class="px-6 py-4">
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

                    {{-- Posted Date --}}
                    <td class="px-6 py-4 text-up-muted text-xs">
                        {{ $job->created_at->format('M d, Y') }}
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">

                            {{-- Status Update --}}
                            <form action="{{ route('admin.jobs.status', $job->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center gap-1">
                                    <select name="status"
                                        class="text-xs border border-up-border rounded-lg px-2 py-1.5 text-up-text focus:outline-none focus:ring-2 focus:ring-up-green/30 focus:border-up-green bg-white">
                                        <option value="active"  {{ $job->status === 'active'  ? 'selected' : '' }}>Active</option>
                                        <option value="closed"  {{ $job->status === 'closed'  ? 'selected' : '' }}>Closed</option>
                                        <option value="draft"   {{ $job->status === 'draft'   ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    <button type="submit"
                                        class="px-2.5 py-1.5 bg-up-light hover:bg-up-border text-up-badge rounded-lg text-xs font-semibold transition-colors">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </form>

                            {{-- Delete --}}
                            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete job listing \'{{ addslashes($job->title) }}\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg text-xs font-semibold transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center">
                        <div class="w-16 h-16 rounded-full bg-up-bg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-briefcase text-2xl text-up-border"></i>
                        </div>
                        <p class="font-semibold text-up-dark">No job listings found</p>
                        <p class="text-up-muted text-sm mt-1">Job listings will appear here once employers post them.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($jobs->hasPages())
    <div class="px-6 py-4 border-t border-up-border">
        {{ $jobs->links() }}
    </div>
    @endif
</div>

@endsection
