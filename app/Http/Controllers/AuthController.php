<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login()
    {
        return view('main.login');
    }

    function signup()
    {
        return view('main.signup');
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    function registeraction(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'between:1,255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:8', 'max:12'],
            'password' => ['required', 'min:8'],
            'policy' => ['required']
        ]);

        $user = User::create($fields);
        Auth::login($user);
        return redirect('/');
    }

    function loginaction(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($fields)) {
            return redirect('/');
        }

        return redirect()->back()->with('error', 'Wrong email or password');
    }
}
