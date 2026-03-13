<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jobs.AF - Afghanistan Job Portal')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'up-green': '#14a800',
                        'up-green-hover': '#108a00',
                        'up-dark': '#001e00',
                        'up-text': '#5e6d55',
                        'up-muted': '#9aaa97',
                        'up-bg': '#f2f7f2',
                        'up-bg-light': '#f7faf7',
                        'up-border': '#d5e0d5',
                        'up-light': '#e4ebe4',
                        'up-badge': '#13544e',
                    },
                    fontFamily: {
                        sans: ['"Inter"', '"Helvetica Neue"', 'Helvetica', 'Arial', 'sans-serif'],
                    },
                    borderRadius: {
                        'pill': '100px',
                    },
                },
            },
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .card-hover { transition: all 0.2s ease; }
        .card-hover:hover { box-shadow: 0 6px 24px rgba(0,30,0,0.08); border-color: #14a800; }
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: #14a800; transition: width 0.2s ease; }
        .nav-link:hover::after { width: 100%; }
        .btn-primary { background: #14a800; color: #fff; border-radius: 100px; transition: all 0.2s; }
        .btn-primary:hover { background: #108a00; }
        .btn-outline { border: 2px solid #14a800; color: #14a800; border-radius: 100px; transition: all 0.2s; }
        .btn-outline:hover { background: #14a800; color: #fff; }
        .btn-dark { background: #001e00; color: #fff; border-radius: 100px; transition: all 0.2s; }
        .btn-dark:hover { background: #14a800; }
    </style>
    @yield('styles')
</head>
<body class="bg-white font-sans text-up-dark antialiased">

<!-- Top Navigation -->
<nav class="bg-white border-b border-up-border sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-[72px]">
            <!-- Logo -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.svg') }}" alt="Jobs.AF" class="h-8">
                </a>
                <!-- Main Nav -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('jobs.index') }}" class="text-up-dark hover:text-up-green nav-link text-[15px] font-medium">Find Job</a>
                    <a href="{{ route('freelancers.index') }}" class="text-up-dark hover:text-up-green nav-link text-[15px] font-medium">Hire Talents</a>
                    <a href="{{ route('freelance.index') }}" class="text-up-dark hover:text-up-green nav-link text-[15px] font-medium">Freelance Work</a>
                    <a href="{{ route('companies.index') }}" class="text-up-dark hover:text-up-green nav-link text-[15px] font-medium">Employers</a>
                </div>
            </div>

            <!-- Auth Nav -->
            <div class="flex items-center space-x-4">
                @if(session('logged_in'))
                    <div class="hidden md:flex items-center space-x-4">
                        @if(session('user_role') === 'jobseeker')
                            <a href="{{ route('jobseeker.dashboard') }}" class="text-up-dark hover:text-up-green text-[15px] font-medium">Dashboard</a>
                        @elseif(session('user_role') === 'employer')
                            <a href="{{ route('employer.dashboard') }}" class="text-up-dark hover:text-up-green text-[15px] font-medium">Dashboard</a>
                        @elseif(session('user_role') === 'freelancer')
                            <a href="{{ route('freelancer.dashboard') }}" class="text-up-dark hover:text-up-green text-[15px] font-medium">Dashboard</a>
                        @endif
                        <span class="text-up-text text-sm">{{ session('user_name') }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn-outline px-5 py-2 text-sm font-medium">Log Out</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-up-dark hover:text-up-green font-medium hidden md:block text-[15px]">Log In</a>
                    <a href="{{ route('register') }}" class="btn-primary px-6 py-2.5 text-sm font-medium">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</nav>

@if(session('success'))
<div class="bg-[#dff5d8] border border-[#b4e6a5] px-6 py-4 mx-auto max-w-7xl mt-4 rounded-xl flex items-center gap-3">
    <i class="fas fa-check-circle text-up-green text-lg"></i>
    <p class="text-up-dark text-sm font-medium">{{ session('success') }}</p>
</div>
@endif
@if(session('error'))
<div class="bg-[#fde8e8] border border-[#f5b4b4] px-6 py-4 mx-auto max-w-7xl mt-4 rounded-xl flex items-center gap-3">
    <i class="fas fa-exclamation-circle text-[#d93025] text-lg"></i>
    <p class="text-[#9e1b0e] text-sm font-medium">{{ session('error') }}</p>
</div>
@endif

@yield('content')

<!-- Footer -->
<footer class="bg-up-dark text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
            <div class="col-span-2 md:col-span-1">
                <img src="{{ asset('images/logo.svg') }}" alt="Jobs.AF" class="h-8 brightness-0 invert">
                <p class="text-up-muted text-sm mt-4 leading-relaxed">Afghanistan's premier talent marketplace connecting professionals with opportunities.</p>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-up-muted hover:text-up-green transition-colors"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-up-muted hover:text-up-green transition-colors"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-up-muted hover:text-up-green transition-colors"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-up-muted hover:text-up-green transition-colors"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-sm uppercase tracking-wider mb-4 text-white/80">For Employers</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('freelancers.index') }}" class="text-up-muted hover:text-up-green transition-colors">Hire Talents</a></li>
                    <li><a href="{{ route('register') }}" class="text-up-muted hover:text-up-green transition-colors">Post a Job</a></li>
                    <li><a href="{{ route('companies.index') }}" class="text-up-muted hover:text-up-green transition-colors">Employers</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-sm uppercase tracking-wider mb-4 text-white/80">For Job Seekers</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('jobs.index') }}" class="text-up-muted hover:text-up-green transition-colors">Find Job</a></li>
                    <li><a href="{{ route('freelance.index') }}" class="text-up-muted hover:text-up-green transition-colors">Freelance Work</a></li>
                    <li><a href="{{ route('resume.index') }}" class="text-up-muted hover:text-up-green transition-colors">Build Resume</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-sm uppercase tracking-wider mb-4 text-white/80">Resources</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('about') }}" class="text-up-muted hover:text-up-green transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-up-muted hover:text-up-green transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-sm uppercase tracking-wider mb-4 text-white/80">Get in Touch</h4>
                <ul class="space-y-3 text-sm text-up-muted">
                    <li class="flex items-center gap-2"><i class="fas fa-map-marker-alt text-up-green text-xs"></i> Kabul, Afghanistan</li>
                    <li class="flex items-center gap-2"><i class="fas fa-envelope text-up-green text-xs"></i> info@jobs.af</li>
                    <li class="flex items-center gap-2"><i class="fas fa-phone text-up-green text-xs"></i> +93 700 000 000</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-col md:flex-row justify-between items-center text-sm text-up-muted">
            <p>&copy; {{ date('Y') }} Jobs.AF. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>
