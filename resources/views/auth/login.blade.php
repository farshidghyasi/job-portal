@extends('layouts.app')
@section('title', 'Log In - Jobs.AF')
@section('content')

<div class="min-h-screen bg-up-bg flex items-center justify-center py-16 px-4">
    <div class="w-full max-w-md">

        {{-- Page heading --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block mb-6">
                <span class="text-up-dark font-extrabold text-3xl tracking-tight">jobs<span class="text-up-green">.af</span></span>
            </a>
            <h1 class="text-2xl font-bold text-up-dark">Welcome back</h1>
            <p class="text-up-text mt-1 text-[15px]">Log in to your Jobs.AF account</p>
        </div>

        {{-- Demo credentials info card --}}
        <div class="bg-white border border-up-border rounded-2xl p-5 mb-6">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-7 h-7 rounded-full bg-up-green/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-key text-up-green text-xs"></i>
                </span>
                <p class="text-up-dark font-semibold text-sm">Demo Credentials</p>
            </div>
            <div class="space-y-1.5 text-[13px] text-up-text pl-9">
                <p><span class="font-medium text-up-dark">Job Seeker:</span> khalid@gmail.com / password</p>
                <p><span class="font-medium text-up-dark">Employer:</span> ahmad@techcorp.af / password</p>
                <p><span class="font-medium text-up-dark">Freelancer:</span> bilal@gmail.com / password</p>
                <p>
                    <span class="font-medium text-up-dark">Admin:</span> admin@jobs.af / password &rarr;
                    <a href="{{ route('admin.login') }}" class="text-up-green hover:text-up-green-hover font-medium underline underline-offset-2">Admin Panel</a>
                </p>
            </div>
        </div>

        {{-- Login card --}}
        <div class="bg-white border border-up-border rounded-2xl p-8">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <div class="mb-5">
                    <label class="block text-up-dark font-medium text-sm mb-1.5" for="email">Email address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        placeholder="you@example.com"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition @error('email') border-red-400 @enderror"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-7">
                    <label class="block text-up-dark font-medium text-sm mb-1.5" for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition"
                    >
                </div>

                <button type="submit" class="btn-primary w-full py-3 text-[15px] font-semibold">
                    Log In
                </button>
            </form>

            <p class="text-center text-up-text text-sm mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-up-green hover:text-up-green-hover font-semibold">Sign up for free</a>
            </p>
        </div>

    </div>
</div>

@endsection
