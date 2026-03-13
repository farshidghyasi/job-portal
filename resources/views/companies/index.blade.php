@extends('layouts.app')
@section('title', 'Companies - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-1">Browse Companies</h1>
        <p class="text-up-muted">Explore top employers in Afghanistan</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($companies as $company)
        <a href="{{ route('companies.show', $company->id) }}"
           class="bg-white border border-up-border rounded-2xl p-6 card-hover block transition-all">

            <div class="flex items-center gap-4 mb-4">
                {{-- Logo / Initial --}}
                <div class="w-14 h-14 bg-up-dark rounded-xl flex items-center justify-center text-white text-2xl font-bold flex-shrink-0">
                    {{ strtoupper(substr($company->company_name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-up-dark truncate">{{ $company->company_name }}</h3>
                    <p class="text-up-text text-sm">{{ $company->industry }}</p>
                </div>
            </div>

            <p class="text-up-text text-sm mb-4 leading-relaxed">{{ Str::limit($company->company_description, 100) }}</p>

            <div class="border-t border-up-border pt-4 flex justify-between text-sm text-up-muted">
                <span><i class="fas fa-map-marker-alt mr-1 text-up-green"></i>{{ $company->city }}, {{ $company->country }}</span>
                <span><i class="fas fa-users mr-1"></i>{{ $company->company_size ?? 'N/A' }}</span>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-8">{{ $companies->links() }}</div>
</div>
@endsection
