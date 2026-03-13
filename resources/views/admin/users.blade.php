@extends('layouts.admin')

@section('title', 'Users - Admin Panel')
@section('page-title', 'Manage Users')
@section('page-subtitle', 'View and manage all registered users')

@section('content')

<div class="bg-white rounded-2xl border border-up-border overflow-hidden">

    {{-- Table Header --}}
    <div class="px-6 py-5 border-b border-up-border flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-up-dark">All Users</h2>
            <p class="text-up-muted text-xs mt-0.5">{{ $users->total() }} total users &mdash; Page {{ $users->currentPage() }} of {{ $users->lastPage() }}</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 bg-up-light text-up-badge text-xs font-semibold px-3 py-1.5 rounded-pill">
                <i class="fas fa-users text-[10px]"></i>
                {{ $users->total() }} Members
            </span>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-up-bg-light border-b border-up-border">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">User</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Joined</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-up-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-up-border">
                @forelse($users as $user)
                <tr class="hover:bg-up-bg-light transition-colors group">

                    {{-- User Info --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-up-light border border-up-border flex items-center justify-center shrink-0">
                                <span class="text-up-badge font-bold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <div class="font-semibold text-up-dark">{{ $user->name }}</div>
                                <div class="text-up-muted text-xs">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>

                    {{-- Role --}}
                    <td class="px-6 py-4">
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

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        @if($user->status === 'active')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-pill text-xs font-semibold bg-[#dff5d8] text-up-badge">
                                <span class="w-1.5 h-1.5 rounded-full bg-up-green inline-block"></span>Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-pill text-xs font-semibold bg-red-100 text-red-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>Inactive
                            </span>
                        @endif
                    </td>

                    {{-- Joined --}}
                    <td class="px-6 py-4 text-up-muted text-xs">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">

                            {{-- View --}}
                            <a href="{{ route('admin.users.show', $user->id) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-up-light hover:bg-up-border text-up-badge rounded-lg text-xs font-semibold transition-colors">
                                <i class="fas fa-eye"></i> View
                            </a>

                            {{-- Toggle Status --}}
                            <form action="{{ route('admin.users.status', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{ $user->status === 'active' ? 'inactive' : 'active' }}">
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors
                                        {{ $user->status === 'active'
                                            ? 'bg-orange-50 hover:bg-orange-100 text-orange-700'
                                            : 'bg-up-light hover:bg-up-border text-up-badge' }}">
                                    @if($user->status === 'active')
                                        <i class="fas fa-ban"></i> Deactivate
                                    @else
                                        <i class="fas fa-check-circle"></i> Activate
                                    @endif
                                </button>
                            </form>

                            {{-- Delete --}}
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete user {{ addslashes($user->name) }}? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg text-xs font-semibold transition-colors">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="w-16 h-16 rounded-full bg-up-bg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-2xl text-up-border"></i>
                        </div>
                        <p class="font-semibold text-up-dark">No users found</p>
                        <p class="text-up-muted text-sm mt-1">Users will appear here once registered.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-up-border">
        {{ $users->links() }}
    </div>
    @endif
</div>

@endsection
