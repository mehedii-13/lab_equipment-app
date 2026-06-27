<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class SuperAdminController extends Controller
{
    public function index()
    {
        $privilegedUsers = User::whereIn('role', ['super_admin', 'lab_admin'])
            ->orderBy('role')
            ->orderBy('name')
            ->get();
        $labAdmins = $privilegedUsers->where('role', 'lab_admin')->values();

        return view('super-admin.dashboard', compact('privilegedUsers', 'labAdmins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::in(['super_admin', 'lab_admin'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);

        return back()->with('success', 'Privileged user created successfully.');
    }

    public function demote(User $user)
    {
        if ($user->role === 'lab_admin') {
            $user->update(['role' => 'student']);
            return back()->with('success', "{$user->name} has been removed from adminship and is now a student.");
        }

        return back()->with('error', "User is not a Lab Admin.");
    }
}
