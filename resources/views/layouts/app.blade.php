<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jobs.AF - Afghanistan Job Portal')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .nav-link { transition: all 0.2s; }
        .card-hover { transition: all 0.3s; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-gray-50 font-sans">

<!-- Top Navigation -->
<nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div class="bg-gradient-to-r from-green-600 to-green-700 text-white px-3 py-1 rounded-lg font-bold text-xl">Jobs</div>
                <span class="text-green-700 font-bold text-xl">.AF</span>
            </a>

            <!-- Main Nav -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-green-600 nav-link font-medium">Find Jobs</a>
                <a href="{{ route('freelance.index') }}" class="text-gray-600 hover:text-green-600 nav-link font-medium">Freelance</a>
                <a href="{{ route('freelancers.index') }}" class="text-gray-600 hover:text-green-600 nav-link font-medium">Freelancers</a>
                <a href="{{ route('companies.index') }}" class="text-gray-600 hover:text-green-600 nav-link font-medium">Companies</a>
            </div>

            <!-- Auth Nav -->
            <div class="flex items-center space-x-3">
                @if(session('logged_in'))
                    <div class="hidden md:flex items-center space-x-3">
                        @if(session('user_role') === 'jobseeker')
                            <a href="{{ route('jobseeker.dashboard') }}" class="text-gray-600 hover:text-green-600 font-medium">Dashboard</a>
                        @elseif(session('user_role') === 'employer')
                            <a href="{{ route('employer.dashboard') }}" class="text-gray-600 hover:text-green-600 font-medium">Dashboard</a>
                        @elseif(session('user_role') === 'freelancer')
                            <a href="{{ route('freelancer.dashboard') }}" class="text-gray-600 hover:text-green-600 font-medium">Dashboard</a>
                        @endif
                        <span class="text-gray-500 text-sm">Hi, {{ session('user_name') }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition-all">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 font-medium hidden md:block">Login</a>
                    <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>

@if(session('success'))
<div class="bg-green-50 border-l-4 border-green-500 p-4 mx-4 mt-2">
    <p class="text-green-700">{{ session('success') }}</p>
</div>
@endif
@if(session('error'))
<div class="bg-red-50 border-l-4 border-red-500 p-4 mx-4 mt-2">
    <p class="text-red-700">{{ session('error') }}</p>
</div>
@endif

@yield('content')

<!-- Footer -->
<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <div class="flex items-center space-x-2 mb-4">
                <div class="bg-green-600 text-white px-3 py-1 rounded-lg font-bold text-xl">Jobs</div>
                <span class="text-green-400 font-bold text-xl">.AF</span>
            </div>
            <p class="text-gray-400 text-sm">Afghanistan's leading job portal connecting talented professionals with top employers across the country.</p>
        </div>
        <div>
            <h4 class="font-semibold mb-4 text-green-400">For Job Seekers</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="{{ route('jobs.index') }}" class="hover:text-white">Browse Jobs</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-white">Create Account</a></li>
                <li><a href="{{ route('resume.index') }}" class="hover:text-white">Build Resume</a></li>
                <li><a href="{{ route('companies.index') }}" class="hover:text-white">Companies</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold mb-4 text-green-400">For Employers</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="{{ route('register') }}" class="hover:text-white">Post a Job</a></li>
                <li><a href="{{ route('freelancers.index') }}" class="hover:text-white">Find Freelancers</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-white">Create Company Profile</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold mb-4 text-green-400">Contact</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li>📍 Kabul, Afghanistan</li>
                <li>📧 info@jobs.af</li>
                <li>📞 +93 700 000 000</li>
                <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-800 py-6 text-center text-sm text-gray-500">
        <p>© {{ date('Y') }} Jobs.AF - Afghanistan Job Portal. All rights reserved.</p>
        <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="text-green-400 hover:underline">LaraCopilot</a></p>
    </div>
</footer>

</body>
</html>
