@extends('layouts.app')
@section('title', 'Create Account - Jobs.AF')
@section('content')

<div class="min-h-screen bg-up-bg py-16 px-4">
    <div class="w-full max-w-lg mx-auto">

        {{-- Page heading --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block mb-6">
                <span class="text-up-dark font-extrabold text-3xl tracking-tight">jobs<span class="text-up-green">.af</span></span>
            </a>
            <h1 class="text-2xl font-bold text-up-dark">Create your account</h1>
            <p class="text-up-text mt-1 text-[15px]">Join Afghanistan's largest job portal — it's free</p>
        </div>

        {{-- Registration card --}}
        <div class="bg-white border border-up-border rounded-2xl p-8">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf

                {{-- Role selector --}}
                <div class="mb-7">
                    <label class="block text-up-dark font-semibold text-sm mb-3">I want to&hellip;</label>
                    <div class="grid grid-cols-3 gap-3">

                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="jobseeker" class="sr-only peer" {{ old('role', 'jobseeker') === 'jobseeker' ? 'checked' : '' }}>
                            <div class="border-2 border-up-border peer-checked:border-up-green peer-checked:bg-up-green/5 rounded-2xl p-4 text-center transition-all hover:border-up-green/50">
                                <div class="w-10 h-10 rounded-xl bg-up-light flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-briefcase text-up-green text-base"></i>
                                </div>
                                <div class="text-xs font-semibold text-up-dark leading-tight">Find a Job</div>
                                <div class="text-[11px] text-up-muted mt-0.5">Job Seeker</div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="employer" class="sr-only peer" {{ old('role') === 'employer' ? 'checked' : '' }}>
                            <div class="border-2 border-up-border peer-checked:border-up-green peer-checked:bg-up-green/5 rounded-2xl p-4 text-center transition-all hover:border-up-green/50">
                                <div class="w-10 h-10 rounded-xl bg-up-light flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-building text-up-green text-base"></i>
                                </div>
                                <div class="text-xs font-semibold text-up-dark leading-tight">Hire Talent</div>
                                <div class="text-[11px] text-up-muted mt-0.5">Employer</div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="freelancer" class="sr-only peer" {{ old('role') === 'freelancer' ? 'checked' : '' }}>
                            <div class="border-2 border-up-border peer-checked:border-up-green peer-checked:bg-up-green/5 rounded-2xl p-4 text-center transition-all hover:border-up-green/50">
                                <div class="w-10 h-10 rounded-xl bg-up-light flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-laptop-code text-up-green text-base"></i>
                                </div>
                                <div class="text-xs font-semibold text-up-dark leading-tight">Freelance</div>
                                <div class="text-[11px] text-up-muted mt-0.5">Freelancer</div>
                            </div>
                        </label>

                    </div>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Full Name --}}
                <div class="mb-4">
                    <label class="block text-up-dark font-medium text-sm mb-1.5" for="name">Full Name</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        autocomplete="name"
                        placeholder="Ahmad Karimi"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition @error('name') border-red-400 @enderror"
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-up-dark font-medium text-sm mb-1.5" for="reg_email">Email Address</label>
                    <input
                        id="reg_email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        placeholder="you@example.com"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition @error('email') border-red-400 @enderror"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-4">
                    <label class="block text-up-dark font-medium text-sm mb-1.5" for="phone">Phone Number</label>
                    <input
                        id="phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="+93 700 000 000"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition"
                    >
                </div>

                {{-- Location --}}
                <div class="mb-4">
                    <label class="block text-up-dark font-medium text-sm mb-1.5" for="location">Location</label>
                    <input
                        id="location"
                        type="text"
                        name="location"
                        value="{{ old('location') }}"
                        placeholder="Kabul, Afghanistan"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition"
                    >
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label class="block text-up-dark font-medium text-sm mb-1.5" for="reg_password">Password</label>
                    <input
                        id="reg_password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        placeholder="Min. 8 characters"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition @error('password') border-red-400 @enderror"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-7">
                    <label class="block text-up-dark font-medium text-sm mb-1.5" for="password_confirmation">Confirm Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                        placeholder="Repeat your password"
                        class="w-full border border-up-border rounded-xl px-4 py-3 text-[15px] text-up-dark placeholder-up-muted focus:outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 transition"
                    >
                </div>

                <button type="submit" class="btn-primary w-full py-3 text-[15px] font-semibold">
                    Create Account
                </button>
            </form>

            <p class="text-center text-up-text text-sm mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-up-green hover:text-up-green-hover font-semibold">Log in</a>
            </p>
        </div>

    </div>
</div>

@endsection
