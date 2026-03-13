@extends('layouts.app')
@section('title', 'Companies - Jobs.AF')
@section('content')
<div class="bg-gradient-to-r from-green-700 to-green-600 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold">Browse Companies</h1>
        <p class="text-green-100 mt-1">Explore top employers in Afghanistan</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($companies as $company)
        <a href="{{ route('companies.show', $company->id) }}" class="bg-white card-hover rounded-xl p-6 shadow-sm border border-gray-100 block">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($company->company_name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">{{ $company->company_name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $company->industry }}</p>
                </div>
            </div>
            <p class="text-gray-500 text-sm mb-3">{{ Str::limit($company->company_description, 100) }}</p>
            <div class="flex justify-between text-sm text-gray-400">
                <span>📍 {{ $company->city }}, {{ $company->country }}</span>
                <span>👥 {{ $company->company_size ?? 'N/A' }}</span>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-8">{{ $companies->links() }}</div>
</div>
@endsection
