@extends('layouts.app')
@section('title', 'Contact Us - Jobs.AF')
@section('content')

{{-- Page Header --}}
<div class="bg-up-dark text-white py-12">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <h1 class="text-3xl font-bold mb-2">Contact Us</h1>
        <p class="text-up-muted">Have a question or feedback? We would love to hear from you.</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-12">

    @if(session('success'))
    <div class="bg-up-bg border border-up-border rounded-2xl p-5 mb-8 flex items-center gap-3">
        <i class="fa-solid fa-circle-check text-up-green text-xl flex-shrink-0"></i>
        <div>
            <p class="text-up-dark font-semibold">Message sent successfully!</p>
            <p class="text-up-text text-sm">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Contact Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-up-border rounded-2xl p-8">
                <h2 class="text-xl font-bold text-up-dark mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane text-up-green"></i> Send a Message
                </h2>
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-up-dark font-semibold mb-2 text-sm">Your Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('name') border-red-400 @enderror"
                                   placeholder="Ahmad Karimi">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-up-dark font-semibold mb-2 text-sm">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 @error('email') border-red-400 @enderror"
                                   placeholder="ahmad@example.com">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-up-dark font-semibold mb-2 text-sm">Message <span class="text-red-500">*</span></label>
                        <textarea name="message" rows="7"
                                  class="w-full border border-up-border rounded-xl px-4 py-3 text-up-dark outline-none focus:border-up-green focus:ring-2 focus:ring-up-green/20 resize-none @error('message') border-red-400 @enderror"
                                  placeholder="Write your message, question, or feedback here...">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary px-8 py-3 font-semibold w-full sm:w-auto">
                        <i class="fa-solid fa-paper-plane mr-2"></i>Send Message
                    </button>
                </form>
            </div>
        </div>

        {{-- Contact Info Sidebar --}}
        <div class="space-y-5">
            <div class="bg-white border border-up-border rounded-2xl p-6">
                <h3 class="font-bold text-up-dark mb-5 text-base flex items-center gap-2">
                    <i class="fa-solid fa-address-card text-up-green"></i> Contact Info
                </h3>
                <div class="space-y-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-up-light rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-envelope text-up-dark"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-up-dark">Email</p>
                            <a href="mailto:info@jobs.af" class="text-up-green hover:text-up-green-hover text-sm transition-colors">info@jobs.af</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-up-light rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-phone text-up-green"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-up-dark">Phone</p>
                            <p class="text-up-text text-sm">+93 700 000 000</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-up-light rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-location-dot text-up-green"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-up-dark">Address</p>
                            <p class="text-up-text text-sm">Share-e-Naw, Kabul<br>Afghanistan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-up-border rounded-2xl p-6">
                <h3 class="font-bold text-up-dark mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-clock text-up-green"></i> Business Hours
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-up-muted">Sat &ndash; Thu</span>
                        <span class="text-up-dark font-medium">8:00 AM &ndash; 5:00 PM</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-up-muted">Friday</span>
                        <span class="text-up-muted">Closed</span>
                    </div>
                </div>
            </div>

            <div class="bg-up-bg border border-up-border rounded-2xl p-5">
                <p class="text-up-dark text-sm font-semibold mb-1 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-up-green"></i> Quick Response
                </p>
                <p class="text-up-text text-sm">We typically respond within 24 business hours.</p>
            </div>
        </div>

    </div>
</div>
@endsection
