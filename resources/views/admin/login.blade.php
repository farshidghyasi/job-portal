<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Jobs.AF</title>
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
        body { background: #f2f7f2; }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex items-center justify-center bg-up-bg px-4">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-baseline gap-0.5 mb-3">
                <span class="text-up-dark font-extrabold text-3xl tracking-tight">jobs</span><span class="text-up-green font-extrabold text-3xl tracking-tight">.af</span>
            </a>
            <p class="text-up-muted text-sm">Administration Panel &mdash; Restricted Access</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-2xl border border-up-border shadow-sm p-8">

            {{-- Card Header --}}
            <div class="flex items-center gap-4 mb-7">
                <div class="w-11 h-11 rounded-xl bg-up-light flex items-center justify-center shrink-0">
                    <i class="fas fa-lock text-up-badge text-base"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-up-dark leading-tight">Admin Sign In</h1>
                    <p class="text-up-muted text-xs mt-0.5">Authorized personnel only</p>
                </div>
            </div>

            {{-- Error Alert --}}
            @if($errors->any())
            <div class="bg-[#fde8e8] border border-[#f5b4b4] px-4 py-3.5 mb-6 rounded-xl flex items-start gap-3">
                <i class="fas fa-exclamation-circle text-[#d93025] text-sm shrink-0 mt-0.5"></i>
                <p class="text-[#9e1b0e] text-sm">{{ $errors->first() }}</p>
            </div>
            @endif

            {{-- Login Form --}}
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-up-dark mb-1.5">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-up-muted text-sm"></i>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="admin@example.com"
                            class="w-full pl-10 pr-4 py-3 border rounded-xl text-sm text-up-dark placeholder-up-muted
                                   focus:outline-none focus:ring-2 focus:ring-up-green/30 focus:border-up-green transition
                                   @error('email') border-red-400 bg-red-50 @else border-up-border bg-white @enderror"
                        >
                    </div>
                    @error('email')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-up-dark mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-key text-up-muted text-sm"></i>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-3 border border-up-border rounded-xl text-sm text-up-dark placeholder-up-muted bg-white
                                   focus:outline-none focus:ring-2 focus:ring-up-green/30 focus:border-up-green transition"
                        >
                    </div>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full bg-up-green hover:bg-up-green-hover text-white font-semibold py-3 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2 text-sm mt-2"
                >
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Sign In to Admin Panel</span>
                </button>
            </form>

        </div>

        {{-- Footer Note --}}
        <p class="text-center text-up-muted text-xs mt-6">
            &copy; {{ date('Y') }} Jobs.AF &mdash; All rights reserved
        </p>
    </div>

</body>
</html>
