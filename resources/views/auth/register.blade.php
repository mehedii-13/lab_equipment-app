@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="relative backdrop-blur-xl bg-slate-900/50 border border-slate-800 rounded-3xl p-8 shadow-2xl shadow-black/40 overflow-hidden">
        <!-- Ambient Glow -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="text-center mb-8 relative z-10">
            <h2 class="text-3xl font-extrabold tracking-tight text-white mb-2">Create Account</h2>
            <p class="text-slate-400 text-sm">Register to request equipment or manage laboratory spaces</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-sm text-red-400">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-5 relative z-10">
            @csrf

            <!-- Role Selector -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3">Choose Your Role</label>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Student Option -->
                    <label class="cursor-pointer group">
                        <input type="radio" name="role" value="student" class="sr-only peer" {{ old('role', 'student') === 'student' ? 'checked' : '' }}>
                        <div class="p-4 rounded-2xl bg-slate-950/80 border border-slate-800 peer-checked:border-teal-500 peer-checked:bg-teal-500/5 group-hover:border-slate-700 transition-all flex flex-col items-center text-center space-y-2">
                            <div class="w-10 h-10 rounded-xl bg-slate-900 group-hover:bg-slate-800 peer-checked:group-hover:bg-teal-500/10 flex items-center justify-center text-slate-400 peer-checked:text-teal-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-200">Student</span>
                            <span class="text-[11px] text-slate-500">Request equipment</span>
                        </div>
                    </label>

                    <!-- Lab Admin Option -->
                    <label class="cursor-pointer group">
                        <input type="radio" name="role" value="lab_admin" class="sr-only peer" {{ old('role') === 'lab_admin' ? 'checked' : '' }}>
                        <div class="p-4 rounded-2xl bg-slate-950/80 border border-slate-800 peer-checked:border-teal-500 peer-checked:bg-teal-500/5 group-hover:border-slate-700 transition-all flex flex-col items-center text-center space-y-2">
                            <div class="w-10 h-10 rounded-xl bg-slate-900 group-hover:bg-slate-800 peer-checked:group-hover:bg-teal-500/10 flex items-center justify-center text-slate-400 peer-checked:text-teal-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-200">Lab Admin</span>
                            <span class="text-[11px] text-slate-500">Manage labs & inventory</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Full Name</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-teal-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full bg-slate-950/80 border border-slate-800 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 rounded-xl py-3 pl-11 pr-4 text-slate-100 placeholder-slate-600 text-sm transition-all outline-none"
                           placeholder="Alex Johnson">
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Email Address</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-teal-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full bg-slate-950/80 border border-slate-800 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 rounded-xl py-3 pl-11 pr-4 text-slate-100 placeholder-slate-600 text-sm transition-all outline-none"
                           placeholder="alex@university.edu">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Password</label>
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

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Confirm Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-teal-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full bg-slate-950/80 border border-slate-800 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 rounded-xl py-3 pl-11 pr-4 text-slate-100 placeholder-slate-600 text-sm transition-all outline-none"
                           placeholder="••••••••">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="cursor-pointer w-full py-3 px-4 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-400 hover:to-emerald-400 text-slate-950 font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.01] shadow-lg shadow-teal-500/10">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-400 relative z-10">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-semibold text-teal-400 hover:text-teal-300 transition-colors">Sign In instead</a>
        </p>
    </div>
</div>
@endsection
