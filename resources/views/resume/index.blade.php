@extends('layouts.app')
@section('title', 'My Resumes - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-10">
    <div class="max-w-5xl mx-auto px-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">My Resumes</h1>
            <p class="text-up-muted mt-1">Manage and share your professional resumes</p>
        </div>
        <a href="{{ route('resume.create') }}" class="btn-primary px-5 py-2.5 font-semibold flex items-center gap-2">
            <i class="fas fa-plus"></i> Create New Resume
        </a>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">

    @if(session('success'))
    <div class="bg-up-bg border border-up-border rounded-2xl p-4 mb-6 flex items-center gap-3">
        <i class="fas fa-check-circle text-up-green text-lg flex-shrink-0"></i>
        <p class="text-up-dark font-medium">{{ session('success') }}</p>
    </div>
    @endif

    @if($resumes->isEmpty())
    <div class="bg-white border border-up-border rounded-2xl p-16 text-center">
        <div class="w-20 h-20 bg-up-light rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-file-alt text-3xl text-up-muted"></i>
        </div>
        <h2 class="text-xl font-bold text-up-dark mb-2">No Resumes Yet</h2>
        <p class="text-up-text mb-6">Create your first professional resume to start applying for jobs.</p>
        <a href="{{ route('resume.create') }}" class="btn-primary px-6 py-3 font-semibold inline-flex items-center gap-2">
            <i class="fas fa-plus"></i> Create Your First Resume
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 gap-5">
        @foreach($resumes as $resume)
        <div class="bg-white border border-up-border rounded-2xl p-6 card-hover transition-all">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        <h2 class="text-lg font-bold text-up-dark truncate">{{ $resume->title }}</h2>
                        @if($resume->is_public)
                        <span class="shrink-0 bg-up-bg border border-up-border text-up-green text-xs font-medium px-2.5 py-0.5 rounded-pill flex items-center gap-1">
                            <i class="fas fa-globe-asia text-xs"></i> Public
                        </span>
                        @else
                        <span class="shrink-0 bg-up-light text-up-muted text-xs font-medium px-2.5 py-0.5 rounded-pill flex items-center gap-1">
                            <i class="fas fa-lock text-xs"></i> Private
                        </span>
                        @endif
                    </div>

                    @if($resume->summary)
                    <p class="text-up-text text-sm mb-3 line-clamp-2">{{ Str::limit($resume->summary, 160) }}</p>
                    @endif

                    @if(!empty($resume->skills))
                    <div class="flex flex-wrap gap-1.5 mb-3">
                        @foreach(array_slice($resume->skills, 0, 6) as $skill)
                        <span class="bg-up-light text-up-text text-xs px-2.5 py-1 rounded-pill font-medium">{{ $skill }}</span>
                        @endforeach
                        @if(count($resume->skills) > 6)
                        <span class="text-up-muted text-xs px-2 py-1">+{{ count($resume->skills) - 6 }} more</span>
                        @endif
                    </div>
                    @endif

                    <p class="text-up-muted text-xs flex items-center gap-1.5">
                        <i class="fas fa-clock"></i>
                        Created {{ $resume->created_at->format('M d, Y') }}
                        @if($resume->updated_at != $resume->created_at)
                        &middot; Updated {{ $resume->updated_at->diffForHumans() }}
                        @endif
                    </p>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('resume.view', $resume->id) }}"
                       class="inline-flex items-center gap-1.5 text-sm text-up-text hover:text-up-green border border-up-border hover:border-up-green px-3 py-2 rounded-xl transition-all"
                       title="View Resume">
                        <i class="fas fa-eye"></i>
                        <span class="hidden sm:inline">View</span>
                    </a>
                    <a href="{{ route('resume.edit', $resume->id) }}"
                       class="inline-flex items-center gap-1.5 text-sm text-up-green hover:text-up-green-hover border border-up-border hover:border-up-green px-3 py-2 rounded-xl transition-all"
                       title="Edit Resume">
                        <i class="fas fa-pencil-alt"></i>
                        <span class="hidden sm:inline">Edit</span>
                    </a>
                    <form action="{{ route('resume.destroy', $resume->id) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this resume? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 text-sm text-red-500 hover:text-red-700 border border-red-200 hover:border-red-400 px-3 py-2 rounded-xl transition-all"
                                title="Delete Resume">
                            <i class="fas fa-trash-alt"></i>
                            <span class="hidden sm:inline">Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection
