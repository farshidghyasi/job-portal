@extends('layouts.app')
@section('title', 'Edit Job - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-600 text-white py-8">
    <div class="max-w-4xl mx-auto px-4"><h1 class="text-2xl font-bold">Edit Job: {{ $job->title }}</h1></div>
</div>
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Job Title</label>
                    <input type="text" name="title" value="{{ old('title', $job->title) }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                        @foreach(['Information Technology', 'Healthcare', 'Engineering', 'Education', 'Finance', 'Management', 'Design', 'Marketing', 'Human Resources', 'Administration', 'Customer Service', 'Logistics'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $job->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="active" {{ $job->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="closed" {{ $job->status === 'closed' ? 'selected' : '' }}>Closed</option>
                        <option value="draft" {{ $job->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location', $job->location) }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Salary Min (USD)</label>
                    <input type="number" name="salary_min" value="{{ old('salary_min', $job->salary_min) }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Salary Max (USD)</label>
                    <input type="number" name="salary_max" value="{{ old('salary_max', $job->salary_max) }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Job Description</label>
                <textarea name="description" rows="6" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('description', $job->description) }}</textarea>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Requirements</label>
                <textarea name="requirements" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('requirements', $job->requirements) }}</textarea>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('employer.jobs') }}" class="border border-gray-300 text-gray-600 px-8 py-3 rounded-xl hover:bg-gray-50">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold">Update Job</button>
            </div>
        </form>
    </div>
</div>
@endsection
