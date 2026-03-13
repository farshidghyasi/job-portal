@extends('layouts.app')
@section('title', 'Edit Freelance Project - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <a href="{{ route('employer.freelance.index') }}" class="inline-flex items-center gap-2 text-up-muted hover:text-white text-sm mb-3 transition-colors">
            <i class="fa-solid fa-arrow-left text-xs"></i> My Projects
        </a>
        <p class="text-up-muted text-sm font-medium uppercase tracking-widest mb-1">Employer</p>
        <h1 class="text-3xl font-bold text-white">Edit Project</h1>
        <p class="text-up-muted mt-1 truncate">{{ $job->title }}</p>
    </div>
</div>

<div class="bg-up-bg min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <form action="{{ route('employer.freelance.update', $job->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Project Details --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-info text-up-green"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-up-dark">Project Details</h2>
                        <p class="text-up-muted text-xs">Update your project information</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Project Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}"
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
                            <option value="{{ $cat }}" {{ old('category', $job->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Status</label>
                        <select name="status" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="active" {{ old('status', $job->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="closed" {{ old('status', $job->status) === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Location Type</label>
                        <select name="location_type" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="remote" {{ old('location_type', $job->location_type) === 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="onsite" {{ old('location_type', $job->location_type) === 'onsite' ? 'selected' : '' }}>On-site</option>
                            <option value="hybrid" {{ old('location_type', $job->location_type) === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('location_type')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Project Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="6"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none @error('description') border-red-400 @enderror"
                            placeholder="Describe your project in detail (minimum 50 characters)...">{{ old('description', $job->description) }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Required Skills</label>
                        <input type="text" name="skills_required"
                            value="{{ old('skills_required', implode(', ', $job->skills_required ?? [])) }}"
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
                        <p class="text-up-muted text-xs">Update your budget range and timeline</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Budget Type</label>
                        <select name="budget_type" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="fixed" {{ old('budget_type', $job->budget_type) === 'fixed' ? 'selected' : '' }}>Fixed Price</option>
                            <option value="hourly" {{ old('budget_type', $job->budget_type) === 'hourly' ? 'selected' : '' }}>Hourly Rate</option>
                        </select>
                        @error('budget_type')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Duration</label>
                        <input type="text" name="duration" value="{{ old('duration', $job->duration) }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20"
                            placeholder="e.g. 2 weeks, 1 month">
                        @error('duration')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Minimum Budget (USD)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-up-muted font-medium">$</span>
                            <input type="number" name="budget_min" value="{{ old('budget_min', $job->budget_min) }}" min="0"
                                class="w-full border border-up-border rounded-xl pl-8 pr-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('budget_min') border-red-400 @enderror">
                        </div>
                        @error('budget_min')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Maximum Budget (USD)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-up-muted font-medium">$</span>
                            <input type="number" name="budget_max" value="{{ old('budget_max', $job->budget_max) }}" min="0"
                                class="w-full border border-up-border rounded-xl pl-8 pr-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('budget_max') border-red-400 @enderror">
                        </div>
                        @error('budget_max')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Application Deadline</label>
                        <input type="date" name="deadline"
                            value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                        @error('deadline')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4 pb-4">
                <a href="{{ route('employer.freelance.index') }}" class="btn-outline px-8 py-3 text-sm font-semibold">Cancel</a>
                <button type="submit" class="btn-primary px-8 py-3 text-sm font-semibold">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>Update Project
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
