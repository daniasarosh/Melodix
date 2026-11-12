<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // normal users ki list
    public function index()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    // user ko block ya unblock karta hai
    public function toggle(User $user)
    {
        if ($user->role == 'admin') {
            return back()->with('error', 'Admin accounts cannot be blocked.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', $user->is_active ? 'User unblocked.' : 'User blocked.');
    }
}
