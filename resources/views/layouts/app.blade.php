<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950 text-slate-100 selection:bg-teal-500 selection:text-slate-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lab Portal') - Equipment Management</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col justify-between bg-radial from-slate-900 via-slate-950 to-black overflow-x-hidden">
    <!-- Decorative Ambient Glows -->
    <div class="absolute top-0 left-1/4 -translate-x-1/2 w-[500px] h-[500px] bg-teal-500/10 rounded-full blur-[120px] pointer-events-none -z-10"></div>
    <div class="absolute top-1/3 right-0 w-[400px] h-[400px] bg-purple-500/5 rounded-full blur-[100px] pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 left-1/3 w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[150px] pointer-events-none -z-10"></div>

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-slate-900/60 border-b border-slate-800/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-teal-400 to-emerald-500 flex items-center justify-center shadow-lg shadow-teal-500/20 group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-5 h-5 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-white via-slate-200 to-slate-400 bg-clip-text text-transparent group-hover:text-teal-400 transition-colors duration-300">LabPortal</span>
            </a>

            <!-- Right Nav Links -->
            <nav class="flex items-center space-x-4">
                @auth
                    <div class="flex items-center space-x-4">
                        <span class="hidden sm:inline-block text-xs uppercase tracking-wider px-2.5 py-1 rounded-full bg-slate-800 text-slate-400 border border-slate-700/50">
                            {{ str_replace('_', ' ', Auth::user()->role) }}
                        </span>
                        <span class="text-sm font-medium text-slate-300">
                            {{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="cursor-pointer text-xs font-semibold px-4 py-2 bg-slate-800 hover:bg-red-500/20 hover:text-red-400 rounded-lg border border-slate-700/80 hover:border-red-500/30 transition-all duration-300">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold px-4 py-2 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-400 hover:to-emerald-400 text-slate-950 rounded-lg shadow-md shadow-teal-500/10 transition-all duration-300 hover:scale-[1.02]">
                        Get Started
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6 md:p-12 relative">
        <div class="w-full max-w-6xl">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-6 border-t border-slate-900/60 bg-slate-950/80">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs text-slate-600">
            &copy; {{ date('Y') }} LabPortal. Premium Equipment Management Solution.
        </div>
    </footer>
</body>
</html>
