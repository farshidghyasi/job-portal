@extends('layouts.app')
@section('title', 'Post a Job - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-600 text-white py-8">
    <div class="max-w-4xl mx-auto px-4"><h1 class="text-2xl font-bold">Post a New Job</h1></div>
</div>
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ route('employer.jobs.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none @error('title') border-red-500 @enderror" placeholder="e.g. Senior Software Engineer">
                    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Select Category</option>
                        @foreach(['Information Technology', 'Healthcare', 'Engineering', 'Education', 'Finance', 'Management', 'Design', 'Marketing', 'Human Resources', 'Administration', 'Customer Service', 'Logistics'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Job Type <span class="text-red-500">*</span></label>
                    <select name="type" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="internship">Internship</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Kabul, Afghanistan" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Experience Level</label>
                    <select name="experience_level" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="entry">Entry Level</option>
                        <option value="mid" selected>Mid Level</option>
                        <option value="senior">Senior Level</option>
                        <option value="executive">Executive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Minimum Salary (USD/mo)</label>
                    <input type="number" name="salary_min" value="{{ old('salary_min') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Maximum Salary (USD/mo)</label>
                    <input type="number" name="salary_max" value="{{ old('salary_max') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Application Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Job Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="6" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none @error('description') border-red-500 @enderror" placeholder="Describe the role, responsibilities, and what you expect from candidates...">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Requirements</label>
                <textarea name="requirements" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="List the required qualifications, skills, and experience...">{{ old('requirements') }}</textarea>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Benefits</label>
                <textarea name="benefits" rows="3" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Health insurance, annual leave, professional development...">{{ old('benefits') }}</textarea>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('employer.jobs') }}" class="border border-gray-300 text-gray-600 px-8 py-3 rounded-xl hover:bg-gray-50">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition-all">Post Job</button>
            </div>
        </form>
    </div>
</div>
@endsection
