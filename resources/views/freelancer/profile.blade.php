@extends('layouts.app')
@section('title', 'Freelancer Profile - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <h1 class="text-2xl font-bold">My Freelancer Profile</h1>
        <p class="text-up-muted mt-1">Keep your profile up to date to attract more clients</p>
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
        <form action="{{ route('freelancer.profile.update') }}" method="POST">
            @csrf

            {{-- ---- Personal Information ---- --}}
            <h2 class="text-base font-bold text-up-dark mb-5 pb-3 border-b border-up-border flex items-center gap-2">
                <i class="fas fa-user text-up-green"></i> Personal Information
            </h2>

            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">Email Address</label>
                <input type="email" value="{{ $user->email }}"
                    class="w-full border border-up-border rounded-xl px-4 py-3 bg-up-bg text-up-muted cursor-not-allowed" disabled>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('phone') border-red-400 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location', $user->location) }}"
                        placeholder="e.g. Kabul, Afghanistan"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('location') border-red-400 @enderror">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ---- Professional Details ---- --}}
            <h2 class="text-base font-bold text-up-dark mb-5 pb-3 border-b border-up-border mt-8 flex items-center gap-2">
                <i class="fas fa-briefcase text-up-green"></i> Professional Details
            </h2>

            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">Professional Title</label>
                <input type="text" name="title" value="{{ old('title', $user->freelancerProfile->title ?? '') }}"
                    placeholder="e.g. Full Stack Developer, UI/UX Designer"
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('title') border-red-400 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">Bio</label>
                <textarea name="bio" rows="5"
                    placeholder="Describe your background, expertise, and what makes you stand out..."
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('bio') border-red-400 @enderror">{{ old('bio', $user->freelancerProfile->bio ?? '') }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">Skills</label>
                <input type="text" name="skills"
                    value="{{ old('skills', implode(', ', $user->freelancerProfile->skills ?? [])) }}"
                    placeholder="e.g. PHP, Laravel, Vue.js, MySQL"
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('skills') border-red-400 @enderror">
                <p class="text-up-muted text-xs mt-1">Separate skills with commas</p>
                @error('skills')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">Hourly Rate (USD)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-up-muted font-medium">$</span>
                        <input type="number" name="hourly_rate" min="1"
                            value="{{ old('hourly_rate', $user->freelancerProfile->hourly_rate ?? '') }}"
                            placeholder="25"
                            class="w-full border border-up-border rounded-xl pl-8 pr-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('hourly_rate') border-red-400 @enderror">
                    </div>
                    @error('hourly_rate')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">Availability</label>
                    <select name="availability"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('availability') border-red-400 @enderror">
                        <option value="available"  {{ old('availability', $user->freelancerProfile->availability ?? '') === 'available'   ? 'selected' : '' }}>Available</option>
                        <option value="busy"       {{ old('availability', $user->freelancerProfile->availability ?? '') === 'busy'       ? 'selected' : '' }}>Busy</option>
                        <option value="unavailable"{{ old('availability', $user->freelancerProfile->availability ?? '') === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                    @error('availability')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">Years of Experience</label>
                    <input type="number" name="experience_years" min="0"
                        value="{{ old('experience_years', $user->freelancerProfile->experience_years ?? '') }}"
                        placeholder="e.g. 3"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('experience_years') border-red-400 @enderror">
                    @error('experience_years')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">Category</label>
                    <select name="category"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('category') border-red-400 @enderror">
                        <option value="">-- Select Category --</option>
                        @foreach([
                            'Web Development', 'Mobile Development', 'Design', 'Marketing',
                            'Data Science', 'Writing', 'Translation', 'Video Production', 'Other'
                        ] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $user->freelancerProfile->category ?? '') === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ---- Links & Portfolio ---- --}}
            <h2 class="text-base font-bold text-up-dark mb-5 pb-3 border-b border-up-border mt-8 flex items-center gap-2">
                <i class="fas fa-link text-up-green"></i> Links &amp; Portfolio
            </h2>

            <div class="mb-5">
                <label class="block text-sm font-medium text-up-dark mb-2">
                    <i class="fas fa-briefcase text-up-muted mr-1"></i> Portfolio URL
                </label>
                <input type="url" name="portfolio_url"
                    value="{{ old('portfolio_url', $user->freelancerProfile->portfolio_url ?? '') }}"
                    placeholder="https://yourportfolio.com"
                    class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('portfolio_url') border-red-400 @enderror">
                @error('portfolio_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">
                        <i class="fab fa-github mr-1"></i> GitHub URL
                    </label>
                    <input type="url" name="github_url"
                        value="{{ old('github_url', $user->freelancerProfile->github_url ?? '') }}"
                        placeholder="https://github.com/username"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('github_url') border-red-400 @enderror">
                    @error('github_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">
                        <i class="fab fa-linkedin text-up-muted mr-1"></i> LinkedIn URL
                    </label>
                    <input type="url" name="linkedin_url"
                        value="{{ old('linkedin_url', $user->freelancerProfile->linkedin_url ?? '') }}"
                        placeholder="https://linkedin.com/in/username"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition-all @error('linkedin_url') border-red-400 @enderror">
                    @error('linkedin_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex gap-3">
                <button type="submit" class="btn-primary px-8 py-3 text-sm font-semibold">
                    <i class="fas fa-floppy-disk mr-2"></i>Save Changes
                </button>
                <a href="{{ route('freelancer.dashboard') }}" class="btn-outline px-8 py-3 text-sm font-semibold">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
