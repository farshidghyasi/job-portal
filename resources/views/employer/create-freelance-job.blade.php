@extends('layouts.app')
@section('title', 'Post Freelance Project - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <p class="text-up-muted text-sm font-medium uppercase tracking-widest mb-1">Employer</p>
        <h1 class="text-3xl font-bold text-white">Post a Freelance Project</h1>
        <p class="text-up-muted mt-1">Find the right freelancer for your project</p>
    </div>
</div>

<div class="bg-up-bg min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <form action="{{ route('employer.freelance.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Project Details --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-info text-up-green"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-up-dark">Project Details</h2>
                        <p class="text-up-muted text-xs">Describe your project clearly to attract the best talent</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Project Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('title') border-red-400 @enderror"
                            placeholder="e.g. Build a responsive e-commerce website">
                        @error('title')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Category <span class="text-red-500">*</span></label>
                        <select name="category"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('category') border-red-400 @enderror">
                            <option value="">Select Category</option>
                            @foreach(['Web Development', 'Mobile Development', 'Design', 'Marketing', 'Data Science', 'Writing', 'Translation', 'Video Production', 'Other'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Location Type <span class="text-red-500">*</span></label>
                        <select name="location_type" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="remote" {{ old('location_type', 'remote') === 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="onsite" {{ old('location_type') === 'onsite' ? 'selected' : '' }}>On-site</option>
                            <option value="hybrid" {{ old('location_type') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('location_type')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Project Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="6"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none @error('description') border-red-400 @enderror"
                            placeholder="Describe your project in detail (minimum 50 characters). Include goals, deliverables, and any specific requirements...">{{ old('description') }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Required Skills</label>
                        <input type="text" name="skills_required" value="{{ old('skills_required') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="e.g. Laravel, Vue.js, MySQL (comma-separated)">
                        <p class="text-up-muted text-xs mt-1.5">Separate skills with commas</p>
                        @error('skills_required')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Budget & Timeline --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-coins text-up-green"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-up-dark">Budget &amp; Timeline</h2>
                        <p class="text-up-muted text-xs">Set your budget range to attract qualified freelancers</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Budget Type <span class="text-red-500">*</span></label>
                        <select name="budget_type" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="fixed" {{ old('budget_type', 'fixed') === 'fixed' ? 'selected' : '' }}>Fixed Price</option>
                            <option value="hourly" {{ old('budget_type') === 'hourly' ? 'selected' : '' }}>Hourly Rate</option>
                        </select>
                        @error('budget_type')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Duration</label>
                        <input type="text" name="duration" value="{{ old('duration') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="e.g. 2 weeks, 1 month">
                        @error('duration')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Minimum Budget (USD) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-up-muted font-medium">$</span>
                            <input type="number" name="budget_min" value="{{ old('budget_min') }}" min="0"
                                class="w-full border border-up-border rounded-xl pl-8 pr-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('budget_min') border-red-400 @enderror"
                                placeholder="500">
                        </div>
                        @error('budget_min')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Maximum Budget (USD) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-up-muted font-medium">$</span>
                            <input type="number" name="budget_max" value="{{ old('budget_max') }}" min="0"
                                class="w-full border border-up-border rounded-xl pl-8 pr-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('budget_max') border-red-400 @enderror"
                                placeholder="2000">
                        </div>
                        @error('budget_max')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Application Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            min="{{ date('Y-m-d') }}">
                        @error('deadline')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4 pb-4">
                <a href="{{ route('employer.freelance.index') }}" class="btn-outline px-8 py-3 text-sm font-semibold">Cancel</a>
                <button type="submit" class="btn-primary px-8 py-3 text-sm font-semibold">
                    <i class="fa-solid fa-paper-plane mr-2"></i>Post Project
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
