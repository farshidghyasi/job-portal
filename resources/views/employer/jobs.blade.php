@extends('layouts.app')
@section('title', 'My Jobs - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-600 text-white py-8">
    <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">My Job Postings</h1>
        <a href="{{ route('employer.jobs.create') }}" class="bg-white text-blue-700 hover:bg-gray-100 px-5 py-2 rounded-xl font-semibold transition-all">+ Post New Job</a>
    </div>
</div>
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Job Title</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Type</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Applications</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($jobs as $job)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">{{ $job->title }}</div>
                        <div class="text-sm text-gray-400">{{ $job->location }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst(str_replace('-', ' ', $job->type)) }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('employer.jobs.applications', $job->id) }}" class="text-blue-600 hover:underline text-sm">{{ $job->applications_count }} applications</a>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full {{ $job->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ ucfirst($job->status) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('employer.jobs.edit', $job->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Delete this job?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">No jobs posted yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $jobs->links() }}</div>
</div>
@endsection
