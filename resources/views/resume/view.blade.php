@extends('layouts.app')
@section('title', $resume->title . ' - ' . $resume->user->name . ' - Jobs.AF')
@section('content')

{{-- Print-only style: hide nav/footer when printing --}}
<style>
@media print {
    nav, footer, .no-print { display: none !important; }
    body { background: #fff !important; }
    .print-page { box-shadow: none !important; margin: 0 !important; max-width: 100% !important; }
}
</style>

{{-- Action bar --}}
<div class="no-print bg-up-bg border-b border-up-border py-3">
    <div class="max-w-4xl mx-auto px-4 flex items-center justify-between">
        <a href="{{ url()->previous() }}"
           class="text-up-text hover:text-up-green text-sm flex items-center gap-1.5 transition-colors">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <div class="flex items-center gap-3">
            @if(session('logged_in') && session('user_id') == $resume->user_id)
            <a href="{{ route('resume.edit', $resume->id) }}"
               class="text-sm text-up-green hover:text-up-green-hover border border-up-border hover:border-up-green px-3 py-1.5 rounded-xl transition-all flex items-center gap-1.5">
                <i class="fas fa-pencil-alt"></i> Edit
            </a>
            @endif
            <button onclick="window.print()"
                    class="text-sm text-up-text hover:text-up-green border border-up-border hover:border-up-green px-3 py-1.5 rounded-xl transition-all flex items-center gap-1.5">
                <i class="fas fa-print"></i> Print / Save PDF
            </button>
        </div>
    </div>
</div>

{{-- Resume document --}}
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white border border-up-border rounded-2xl print-page overflow-hidden">

        {{-- Header / Hero --}}
        <div class="bg-up-dark text-white px-8 py-10">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <div class="w-16 h-16 bg-white/10 border-2 border-white/20 rounded-full flex items-center justify-center text-2xl font-bold mb-3">
                        {{ strtoupper(substr($resume->user->name, 0, 1)) }}
                    </div>
                    <h1 class="text-3xl font-bold">{{ $resume->user->name }}</h1>
                    <p class="text-up-green text-lg mt-1 font-medium">{{ $resume->title }}</p>
                </div>
                <div class="text-up-muted text-sm space-y-1.5 md:text-right">
                    @if($resume->user->email)
                    <div class="flex md:justify-end items-center gap-2">
                        <i class="fas fa-envelope text-up-muted text-xs"></i>
                        <span>{{ $resume->user->email }}</span>
                    </div>
                    @endif
                    @if(!empty($resume->user->phone))
                    <div class="flex md:justify-end items-center gap-2">
                        <i class="fas fa-phone text-up-muted text-xs"></i>
                        <span>{{ $resume->user->phone }}</span>
                    </div>
                    @endif
                    @if(!empty($resume->user->location))
                    <div class="flex md:justify-end items-center gap-2">
                        <i class="fas fa-map-marker-alt text-up-muted text-xs"></i>
                        <span>{{ $resume->user->location }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="px-8 py-8 space-y-8">

            {{-- Summary --}}
            @if($resume->summary)
            <section>
                <h2 class="text-lg font-bold text-up-dark border-b-2 border-up-green pb-2 mb-3 flex items-center gap-2">
                    <i class="fas fa-user text-up-green text-base"></i> Professional Summary
                </h2>
                <p class="text-up-text leading-relaxed">{{ $resume->summary }}</p>
            </section>
            @endif

            {{-- Skills --}}
            @if(!empty($resume->skills))
            <section>
                <h2 class="text-lg font-bold text-up-dark border-b-2 border-up-green pb-2 mb-3 flex items-center gap-2">
                    <i class="fas fa-cogs text-up-green text-base"></i> Skills
                </h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($resume->skills as $skill)
                    <span class="bg-up-light text-up-text border border-up-border text-sm px-3 py-1 rounded-pill font-medium">
                        {{ $skill }}
                    </span>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Experience --}}
            @if(!empty($resume->experience))
            <section>
                <h2 class="text-lg font-bold text-up-dark border-b-2 border-up-green pb-2 mb-4 flex items-center gap-2">
                    <i class="fas fa-briefcase text-up-green text-base"></i> Work Experience
                </h2>
                <div class="space-y-6">
                    @foreach($resume->experience as $exp)
                    <div class="relative pl-5 border-l-2 border-up-border">
                        <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-up-green"></div>
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-1 mb-1">
                            <div>
                                <h3 class="font-bold text-up-dark text-base">{{ $exp['title'] ?? '' }}</h3>
                                <p class="text-up-dark font-medium text-sm">{{ $exp['company'] ?? '' }}</p>
                            </div>
                            <div class="text-up-muted text-xs sm:text-right shrink-0">
                                @if(!empty($exp['start_date']))
                                <span>{{ $exp['start_date'] }}</span>
                                <span class="mx-1">&ndash;</span>
                                <span>{{ !empty($exp['current']) ? 'Present' : ($exp['end_date'] ?? '') }}</span>
                                @endif
                                @if(!empty($exp['location']))
                                <div class="mt-0.5"><i class="fas fa-map-marker-alt text-xs"></i> {{ $exp['location'] }}</div>
                                @endif
                            </div>
                        </div>
                        @if(!empty($exp['description']))
                        <p class="text-up-text text-sm mt-2 leading-relaxed">{{ $exp['description'] }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Education --}}
            @if(!empty($resume->education))
            <section>
                <h2 class="text-lg font-bold text-up-dark border-b-2 border-up-green pb-2 mb-4 flex items-center gap-2">
                    <i class="fas fa-graduation-cap text-up-green text-base"></i> Education
                </h2>
                <div class="space-y-5">
                    @foreach($resume->education as $edu)
                    <div class="relative pl-5 border-l-2 border-up-border">
                        <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-up-green"></div>
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-1">
                            <div>
                                <h3 class="font-bold text-up-dark text-base">
                                    {{ $edu['degree'] ?? '' }}
                                    @if(!empty($edu['field']))
                                    <span class="font-normal text-up-text">in {{ $edu['field'] }}</span>
                                    @endif
                                </h3>
                                <p class="text-up-green font-medium text-sm">{{ $edu['institution'] ?? '' }}</p>
                                @if(!empty($edu['location']))
                                <p class="text-up-muted text-xs mt-0.5">
                                    <i class="fas fa-map-marker-alt text-xs"></i> {{ $edu['location'] }}
                                </p>
                                @endif
                            </div>
                            <div class="text-up-muted text-xs sm:text-right shrink-0">
                                @if(!empty($edu['start_year']))
                                {{ $edu['start_year'] }} &ndash; {{ $edu['end_year'] ?? 'Present' }}
                                @endif
                                @if(!empty($edu['gpa']))
                                <div class="mt-0.5 text-up-text">GPA: {{ $edu['gpa'] }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Languages --}}
            @if(!empty($resume->languages))
            <section>
                <h2 class="text-lg font-bold text-up-dark border-b-2 border-up-green pb-2 mb-4 flex items-center gap-2">
                    <i class="fas fa-language text-up-green text-base"></i> Languages
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($resume->languages as $lang)
                    <div class="border border-up-border rounded-xl px-4 py-3 text-center bg-up-bg-light">
                        <div class="font-semibold text-up-dark text-sm">{{ $lang['language'] ?? '' }}</div>
                        <div class="text-up-muted text-xs mt-0.5">{{ $lang['level'] ?? '' }}</div>
                        @php
                            $levelMap = ['Native' => 5, 'Fluent' => 4, 'Advanced' => 3, 'Conversational' => 2, 'Basic' => 1];
                            $dots = $levelMap[$lang['level'] ?? ''] ?? 0;
                        @endphp
                        <div class="flex justify-center gap-1 mt-2">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="w-2 h-2 rounded-full {{ $i <= $dots ? 'bg-up-green' : 'bg-up-border' }}"></div>
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Footer note --}}
            <div class="text-center text-up-muted text-xs pt-4 border-t border-up-border no-print">
                <i class="fas fa-file-alt mr-1"></i>
                Resume hosted on <span class="text-up-green font-medium">Jobs.AF</span> &middot;
                Last updated {{ $resume->updated_at->format('M d, Y') }}
            </div>

        </div>
    </div>
</div>

@endsection
