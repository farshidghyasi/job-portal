<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Jobs.AF')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'up-green':       '#14a800',
                        'up-green-hover': '#108a00',
                        'up-dark':        '#001e00',
                        'up-text':        '#5e6d55',
                        'up-muted':       '#9aaa97',
                        'up-bg':          '#f2f7f2',
                        'up-bg-light':    '#f7faf7',
                        'up-border':      '#d5e0d5',
                        'up-light':       '#e4ebe4',
                        'up-badge':       '#13544e',
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
        .btn-primary  { background: #14a800; color: #fff; border-radius: 100px; transition: all 0.2s; }
        .btn-primary:hover  { background: #108a00; }
        .btn-outline  { border: 2px solid #14a800; color: #14a800; border-radius: 100px; transition: all 0.2s; }
        .btn-outline:hover  { background: #14a800; color: #fff; }
        .btn-dark     { background: #001e00; color: #fff; border-radius: 100px; transition: all 0.2s; }
        .btn-dark:hover     { background: #14a800; }
        .card-hover   { transition: all 0.2s ease; }
        .card-hover:hover   { box-shadow: 0 6px 24px rgba(0,30,0,0.08); border-color: #14a800; }
        .sidebar-link { display: flex; align-items: center; gap: 12px; padding: 10px 16px; border-radius: 8px; font-size: 14px; font-weight: 500; transition: all 0.15s; color: #9aaa97; }
        .sidebar-link:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .sidebar-link.active { background: rgba(20,168,0,0.18); color: #fff; }
        .sidebar-link.active i { color: #14a800; }
    </style>
    @yield('styles')
</head>
<body class="bg-up-bg font-sans text-up-dark antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-up-dark text-white flex flex-col fixed h-full z-40 shrink-0">

        {{-- Logo --}}
        <div class="px-6 py-5 border-b border-white/10">
            <a href="{{ route('admin.dashboard') }}" class="flex items-baseline gap-0.5">
                <span class="text-white font-extrabold text-xl tracking-tight">jobs</span><span class="text-up-green font-extrabold text-xl tracking-tight">.af</span>
                <span class="text-up-muted text-xs font-medium ml-2">Admin</span>
            </a>
            <p class="text-up-muted/60 text-xs mt-1">Administration Panel</p>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-bar w-4 text-center"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-users w-4 text-center"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.jobs.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.jobs*') ? 'active' : '' }}">
                <i class="fas fa-briefcase w-4 text-center"></i>
                <span>Job Listings</span>
            </a>
            <a href="{{ route('admin.freelance.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.freelance*') ? 'active' : '' }}">
                <i class="fas fa-laptop-code w-4 text-center"></i>
                <span>Freelance Jobs</span>
            </a>

            <div class="border-t border-white/10 my-3"></div>

            <a href="{{ route('home') }}" class="sidebar-link">
                <i class="fas fa-external-link-alt w-4 text-center"></i>
                <span>View Site</span>
            </a>
        </nav>

        {{-- User / Logout --}}
        <div class="px-4 py-4 border-t border-white/10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-up-green/20 flex items-center justify-center shrink-0">
                    <i class="fas fa-user-shield text-up-green text-xs"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-up-muted leading-none mb-0.5">Logged in as</p>
                    <p class="text-sm font-semibold text-white truncate">{{ session('admin_user') }}</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-white/8 hover:bg-white/14 border border-white/12 text-up-muted hover:text-white text-xs font-medium py-2 rounded-lg transition-all">
                    <i class="fas fa-sign-out-alt"></i> Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="ml-64 flex-1 flex flex-col overflow-hidden">

        {{-- Top Header --}}
        <header class="bg-white border-b border-up-border px-8 py-4 flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-lg font-bold text-up-dark">@yield('page-title', 'Dashboard')</h1>
                <p class="text-up-muted text-xs mt-0.5">@yield('page-subtitle', 'Jobs.AF Administration')</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs text-up-muted bg-up-bg px-3 py-1.5 rounded-pill border border-up-border">
                    <i class="fas fa-circle text-up-green text-[8px] mr-1.5"></i>Live
                </span>
            </div>
        </header>

        {{-- Content Scroll Area --}}
        <main class="flex-1 overflow-y-auto p-8">

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="bg-[#dff5d8] border border-[#b4e6a5] px-5 py-4 mb-6 rounded-xl flex items-center gap-3">
                <i class="fas fa-check-circle text-up-green text-lg shrink-0"></i>
                <p class="text-up-dark text-sm font-medium">{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-[#fde8e8] border border-[#f5b4b4] px-5 py-4 mb-6 rounded-xl flex items-center gap-3">
                <i class="fas fa-exclamation-circle text-[#d93025] text-lg shrink-0"></i>
                <p class="text-[#9e1b0e] text-sm font-medium">{{ session('error') }}</p>
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
