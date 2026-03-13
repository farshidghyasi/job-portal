@extends('layouts.app')
@section('title', 'Company Profile - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <p class="text-up-muted text-sm font-medium uppercase tracking-widest mb-1">Employer</p>
        <h1 class="text-3xl font-bold text-white">Company Profile</h1>
        <p class="text-up-muted mt-1">Manage your company information and contact details</p>
    </div>
</div>

<div class="bg-up-bg min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">

        @if(session('success'))
        <div class="bg-white border border-up-green/30 rounded-2xl p-4 mb-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-up-green/10 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-circle-check text-up-green"></i>
            </div>
            <p class="text-up-dark font-medium">{{ session('success') }}</p>
        </div>
        @endif

        <form action="{{ route('employer.profile.update') }}" method="POST">
            @csrf

            {{-- Personal Information --}}
            <div class="bg-white border border-up-border rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-user text-up-green"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-up-dark">Personal Information</h2>
                        <p class="text-up-muted text-xs">Your account details</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('name') border-red-400 @enderror"
                            placeholder="Your full name">
                        @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Email Address</label>
                        <input type="email" value="{{ $user->email }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 bg-up-bg text-up-muted cursor-not-allowed" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="+93 700 000 000">
                        @error('phone')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Location</label>
                        <input type="text" name="location" value="{{ old('location', $user->location) }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="Kabul, Afghanistan">
                        @error('location')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Company Information --}}
            <div class="bg-white border border-up-border rounded-2xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-building text-up-green"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-up-dark">Company Information</h2>
                        <p class="text-up-muted text-xs">Tell candidates about your organisation</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Company Name <span class="text-red-500">*</span></label>
                        <input type="text" name="company_name" value="{{ old('company_name', $user->employerProfile->company_name ?? '') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('company_name') border-red-400 @enderror"
                            placeholder="e.g. Acme Corporation">
                        @error('company_name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Company Description</label>
                        <textarea name="company_description" rows="4"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none"
                            placeholder="Describe what your company does, your mission, and culture...">{{ old('company_description', $user->employerProfile->company_description ?? '') }}</textarea>
                        @error('company_description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Industry</label>
                        <select name="industry" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="">Select Industry</option>
                            @foreach(['Information Technology', 'Healthcare', 'Construction', 'Education', 'Finance', 'Management', 'Design', 'Marketing', 'Other'] as $ind)
                            <option value="{{ $ind }}" {{ old('industry', $user->employerProfile->industry ?? '') === $ind ? 'selected' : '' }}>{{ $ind }}</option>
                            @endforeach
                        </select>
                        @error('industry')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Company Size</label>
                        <select name="company_size" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="">Select Size</option>
                            @foreach(['1-10', '11-50', '51-200', '201-500', '500+'] as $size)
                            <option value="{{ $size }}" {{ old('company_size', $user->employerProfile->company_size ?? '') === $size ? 'selected' : '' }}>{{ $size }} employees</option>
                            @endforeach
                        </select>
                        @error('company_size')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Founded Year</label>
                        <input type="number" name="founded_year" value="{{ old('founded_year', $user->employerProfile->founded_year ?? '') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="e.g. 2010" min="1900" max="{{ date('Y') }}">
                        @error('founded_year')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Website</label>
                        <input type="url" name="website" value="{{ old('website', $user->employerProfile->website ?? '') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="https://yourcompany.com">
                        @error('website')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">City</label>
                        <input type="text" name="city" value="{{ old('city', $user->employerProfile->city ?? '') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="Kabul">
                        @error('city')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Address</label>
                        <input type="text" name="address" value="{{ old('address', $user->employerProfile->address ?? '') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="Street address">
                        @error('address')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4">
                <button type="submit" class="btn-primary px-8 py-3 text-sm font-semibold">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>Save Changes
                </button>
                <a href="{{ route('employer.dashboard') }}" class="btn-outline px-8 py-3 text-sm font-semibold">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
