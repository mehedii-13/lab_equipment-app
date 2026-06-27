<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Lab;
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
        $departments = Department::with('labs')->orderBy('name')->get();
        $labs = Lab::with('department')->orderBy('name')->get();

        return view('super-admin.dashboard', compact('privilegedUsers', 'labAdmins', 'departments', 'labs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'department_id' => [Rule::requiredIf(fn () => $request->input('role') === 'lab_admin'), 'nullable', 'exists:departments,id'],
            'lab_id' => [Rule::requiredIf(fn () => $request->input('role') === 'lab_admin'), 'nullable', Rule::exists('labs', 'id')->where(fn ($query) => $query->where('department_id', $request->input('department_id')))],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::in(['super_admin', 'lab_admin'])],
        ]);

        $lab = isset($validated['lab_id']) ? Lab::find($validated['lab_id']) : null;

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'department_id' => $validated['department_id'] ?? null,
            'lab_id' => $validated['lab_id'] ?? null,
            'lab_name' => $lab?->name,
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);

        return back()->with('success', 'Privileged user created successfully.');
    }

    public function storeDepartment(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:departments,name'],
        ]);

        Department::create($validated);

        return back()->with('success', 'Department created successfully.');
    }

    public function storeLab(Request $request)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('labs', 'name')->where(fn ($query) => $query->where('department_id', $request->input('department_id'))),
            ],
        ]);

        Lab::create($validated);

        return back()->with('success', 'Lab created successfully.');
    }

    public function updateDepartment(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')->ignore($department->id),
            ],
        ]);

        $department->update($validated);

        return back()->with('success', 'Department updated successfully.');
    }

    public function updateLab(Request $request, Lab $lab)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('labs', 'name')
                    ->where(fn ($query) => $query->where('department_id', $request->input('department_id')))
                    ->ignore($lab->id),
            ],
        ]);

        $lab->update($validated);

        User::where('lab_id', $lab->id)->update([
            'department_id' => $validated['department_id'],
            'lab_name' => $validated['name'],
        ]);

        return back()->with('success', 'Lab updated successfully.');
    }

    public function demote(User $user)
    {
        if ($user->role === 'lab_admin') {
            $user->update([
                'role' => 'student',
                'lab_name' => null,
            ]);
            return back()->with('success', "{$user->name} has been removed from adminship and is now a student.");
        }

        return back()->with('error', "User is not a Lab Admin.");
    }
}
