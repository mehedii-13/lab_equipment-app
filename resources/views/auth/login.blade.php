@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto">
    <!-- Card Container -->
    <div class="relative backdrop-blur-xl bg-slate-900/50 border border-slate-800 rounded-3xl p-8 shadow-2xl shadow-black/40 overflow-hidden">
        <!-- Accent Glow -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Heading -->
        <div class="text-center mb-8 relative z-10">
            <h2 class="text-3xl font-extrabold tracking-tight text-white mb-2">Welcome Back</h2>
            <p class="text-slate-400 text-sm">Sign in to manage or request lab equipment</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-sm text-red-400">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6 relative z-10">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Email Address</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-teal-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-slate-950/80 border border-slate-800 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 rounded-xl py-3 pl-11 pr-4 text-slate-100 placeholder-slate-600 text-sm transition-all outline-none"
                           placeholder="you@example.com">
                </div>
            </div>

            <!-- Password -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Password</label>
                </div>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-teal-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" required
                           class="w-full bg-slate-950/80 border border-slate-800 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 rounded-xl py-3 pl-11 pr-4 text-slate-100 placeholder-slate-600 text-sm transition-all outline-none"
                           placeholder="••••••••">
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" 
                       class="h-4 w-4 rounded bg-slate-950 border-slate-800 text-teal-500 focus:ring-teal-500/20 focus:ring-offset-0 focus:ring-opacity-50">
                <label for="remember" class="ml-2.5 text-sm text-slate-400 select-none">Remember this device</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="cursor-pointer w-full py-3 px-4 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-400 hover:to-emerald-400 text-slate-950 font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.01] shadow-lg shadow-teal-500/10">
                Sign In
            </button>
        </form>

        <!-- Footer Link -->
        <p class="mt-8 text-center text-sm text-slate-400 relative z-10">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-semibold text-teal-400 hover:text-teal-300 transition-colors">Register here</a>
        </p>
    </div>

   
@endsection
