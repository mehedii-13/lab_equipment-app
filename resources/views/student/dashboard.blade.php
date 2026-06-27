@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header banner -->
    <div class="backdrop-blur-md bg-slate-900/40 border border-slate-800/80 rounded-3xl p-8 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2 relative z-10">
            <span class="text-xs font-semibold uppercase tracking-wider text-teal-400">Student Space</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white">Hello, {{ Auth::user()->name }}!</h1>
            <p class="text-slate-400 text-sm md:text-base">Browse equipment inventory, reserve tools, and keep track of your active lab projects.</p>
        </div>
        <div class="relative z-10 flex gap-3">
            <button class="px-5 py-3 rounded-xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold text-sm transition-colors cursor-pointer">
                Browse Equipment
            </button>
            <button class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-sm border border-slate-700 transition-colors cursor-pointer">
                My Requests
            </button>
        </div>
    </div>

    <!-- Stats grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="backdrop-blur-md bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-500/10 text-teal-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Active Bookings</span>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>

        <div class="backdrop-blur-md bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Pending Approvals</span>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>

        <div class="backdrop-blur-md bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Completed Bookings</span>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>
    </div>
</div>
@endsection
