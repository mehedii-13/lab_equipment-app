@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header banner -->
    <div class="backdrop-blur-md bg-slate-900/40 border border-slate-800/80 rounded-3xl p-8 relative overflow-hidden">
        <div class="space-y-2 relative z-10">
            <span class="text-xs font-semibold uppercase tracking-wider text-rose-400">Super Admin Console</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white">System Administration</h1>
            <p class="text-slate-400 text-sm md:text-base">Manage laboratory administrators and system roles.</p>
        </div>
    </div>

    <!-- Feedback messages -->
    @if (session('success'))
        <div class="p-4 rounded-xl bg-teal-500/10 border border-teal-500/20 text-sm text-teal-400">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-sm text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <!-- Lab Admins List -->
    <div class="backdrop-blur-md bg-slate-900/30 border border-slate-800/60 rounded-3xl overflow-hidden shadow-xl">
        <div class="px-8 py-6 border-b border-slate-800/80 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-white">Lab Administrators</h3>
                <p class="text-xs text-slate-500">Manage user privileges and administrative assignments</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1 bg-slate-800 text-slate-300 rounded-full border border-slate-700/50">
                {{ $admins->count() }} Active Admins
            </span>
        </div>

        @if ($admins->isEmpty())
            <div class="p-12 text-center text-slate-500">
                <svg class="w-12 h-12 mx-auto text-slate-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <p class="text-sm">No laboratory administrators found in the system.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800/50 text-slate-400 text-xs font-bold uppercase tracking-wider bg-slate-950/20">
                            <th class="px-8 py-4">Name</th>
                            <th class="px-8 py-4">Email</th>
                            <th class="px-8 py-4">Current Role</th>
                            <th class="px-8 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/40 text-sm">
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-slate-900/10 transition-colors">
                                <td class="px-8 py-4 font-semibold text-slate-200">{{ $admin->name }}</td>
                                <td class="px-8 py-4 text-slate-400">{{ $admin->email }}</td>
                                <td class="px-8 py-4">
                                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-purple-500/10 text-purple-400 border border-purple-500/20 uppercase tracking-wider">
                                        {{ str_replace('_', ' ', $admin->role) }}
                                    </span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <form action="{{ route('super_admin.demote', $admin->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove this user from adminship? they will be demoted to student role.');">
                                        @csrf
                                        <button type="submit" class="cursor-pointer text-xs font-bold px-4 py-2 bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white rounded-lg border border-rose-500/20 hover:border-transparent transition-all duration-200">
                                            Remove Adminship
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
