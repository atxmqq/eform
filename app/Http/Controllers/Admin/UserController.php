<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        $roles = User::ROLES;
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role'       => 'required|in:' . implode(',', array_keys(User::ROLES)),
            'is_active'  => 'boolean',
            'department' => 'nullable|string|max:255',
            'student_id' => 'nullable|string|max:50',
        ]);

        $user->update([
            'role'       => $request->role,
            'is_active'  => $request->boolean('is_active', true),
            'department' => $request->department,
            'student_id' => $request->student_id,
        ]);

        return back()->with('success', 'อัปเดตข้อมูลผู้ใช้สำเร็จ');
    }
}
