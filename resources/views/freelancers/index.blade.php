@extends('layouts.app')
@section('title', 'Browse Freelancers - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-1">Find Talented Freelancers</h1>
        <p class="text-up-muted">Hire skilled professionals for your projects</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($freelancers as $fl)
        <a href="{{ route('freelancers.show', $fl->id) }}"
           class="bg-white border border-up-border rounded-2xl p-6 text-center card-hover block transition-all">

            {{-- Avatar --}}
            <div class="w-20 h-20 bg-up-dark rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-4">
                {{ strtoupper(substr($fl->user->name, 0, 1)) }}
            </div>

            <h3 class="font-bold text-up-dark text-lg mb-1">{{ $fl->user->name }}</h3>
            <p class="text-up-green text-sm font-medium mb-3">{{ $fl->title ?? $fl->category }}</p>

            {{-- Star Rating --}}
            <div class="flex justify-center items-center mb-2">
                @for($i = 0; $i < 5; $i++)
                <span class="{{ $i < round($fl->rating) ? 'text-yellow-400' : 'text-up-border' }} text-base">&#9733;</span>
                @endfor
                <span class="text-up-muted text-xs ml-1.5">({{ $fl->total_reviews }})</span>
            </div>

            <p class="text-up-muted text-xs mb-3">{{ $fl->experience_years }} yrs experience &middot; {{ $fl->availability }}</p>

            {{-- Skills --}}
            <div class="flex flex-wrap justify-center gap-1.5 mb-4">
                @foreach(array_slice($fl->skills ?? [], 0, 3) as $skill)
                <span class="bg-up-light text-up-text text-xs px-3 py-1 rounded-pill">{{ $skill }}</span>
                @endforeach
            </div>

            <div class="text-up-dark font-bold border-t border-up-border pt-3">${{ $fl->hourly_rate }}/hr</div>
        </a>
        @endforeach
    </div>

    <div class="mt-8">{{ $freelancers->links() }}</div>
</div>
@endsection
