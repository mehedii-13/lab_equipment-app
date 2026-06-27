<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'super_admin') {
            return redirect('/super-admin/dashboard');
        } elseif ($role === 'lab_admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/student/dashboard');
    }
    return redirect('/login');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Student Dashboard
    Route::middleware('role:student')->group(function () {
        Route::get('/student/dashboard', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
    });

    // Lab Admin Dashboard
    Route::middleware('role:lab_admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Super Admin Dashboard & Actions
    Route::middleware('role:super_admin')->group(function () {
        Route::get('/super-admin/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
        Route::post('/super-admin/departments', [SuperAdminController::class, 'storeDepartment'])->name('super_admin.departments.store');
        Route::post('/super-admin/labs', [SuperAdminController::class, 'storeLab'])->name('super_admin.labs.store');
        Route::post('/super-admin/users', [SuperAdminController::class, 'store'])->name('super_admin.users.store');
        Route::post('/super-admin/demote-admin/{user}', [SuperAdminController::class, 'demote'])->name('super_admin.demote');
    });
});
