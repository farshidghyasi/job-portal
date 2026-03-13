@extends('layouts.app')
@section('title', 'My Profile - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <h1 class="text-2xl font-bold">My Profile</h1>
        <p class="text-up-muted mt-1">Manage your personal information</p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">

    {{-- Success Message --}}
    @if(session('success'))
    <div class="bg-[#dff5d8] border border-[#b4e6a5] rounded-2xl p-4 mb-6 flex items-center gap-3">
        <i class="fas fa-circle-check text-up-green text-lg"></i>
        <p class="text-up-dark font-medium text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white border border-up-border rounded-2xl p-8">
        <form action="{{ route('jobseeker.profile.update') }}" method="POST">
            @csrf

            {{-- Full Name --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    placeholder="Your full name"
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email (read-only) --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">Email Address</label>
                <input type="email" value="{{ $user->email }}"
                    class="w-full border border-up-border rounded-xl px-4 py-3 bg-up-bg text-up-muted cursor-not-allowed" disabled>
                <p class="text-up-muted text-xs mt-1">Email cannot be changed here</p>
            </div>

            {{-- Phone --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                    placeholder="+93 700 000 000"
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('phone') border-red-400 @enderror">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Location --}}
            <div class="mb-8">
                <label class="block text-sm font-medium text-up-dark mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location', $user->location) }}"
                    placeholder="Kabul, Afghanistan"
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('location') border-red-400 @enderror">
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex gap-3">
                <button type="submit" class="btn-primary px-8 py-3 text-sm font-semibold">
                    <i class="fas fa-floppy-disk mr-2"></i>Save Changes
                </button>
                <a href="{{ route('resume.index') }}" class="btn-outline px-8 py-3 text-sm font-semibold">
                    <i class="fas fa-file-lines mr-2"></i>Manage Resumes
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
