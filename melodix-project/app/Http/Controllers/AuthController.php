<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // login ka page dikhata hai
    public function showLogin()
    {
        return view('auth.login');
    }

    // login form submit hone par chalta hai
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login = [
            'username' => $request->username,
            'password' => $request->password,
            'is_active' => 1,
        ];

        if (Auth::attempt($login)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            }
            return redirect('/');
        }

        return back()->withErrors(['username' => 'User ID or password is incorrect, or your account is blocked.'])->withInput();
    }

    // register ka page dikhata hai
    public function showRegister()
    {
        return view('auth.register');
    }

    // register form submit hone par chalta hai
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:4|max:30|unique:users,username',
            'name' => ['required', 'max:100', 'regex:/^[A-Za-z ]+$/'],
            'address' => 'required|max:255',
            'phone' => 'required|digits_between:10,15',
            'email' => 'required|email|max:120|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();

        Auth::login($user);

        return redirect('/');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
