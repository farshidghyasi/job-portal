@extends('layouts.app')
@section('title', 'Saved Jobs - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-8">
    <div class="max-w-5xl mx-auto px-4"><h1 class="text-2xl font-bold">Saved Jobs</h1></div>
</div>
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="space-y-4">
        @forelse($savedJobs as $job)
        <div class="bg-white rounded-xl shadow-sm p-6 flex flex-col md:flex-row justify-between items-start">
            <div>
                <h3 class="text-lg font-bold text-gray-800">{{ $job->title }}</h3>
                <p class="text-gray-500">{{ $job->employer->employerProfile->company_name ?? $job->employer->name }} · {{ $job->location }}</p>
                <p class="text-green-600 font-medium">${{ number_format($job->salary_min) }}-${{ number_format($job->salary_max) }}/mo</p>
            </div>
            <div class="mt-4 md:mt-0 flex gap-2">
                <a href="{{ route('jobs.show', $job->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">View Job</a>
                <form action="{{ route('jobseeker.save-job', $job->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="border border-red-300 text-red-500 hover:bg-red-50 px-4 py-2 rounded-lg text-sm">Remove</button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center py-16"><div class="text-6xl mb-4">🔖</div><h3 class="text-xl text-gray-600">No saved jobs</h3><a href="{{ route('jobs.index') }}" class="mt-4 inline-block text-green-600">Browse jobs →</a></div>
        @endforelse
    </div>
    <div class="mt-6">{{ $savedJobs->links() }}</div>
</div>
@endsection
