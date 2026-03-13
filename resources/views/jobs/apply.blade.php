@extends('layouts.app')
@section('title', 'Apply - ' . $job->title)
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-8">
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-2xl font-bold">Apply for: {{ $job->title }}</h1>
        <p class="text-green-100">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }} · {{ $job->location }}</p>
    </div>
</div>
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form action="{{ route('jobs.apply.store', $job->id) }}" method="POST">
            @csrf

            @if($resumes->count() > 0)
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Select Resume (Optional)</label>
                <select name="resume_id" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                    <option value="">-- No resume (cover letter only) --</option>
                    @foreach($resumes as $resume)
                    <option value="{{ $resume->id }}">{{ $resume->title }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-400 mt-1">Or <a href="{{ route('resume.create') }}" class="text-green-600 hover:underline">create a new resume</a></p>
            </div>
            @else
            <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                <p class="text-yellow-700 text-sm">You don't have a resume yet. <a href="{{ route('resume.create') }}" class="font-semibold hover:underline">Create one now</a> or continue with just a cover letter.</p>
            </div>
            @endif

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Cover Letter <span class="text-red-500">*</span></label>
                <textarea name="cover_letter" rows="8" placeholder="Tell the employer why you are the perfect candidate for this position. Mention your relevant experience, skills, and why you want to work at this company..." class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none @error('cover_letter') border-red-500 @enderror">{{ old('cover_letter') }}</textarea>
                @error('cover_letter')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                <p class="text-gray-400 text-xs mt-1">Minimum 50 characters</p>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('jobs.show', $job->id) }}" class="flex-1 border border-gray-300 text-gray-600 text-center py-3 rounded-xl font-medium hover:bg-gray-50 transition-all">Cancel</a>
                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition-all">Submit Application</button>
            </div>
        </form>
    </div>
</div>
@endsection
