<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'lab_admin')->orderBy('name')->get();
        return view('super-admin.dashboard', compact('admins'));
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
