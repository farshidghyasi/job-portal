@extends('layouts.app')
@section('title', 'About Us - Jobs.AF')
@section('content')

{{-- Hero --}}
<div class="bg-up-dark text-white py-20">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 mb-6">
            <span class="bg-up-green text-white px-4 py-2 rounded-xl font-bold text-3xl">Jobs</span>
            <span class="text-up-muted font-bold text-3xl">.AF</span>
        </div>
        <h1 class="text-4xl font-bold mb-5">Afghanistan's Premier Job Portal</h1>
        <p class="text-up-muted text-lg max-w-2xl mx-auto leading-relaxed">
            Connecting talented Afghan professionals with top employers across the country and beyond. We believe every person deserves access to meaningful work.
        </p>
    </div>
</div>

{{-- Stats Bar --}}
<div class="bg-white border-b border-up-border py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <div class="text-3xl font-bold text-up-dark">5,000+</div>
                <div class="text-up-text text-sm mt-1">Jobs Listed</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-up-dark">1,200+</div>
                <div class="text-up-text text-sm mt-1">Employers</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-up-dark">20,000+</div>
                <div class="text-up-text text-sm mt-1">Job Seekers</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-up-dark">34</div>
                <div class="text-up-text text-sm mt-1">Provinces Covered</div>
            </div>
        </div>
    </div>
</div>

{{-- Mission Section --}}
<div class="max-w-5xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <span class="text-up-green font-semibold text-sm uppercase tracking-wide">Our Mission</span>
            <h2 class="text-3xl font-bold text-up-dark mt-2 mb-5">Building Afghanistan's Future, One Job at a Time</h2>
            <p class="text-up-text leading-relaxed mb-4">
                Jobs.AF was founded with a simple but powerful mission: to bridge the gap between talented Afghan professionals and the organisations that need them. We believe that access to quality employment opportunities is a cornerstone of a thriving economy and a prosperous nation.
            </p>
            <p class="text-up-text leading-relaxed">
                Whether you are a fresh graduate searching for your first role, a seasoned professional seeking new challenges, or an employer looking to build a world-class team, Jobs.AF is your trusted partner every step of the way.
            </p>
        </div>

        <div class="space-y-4">
            <div class="bg-up-bg border border-up-border rounded-2xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-up-light rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-handshake text-up-dark"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-up-dark mb-1">Trusted Connections</h4>
                        <p class="text-up-text text-sm leading-relaxed">We verify employers and create a safe, trustworthy environment for job seekers.</p>
                    </div>
                </div>
            </div>

            <div class="bg-up-bg border border-up-border rounded-2xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-up-light rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-globe text-up-green"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-up-dark mb-1">Nationwide Reach</h4>
                        <p class="text-up-text text-sm leading-relaxed">Covering all 34 provinces, from Kabul to Kandahar, Herat to Mazar-i-Sharif.</p>
                    </div>
                </div>
            </div>

            <div class="bg-up-bg border border-up-border rounded-2xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-up-light rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-laptop-code text-up-green"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-up-dark mb-1">Freelance Economy</h4>
                        <p class="text-up-text text-sm leading-relaxed">Supporting the growing freelance and remote-work community in Afghanistan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Values Section --}}
<div class="bg-up-bg-light border-t border-up-border py-16">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-up-green font-semibold text-sm uppercase tracking-wide">What We Stand For</span>
            <h2 class="text-3xl font-bold text-up-dark mt-2">Our Core Values</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white border border-up-border rounded-2xl p-8 text-center">
                <div class="w-14 h-14 bg-up-light rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-shield-halved text-up-dark text-xl"></i>
                </div>
                <h3 class="font-bold text-up-dark text-lg mb-3">Integrity</h3>
                <p class="text-up-text text-sm leading-relaxed">We maintain honest, transparent practices. Every listing is legitimate and every interaction is held to the highest standard.</p>
            </div>

            <div class="bg-white border border-up-border rounded-2xl p-8 text-center">
                <div class="w-14 h-14 bg-up-light rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-users text-up-green text-xl"></i>
                </div>
                <h3 class="font-bold text-up-dark text-lg mb-3">Inclusivity</h3>
                <p class="text-up-text text-sm leading-relaxed">Equal opportunity for all. We are committed to making the job market accessible to everyone, regardless of background or location.</p>
            </div>

            <div class="bg-white border border-up-border rounded-2xl p-8 text-center">
                <div class="w-14 h-14 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-bolt text-yellow-500 text-xl"></i>
                </div>
                <h3 class="font-bold text-up-dark text-lg mb-3">Innovation</h3>
                <p class="text-up-text text-sm leading-relaxed">We continuously improve our platform with modern tools to make job searching and hiring faster, smarter, and more effective.</p>
            </div>
        </div>
    </div>
</div>

{{-- CTA Section --}}
<div class="max-w-5xl mx-auto px-4 py-16 text-center">
    <h2 class="text-3xl font-bold text-up-dark mb-4">Ready to Get Started?</h2>
    <p class="text-up-text mb-8 max-w-xl mx-auto">Join thousands of professionals and employers who trust Jobs.AF to make the right connections.</p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('jobs.index') }}" class="btn-primary px-8 py-3 font-semibold">
            <i class="fa-solid fa-magnifying-glass mr-2"></i>Browse Jobs
        </a>
        <a href="{{ route('register') }}" class="btn-outline px-8 py-3 font-semibold">
            <i class="fa-solid fa-user-plus mr-2"></i>Create Account
        </a>
        <a href="{{ route('contact') }}" class="btn-dark px-8 py-3 font-semibold">
            <i class="fa-solid fa-envelope mr-2"></i>Contact Us
        </a>
    </div>
</div>
@endsection
