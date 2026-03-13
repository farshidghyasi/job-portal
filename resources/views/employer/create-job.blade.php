@extends('layouts.app')
@section('title', 'Post a Job - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <p class="text-up-muted text-sm font-medium uppercase tracking-widest mb-1">Employer</p>
        <h1 class="text-3xl font-bold text-white">Post a New Job</h1>
        <p class="text-up-muted mt-1">Fill in the details below to attract the right candidates</p>
    </div>
</div>

<div class="bg-up-bg min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <form action="{{ route('employer.jobs.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Basic Information --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-info text-up-green"></i>
                    </div>
                    <h2 class="text-base font-bold text-up-dark">Basic Information</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-up-dark mb-2">Job Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('title') border-red-400 @enderror"
                            placeholder="e.g. Senior Software Engineer">
                        @error('title')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Category <span class="text-red-500">*</span></label>
                        <select name="category" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="">Select Category</option>
                            @foreach(['Information Technology', 'Healthcare', 'Engineering', 'Education', 'Finance', 'Management', 'Design', 'Marketing', 'Human Resources', 'Administration', 'Customer Service', 'Logistics'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Job Type <span class="text-red-500">*</span></label>
                        <select name="type" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="full-time" {{ old('type') === 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ old('type') === 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ old('type') === 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="internship" {{ old('type') === 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Work Arrangement <span class="text-red-500">*</span></label>
                        <select name="work_arrangement" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="onsite" {{ old('work_arrangement') === 'onsite' ? 'selected' : '' }}>On-site</option>
                            <option value="remote" {{ old('work_arrangement') === 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ old('work_arrangement') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Number of Vacancies</label>
                        <input type="number" name="num_vacancies" value="{{ old('num_vacancies', 1) }}" min="1"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Gender Preference</label>
                        <select name="gender_preference" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="any" {{ old('gender_preference') === 'any' ? 'selected' : '' }}>Any</option>
                            <option value="male" {{ old('gender_preference') === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender_preference') === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Application Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                    </div>
                </div>
            </div>

            {{-- Location --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-location-dot text-up-green"></i>
                    </div>
                    <h2 class="text-base font-bold text-up-dark">Location</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Country <span class="text-red-500">*</span></label>
                        <select name="country" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="">Select Country</option>
                            <option value="Afghanistan" {{ old('country') === 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                            <option value="Pakistan" {{ old('country') === 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                            <option value="Iran" {{ old('country') === 'Iran' ? 'selected' : '' }}>Iran</option>
                            <option value="Turkey" {{ old('country') === 'Turkey' ? 'selected' : '' }}>Turkey</option>
                            <option value="UAE" {{ old('country') === 'UAE' ? 'selected' : '' }}>UAE</option>
                            <option value="India" {{ old('country') === 'India' ? 'selected' : '' }}>India</option>
                            <option value="Other" {{ old('country') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Province / Region</label>
                        <input type="text" name="province" value="{{ old('province') }}"
                            placeholder="e.g. Kabul, Herat, Balkh"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">City / Address</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                            placeholder="e.g. Kabul City, District 4"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                    </div>
                </div>
            </div>

            {{-- Experience & Education --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-graduation-cap text-up-green"></i>
                    </div>
                    <h2 class="text-base font-bold text-up-dark">Experience &amp; Education</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Experience Level</label>
                        <select name="experience_level" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="entry" {{ old('experience_level') === 'entry' ? 'selected' : '' }}>Entry Level</option>
                            <option value="mid" {{ old('experience_level', 'mid') === 'mid' ? 'selected' : '' }}>Mid Level</option>
                            <option value="senior" {{ old('experience_level') === 'senior' ? 'selected' : '' }}>Senior Level</option>
                            <option value="executive" {{ old('experience_level') === 'executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Years of Experience</label>
                        <select name="years_of_experience" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="">Not specified</option>
                            @foreach(['Less than 1 year', '1-2 years', '2-3 years', '3-5 years', '5-7 years', '7-10 years', '10+ years'] as $yr)
                            <option value="{{ $yr }}" {{ old('years_of_experience') === $yr ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Education Level</label>
                        <select name="education_level" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="">Not specified</option>
                            @foreach(["High School", "Diploma", "Bachelor's", "Master's", "PhD", "Other"] as $edu)
                            <option value="{{ $edu }}" {{ old('education_level') === $edu ? 'selected' : '' }}>{{ $edu }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Salary --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-coins text-up-green"></i>
                    </div>
                    <h2 class="text-base font-bold text-up-dark">Salary</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Currency</label>
                        <select name="salary_currency" class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                            <option value="AFN" {{ old('salary_currency') === 'AFN' ? 'selected' : '' }}>AFN (Afghani)</option>
                            <option value="USD" {{ old('salary_currency', 'USD') === 'USD' ? 'selected' : '' }}>USD (Dollar)</option>
                            <option value="EUR" {{ old('salary_currency') === 'EUR' ? 'selected' : '' }}>EUR (Euro)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Minimum Salary (monthly)</label>
                        <input type="number" name="salary_min" value="{{ old('salary_min') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Maximum Salary (monthly)</label>
                        <input type="number" name="salary_max" value="{{ old('salary_max') }}"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                    </div>
                </div>
            </div>

            {{-- Job Details --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-file-lines text-up-green"></i>
                    </div>
                    <h2 class="text-base font-bold text-up-dark">Job Details</h2>
                </div>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Job Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="5"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none @error('description') border-red-400 @enderror"
                            placeholder="Describe the role and what you expect from candidates...">{{ old('description') }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Responsibilities</label>
                        <textarea name="responsibilities" rows="4"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none"
                            placeholder="List the key responsibilities for this role (one per line)...">{{ old('responsibilities') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Requirements</label>
                        <textarea name="requirements" rows="4"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none"
                            placeholder="List the required qualifications and experience...">{{ old('requirements') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Skills --}}
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-6 pb-5 border-b border-up-border">
                    <div class="w-9 h-9 bg-up-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-tags text-up-green"></i>
                    </div>
                    <h2 class="text-base font-bold text-up-dark">Skills &amp; Benefits</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Required Skills</label>
                        <input type="text" name="skills_required" value="{{ old('skills_required') }}"
                            placeholder="e.g. PHP, Laravel, MySQL (comma-separated)"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                        <p class="text-up-muted text-xs mt-1.5">Separate skills with commas</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-up-dark mb-2">Preferred Skills</label>
                        <input type="text" name="skills_preferred" value="{{ old('skills_preferred') }}"
                            placeholder="e.g. Docker, AWS, Redis (comma-separated)"
                            class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20">
                        <p class="text-up-muted text-xs mt-1.5">Nice-to-have skills, separated with commas</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-up-dark mb-2">Benefits</label>
                    <textarea name="benefits" rows="3"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none"
                        placeholder="Health insurance, annual leave, professional development...">{{ old('benefits') }}</textarea>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-4 pb-4">
                <a href="{{ route('employer.jobs') }}" class="btn-outline px-8 py-3 text-sm font-semibold">Cancel</a>
                <button type="submit" class="btn-primary px-8 py-3 text-sm font-semibold">Post Job</button>
            </div>
        </form>
    </div>
</div>

@endsection
