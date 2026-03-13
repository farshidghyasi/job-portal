<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Jobs.AF')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white flex flex-col fixed h-full">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center space-x-2">
                <div class="bg-green-600 text-white px-2 py-1 rounded font-bold">Jobs</div>
                <span class="text-green-400 font-bold">.AF Admin</span>
            </div>
            <p class="text-gray-400 text-xs mt-1">Administration Panel</p>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-green-600' : '' }}">
                <i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-all {{ request()->routeIs('admin.users*') ? 'bg-green-600' : '' }}">
                <i class="fas fa-users w-5"></i><span>Users</span>
            </a>
            <a href="{{ route('admin.jobs.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-all {{ request()->routeIs('admin.jobs*') ? 'bg-green-600' : '' }}">
                <i class="fas fa-briefcase w-5"></i><span>Job Listings</span>
            </a>
            <a href="{{ route('admin.freelance.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-all {{ request()->routeIs('admin.freelance*') ? 'bg-green-600' : '' }}">
                <i class="fas fa-laptop-code w-5"></i><span>Freelance Jobs</span>
            </a>
            <div class="border-t border-gray-700 my-2"></div>
            <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-all">
                <i class="fas fa-external-link-alt w-5"></i><span>View Site</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <div class="text-sm text-gray-400">Logged in as</div>
            <div class="font-medium">{{ session('admin_user') }}</div>
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-2">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg text-sm">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 flex-1 overflow-y-auto">
        <header class="bg-white shadow-sm px-8 py-4">
            <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
        </header>
        <main class="p-8">
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
