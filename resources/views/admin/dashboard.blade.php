@extends('layouts.app')

@section('title', 'Lab Admin Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header banner -->
    <div class="backdrop-blur-md bg-slate-900/40 border border-slate-800/80 rounded-3xl p-8 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2 relative z-10">
            <span class="text-xs font-semibold uppercase tracking-wider text-purple-400">Lab Administration</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white">Hello, {{ Auth::user()->name }}!</h1>
            <p class="text-slate-400 text-sm md:text-base">Monitor inventory, process student requests, and coordinate equipment availability.</p>
        </div>
        <div class="relative z-10 flex gap-3">
            <button class="px-5 py-3 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-bold text-sm transition-colors cursor-pointer">
                Add Equipment
            </button>
            <button class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-sm border border-slate-700 transition-colors cursor-pointer">
                Manage Requests
            </button>
        </div>
    </div>

    <!-- Stats grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="backdrop-blur-md bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Total Equipment</span>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>

        <div class="backdrop-blur-md bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Active Bookings</span>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>

        <div class="backdrop-blur-md bg-slate-900/30 border border-slate-800/60 rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Pending Requests</span>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
        </div>
    </div>
</div>
@endsection
