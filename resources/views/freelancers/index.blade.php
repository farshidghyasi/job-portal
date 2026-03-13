@extends('layouts.app')
@section('title', 'Browse Freelancers - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Find Talented Freelancers</h1>
        <p class="text-indigo-200">Hire skilled professionals for your projects</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($freelancers as $fl)
        <a href="{{ route('freelancers.show', $fl->id) }}" class="bg-white card-hover rounded-xl p-6 text-center shadow-sm border border-gray-100 block">
            <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-4">
                {{ strtoupper(substr($fl->user->name, 0, 1)) }}
            </div>
            <h3 class="font-bold text-gray-800 text-lg">{{ $fl->user->name }}</h3>
            <p class="text-purple-600 text-sm font-medium mb-2">{{ $fl->title ?? $fl->category }}</p>
            <div class="flex justify-center items-center text-yellow-500 mb-2">
                @for($i = 0; $i < 5; $i++)
                <span>{{ $i < round($fl->rating) ? '★' : '☆' }}</span>
                @endfor
                <span class="text-gray-400 text-xs ml-1">({{ $fl->total_reviews }})</span>
            </div>
            <p class="text-gray-400 text-xs mb-3">{{ $fl->experience_years }} yrs experience · {{ $fl->availability }}</p>
            <div class="flex flex-wrap justify-center gap-1 mb-3">
                @foreach(array_slice($fl->skills ?? [], 0, 3) as $skill)
                <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $skill }}</span>
                @endforeach
            </div>
            <div class="text-green-600 font-bold">${{ $fl->hourly_rate }}/hr</div>
        </a>
        @endforeach
    </div>
    <div class="mt-8">{{ $freelancers->links() }}</div>
</div>
@endsection
